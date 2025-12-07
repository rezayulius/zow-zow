<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DigitailApiController extends Controller
{
    private $baseUrl;
    private $accessToken;
    private $defaultClinicId;
    private $timeout;

    public function __construct()
    {
        $this->baseUrl = config('app.digitail_api_base', env('DIGITAIL_API_BASE'));
        $this->accessToken = env('DIGITAIL_ACCESS_TOKEN');
        $this->defaultClinicId = env('DIGITAIL_DEFAULT_CLINIC_ID', 562);
        $this->timeout = env('DIGITAIL_TIMEOUT', 20);
    }

    /**
     * Create HTTP client with default headers
     */
    private function createHttpClient()
    {
        return Http::timeout($this->timeout)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken,
            ]);
    }

    /**
     * Format API response
     */
    private function formatResponse($response)
    {
        return response()->json([
            'success' => $response->successful(),
            'status' => $response->status(),
            'data' => $response->json(),
            'headers' => $response->headers()
        ], $response->status());
    }

    /**
     * Handle API errors
     */
    private function handleError(\Exception $e, string $endpoint)
    {
        Log::error("Digitail API {$endpoint} error: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'error' => 'API request failed',
            'message' => $e->getMessage()
        ], 500);
    }

    /**
     * Get authenticated user information
     */
    public function getMe()
    {
        try {
            $response = $this->createHttpClient()->get($this->baseUrl . '/auth/me');
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/auth/me');
        }
    }

    /**
     * Get pets list with pagination
     */
    public function getPets(Request $request)
    {
        try {
            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/pets', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/pets');
        }
    }

    /**
     * Get pet parents list with pagination
     */
    public function getPetParents(Request $request)
    {
        try {
            $queryParams = [
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/pet-parents', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/pet-parents');
        }
    }

    /**
     * Get pets by owner ID
     */
    public function getPetsByOwner(Request $request)
    {
        try {
            $ownerId = $request->get('owner_id');

            if (!$ownerId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Owner ID is required'
                ], 400);
            }

            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'filter[owner_id]' => $ownerId,
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/pets', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/pets (by owner)');
        }
    }

    /**
     * Get service packages list with pagination and clinic filter
     */
    public function getServicePackages(Request $request)
    {
        try {
            $queryParams = [
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15),
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/service-packages', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/service-packages');
        }
    }

    /**
     * Get vets list with pagination and clinic filter
     */
    public function getVets(Request $request)
    {
        try {
            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/vets', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/vets');
        }
    }

    /**
     * Generic API proxy method for other endpoints
     */
    public function proxyRequest(Request $request, $endpoint)
    {
        try {
            $method = strtoupper($request->method());
            $queryParams = $request->query();
            $bodyData = $request->all();

            // Remove Laravel specific parameters
            unset($bodyData['_token']);

            $httpClient = $this->createHttpClient();
            $url = $this->baseUrl . '/' . ltrim($endpoint, '/');

            $response = match ($method) {
                'GET' => $httpClient->get($url, $queryParams),
                'POST' => $httpClient->post($url, $bodyData),
                'PUT' => $httpClient->put($url, $bodyData),
                'DELETE' => $httpClient->delete($url, $bodyData),
                default => throw new \InvalidArgumentException('Method not allowed')
            };

            return $this->formatResponse($response);

        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Method not allowed'
            ], 405);
        } catch (\Exception $e) {
            return $this->handleError($e, "proxy:{$endpoint}");
        }
    }
}