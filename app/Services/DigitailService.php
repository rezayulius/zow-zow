<?php

namespace App\Services;

use App\Models\DigitailToken;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DigitailService
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $authBase;
    private $apiBase;
    private $timeout;

    public function __construct()
    {
        $this->clientId = config('services.digitail.client_id');
        $this->clientSecret = config('services.digitail.client_secret');
        $this->redirectUri = config('services.digitail.redirect');
        $this->authBase = config('services.digitail.auth_base');
        $this->apiBase = config('services.digitail.api_base');
        $this->timeout = config('services.digitail.timeout', 20);
    }

    /**
     * Get Aggregated Pets Report
     */
    public function getPetsReportAggregated()
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->timeout($this->timeout)
            ->get("{$this->apiBase}/pets-report/aggregated", [
                'without_archived' => 'true'
            ]);

        if (!$response->successful()) {
            Log::error('Digitail Pets Report Failed', ['body' => $response->body()]);
            return null;
        }

        return $response->json();
    }

    /**
     * Get Appointments Report
     */
    public function getAppointments(int $page = 1, int $perPage = 15)
    {
        $accessToken = $this->getAccessToken();
        $clinicId = config('services.digitail.default_clinic_id');

        $response = Http::withToken($accessToken)
            ->timeout($this->timeout)
            ->get("{$this->apiBase}/reports/appointments", [
                'filter[clinic_id]' => $clinicId,
                'page' => $page,
                'per_page' => $perPage,
            ]);

        if (!$response->successful()) {
            Log::error('Digitail Appointments Report Failed', ['body' => $response->body()]);
            return null;
        }

        return $response->json();
    }

    /**
     * Generate the authorization URL with PKCE
     */
    public function getAuthorizationUrl()
    {
        // Generate PKCE Code Verifier and Challenge
        $codeVerifier = Str::random(128);
        $codeChallenge = $this->generateCodeChallenge($codeVerifier);
        $state = Str::random(40);

        // Store verifier and state in session
        Session::put('digitail_code_verifier', $codeVerifier);
        Session::put('digitail_state', $state);

        $query = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'offline_access', // Request offline_access for refresh token
            'state' => $state,
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        // Remove trailing slash if present to avoid double slashes
        $baseUrl = rtrim($this->authBase, '/');
        return "{$baseUrl}/oauth/authorize?" . $query;
    }

    /**
     * Handle the callback and exchange code for token
     */
    public function handleCallback(string $code, string $state)
    {
        // Verify state
        if ($state !== Session::get('digitail_state')) {
            throw new \Exception('Invalid state parameter.');
        }

        $codeVerifier = Session::get('digitail_code_verifier');
        if (!$codeVerifier) {
            throw new \Exception('Code verifier not found in session.');
        }

        // Remove trailing slash if present
        $baseUrl = rtrim($this->authBase, '/');
        
        // Exchange code for token
        $response = Http::asForm()->timeout($this->timeout)->post("{$baseUrl}/oauth/token", [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
            'code_verifier' => $codeVerifier,
        ]);

        if (!$response->successful()) {
            Log::error('Digitail Token Exchange Failed', ['body' => $response->body()]);
            throw new \Exception('Failed to exchange code for token: ' . $response->body());
        }

        $data = $response->json();
        
        // Save token
        return $this->storeToken($data);
    }

    /**
     * Get a valid access token (refresh if expired)
     */
    public function getAccessToken()
    {
        // For migration/fallback phase, if env token exists and no DB token, use env token
        // But for best practice, we prefer DB token.

        $token = DigitailToken::latest()->first();

        if (!$token) {
            // Fallback to static token if configured, otherwise null
            return config('services.digitail.access_token');
        }

        if (!$token->isExpired()) {
            return $token->access_token;
        }

        // These public-facing routes can now receive many concurrent requests
        // right around token expiry; without a lock, each would independently
        // refresh the token and race to overwrite the stored record.
        $lock = Cache::lock('digitail.token.refresh', 10);

        try {
            $lock->block(5);

            // Another request may have already refreshed it while we waited.
            $token->refresh();
            if (!$token->isExpired()) {
                return $token->access_token;
            }

            return $this->refreshToken($token);
        } finally {
            $lock->release();
        }
    }

    /**
     * Refresh the access token
     */
    public function refreshToken(DigitailToken $token)
    {
        if (!$token->refresh_token) {
            throw new \Exception('No refresh token available.');
        }

        // Remove trailing slash if present
        $baseUrl = rtrim($this->authBase, '/');

        $response = Http::asForm()->timeout($this->timeout)->post("{$baseUrl}/oauth/token", [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token->refresh_token,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            // 'scope' => 'offline_access', // Optional
        ]);

        if (!$response->successful()) {
            Log::error('Digitail Token Refresh Failed', ['body' => $response->body()]);
            // If refresh fails (e.g. revoked), we might want to delete the token or notify admin
            throw new \Exception('Failed to refresh token: ' . $response->body());
        }

        $data = $response->json();
        
        // Update token record
        // Note: Some providers rotate refresh tokens, some don't. Assuming standard behavior.
        $this->updateToken($token, $data);

        return $data['access_token'];
    }

    /**
     * Store the token response in database
     */
    private function storeToken(array $data)
    {
        // We only keep one active token for the system integration
        // Or we could have per-user tokens, but requirement seems to be system-wide integration
        DigitailToken::truncate(); 

        return DigitailToken::create([
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'] ?? null,
            'token_type' => $data['token_type'] ?? 'Bearer',
            'expires_in' => $data['expires_in'],
            'scope' => $data['scope'] ?? null,
        ]);
    }

    private function updateToken(DigitailToken $token, array $data)
    {
        $token->update([
            'access_token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'] ?? $token->refresh_token, // Keep old if new not provided
            'expires_in' => $data['expires_in'],
            'scope' => $data['scope'] ?? $token->scope,
        ]);
    }

    /**
     * PKCE Code Challenge Generator
     */
    private function generateCodeChallenge($verifier)
    {
        $hash = hash('sha256', $verifier, true);
        return rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');
    }
}
