<?php

namespace App\Services;

use App\Models\DigitailToken;
use Carbon\Carbon;
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
     * How long dashboard report responses are cached for. Several Filament
     * widgets independently call getAppointments()/getPetsReportAggregated()
     * on every render (some polling every 30s); without a shared cache each
     * dashboard load fired ~8 duplicate calls to the same Digitail endpoints.
     */
    private const REPORT_CACHE_TTL = 60;

    /**
     * Get Aggregated Pets Report
     */
    public function getPetsReportAggregated()
    {
        return Cache::remember('digitail.pets_report_aggregated', self::REPORT_CACHE_TTL, function () {
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
        });
    }

    /**
     * Get Appointments Report, optionally scoped to a date range (Y-m-d).
     * Supports `date_between` server-side.
     */
    public function getAppointments(int $page = 1, int $perPage = 15, ?string $startDate = null, ?string $endDate = null)
    {
        $clinicId = config('services.digitail.default_clinic_id');
        $params = ['filter[clinic_id]' => $clinicId];

        if ($startDate && $endDate) {
            $params['filter[date_between]'] = "{$startDate},{$endDate}";
        }

        return $this->getCachedList('appointments', '/reports/appointments', $params, $page, $perPage);
    }

    /**
     * Shared cached GET helper for clinic-scoped report/list endpoints, mirroring
     * getAppointments()/getPetsReportAggregated() above so new Filament widgets
     * don't each reinvent caching + error handling.
     */
    private function getCachedList(string $cacheKey, string $path, array $params, int $page, int $perPage): ?array
    {
        $fullCacheKey = "digitail.{$cacheKey}." . md5(serialize($params)) . ".{$page}.{$perPage}";

        return Cache::remember($fullCacheKey, self::REPORT_CACHE_TTL, function () use ($path, $params, $page, $perPage) {
            $accessToken = $this->getAccessToken();

            $response = Http::withToken($accessToken)
                ->timeout($this->timeout)
                ->get("{$this->apiBase}{$path}", array_merge($params, [
                    'page' => $page,
                    'per_page' => $perPage,
                ]));

            if (!$response->successful()) {
                Log::error("Digitail {$path} report failed", ['body' => $response->body()]);
                return null;
            }

            return $response->json();
        });
    }

    /**
     * Get sales (revenue transactions), used by the Financial dashboard widgets.
     * Date range filters on `created_at` (Y-m-d).
     */
    public function getSales(int $page = 1, int $perPage = 100, ?string $startDate = null, ?string $endDate = null)
    {
        $clinicId = config('services.digitail.default_clinic_id');
        $params = ['filter[clinic_id]' => $clinicId];

        if ($startDate && $endDate) {
            $params['filter[created_at]'] = "{$startDate},{$endDate}";
        }

        return $this->getCachedList('sales', '/sales', $params, $page, $perPage);
    }

    /**
     * Get invoices, used by the Financial dashboard widgets. Date range filters
     * on `updated_at` (the closest available field) — this endpoint requires a
     * full ISO-8601 UTC timestamp, unlike the other endpoints' plain Y-m-d.
     */
    public function getInvoices(int $page = 1, int $perPage = 100, ?string $startDate = null, ?string $endDate = null)
    {
        $clinicId = config('services.digitail.default_clinic_id');
        $params = ['filter[clinic_id]' => $clinicId];

        if ($startDate && $endDate) {
            $params['filter[updated_from]'] = Carbon::parse($startDate)->startOfDay()->utc()->format('Y-m-d\TH:i:s\Z');
            $params['filter[updated_to]'] = Carbon::parse($endDate)->endOfDay()->utc()->format('Y-m-d\TH:i:s\Z');
        }

        return $this->getCachedList('invoices', '/invoices', $params, $page, $perPage);
    }

    /**
     * Get credit notes (refunds/credits), used by the Financial dashboard
     * widgets. Date range filters on `made_at` (Y-m-d).
     */
    public function getCreditNotes(int $page = 1, int $perPage = 100, ?string $startDate = null, ?string $endDate = null)
    {
        $clinicId = config('services.digitail.default_clinic_id');
        $params = ['filter[clinic_id]' => $clinicId];

        if ($startDate && $endDate) {
            $params['filter[made_at]'] = "{$startDate},{$endDate}";
        }

        return $this->getCachedList('credit_notes', '/credit-notes', $params, $page, $perPage);
    }

    /**
     * Get lab orders, used by the Clinical dashboard widgets. This endpoint has
     * no date filter and ignores pagination (Digitail always returns the full
     * list) — callers that need a date range filter the returned `created_at`
     * client-side.
     */
    public function getLabOrders(int $page = 1, int $perPage = 100)
    {
        $clinicId = config('services.digitail.default_clinic_id');

        return $this->getCachedList('lab_orders', '/integrations/labs/orders', ['filter[clinic_id]' => $clinicId], $page, $perPage);
    }

    /**
     * Get reminder protocol usages (vaccine/treatment reminders), used by the
     * CRM dashboard widgets. "administration_date" is null while a reminder is
     * still pending — the API has no reliable server-side "overdue" filter.
     * Date range filters on `due_date` via the one-sided `date_after`/`date_before`.
     */
    public function getReminderProtocolUsages(int $page = 1, int $perPage = 100, ?string $startDate = null, ?string $endDate = null)
    {
        $clinicId = config('services.digitail.default_clinic_id');
        $params = ['filter[clinic_id]' => $clinicId];

        if ($startDate) {
            $params['filter[date_after]'] = $startDate;
        }

        if ($endDate) {
            $params['filter[date_before]'] = $endDate;
        }

        return $this->getCachedList('reminder_protocol_usages', '/reminder-protocol-usages', $params, $page, $perPage);
    }

    /**
     * Get the species reference list (id => label), used to join species names
     * onto pet records that only carry a species_id. Static reference data,
     * so it's cached far longer than the report endpoints above.
     */
    public function getSpecies(): array
    {
        return Cache::remember('digitail.species', now()->addDay(), function () {
            $accessToken = $this->getAccessToken();

            $response = Http::withToken($accessToken)
                ->timeout($this->timeout)
                ->get("{$this->apiBase}/species", ['per_page' => 100]);

            if (!$response->successful()) {
                Log::error('Digitail Species Failed', ['body' => $response->body()]);
                return [];
            }

            return collect($response->json('data'))->pluck('label', 'id')->all();
        });
    }

    /**
     * Get pet parents, used by the CRM dashboard widgets. This endpoint isn't
     * clinic_id-filterable (the token is already clinic-scoped).
     */
    public function getPetParents(int $page = 1, int $perPage = 100)
    {
        return $this->getCachedList('pet_parents', '/pet-parents', [], $page, $perPage);
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

    /**
     * Fetch veterinarians data from Digitail API (cached — this backs the homepage
     * and every service detail page, so a slow/unreachable Digitail API must never
     * block page load). Shared by HomeController and clinic service detail pages
     * resolving their assigned doctors.
     */
    public function getVets()
    {
        $cached = Cache::get('digitail.vets');
        if ($cached !== null) {
            return $cached;
        }

        $vets = $this->getVetsUncached();

        // Only cache successful, non-empty results so a transient API failure
        // doesn't get "locked in" and hide the vets section for a full hour.
        if (!empty($vets)) {
            Cache::put('digitail.vets', $vets, now()->addMinutes(60));
        }

        return $vets;
    }

    private function getVetsUncached()
    {
        try {
            $baseUrl = $this->apiBase;
            $accessToken = $this->getAccessToken();
            $clinicId = config('services.digitail.default_clinic_id');

            $allVets = [];
            $page = 1;
            $perPage = 50; // Fetch more per page to minimize requests
            $hasMore = true;

            while ($hasMore) {
                $response = Http::timeout(10)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $accessToken,
                    ])
                    ->get($baseUrl . '/vets', [
                        'filter[clinic_id]' => $clinicId,
                        'page' => $page,
                        'per_page' => $perPage
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $vets = $data['data'] ?? [];

                    if (empty($vets)) {
                        $hasMore = false;
                        break;
                    }

                    $allVets = array_merge($allVets, $vets);

                    // Check if we need to fetch next page
                    // Based on meta or just if we got full page
                    $meta = $data['meta'] ?? [];
                    if (isset($meta['current_page']) && isset($meta['last_page'])) {
                        $hasMore = $meta['current_page'] < $meta['last_page'];
                    } else {
                        // Fallback: if we got less than perPage, it's the last page
                        $hasMore = count($vets) >= $perPage;
                    }

                    $page++;
                } else {
                    Log::warning('Failed to fetch vets from Digitail API', [
                        'status' => $response->status(),
                        'response' => $response->body()
                    ]);
                    $hasMore = false;
                }
            }

            Log::info('Total Raw Vets Fetched: ' . count($allVets));

            // Filter only vets with type = 'veterinarian'
            $filteredVets = array_filter($allVets, function ($vet) {
                return isset($vet['type']) && $vet['type'] === 'veterinarian';
            });

            Log::info('Filtered Vets Count: ' . count($filteredVets));

            // Re-index array to avoid gaps in array keys
            // If filtering results in empty array, return all vets for now (based on user request showing other types in sample)
            if (empty($filteredVets) && !empty($allVets)) {
                return $allVets;
            }

            return array_values($filteredVets);

        } catch (\Exception $e) {
            Log::error('Error fetching vets from Digitail API: ' . $e->getMessage());
            return [];
        }
    }
}
