<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DigitailApiController extends Controller
{
    private $baseUrl;
    private $defaultClinicId;
    private $timeout;
    private $digitailService;

    public function __construct(DigitailService $digitailService)
    {
        $this->digitailService = $digitailService;
        $this->baseUrl = config('services.digitail.api_base');
        $this->defaultClinicId = config('services.digitail.default_clinic_id');
        $this->timeout = config('services.digitail.timeout');
    }

    /**
     * Create HTTP client with default headers
     */
    private function createHttpClient()
    {
        $accessToken = $this->digitailService->getAccessToken();

        return Http::timeout($this->timeout)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken,
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
     * Get pet parent by email
     */
    public function getPetParentByEmail(Request $request)
    {
        try {
            $email = $request->get('email');

            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email is required'
                ], 400);
            }

            // Fetch all pet parents
            $queryParams = [
                'page' => 1,
                'per_page' => 100 // Get more records to search through
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/pet-parents', $queryParams);

            if ($response->successful()) {
                $data = $response->json();
                $petParents = $data['data'] ?? [];

                // Find pet parent by email (case-insensitive)
                $foundParent = null;
                foreach ($petParents as $parent) {
                    if (strtolower($parent['email']) === strtolower($email)) {
                        $foundParent = $parent;
                        break;
                    }
                }

                if ($foundParent) {
                    return response()->json([
                        'success' => true,
                        'status' => 200,
                        'data' => $foundParent,
                        'message' => 'Pet parent found'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'status' => 404,
                        'message' => 'Pet parent not found with email: ' . $email
                    ], 404);
                }
            }

            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/pet-parents (by email)');
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
     * Get a veterinarian's schedule for a date range and visit type
     */
    public function getVetSchedule(Request $request)
    {
        try {
            $vetId = $request->get('vet_id');
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            $visitTypeId = $request->get('visit_type_id');

            if (!$vetId || !$startDate || !$endDate || !$visitTypeId) {
                return response()->json([
                    'success' => false,
                    'message' => 'vet_id, start_date, end_date and visit_type_id are required'
                ], 400);
            }

            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'filter[start_date]' => $startDate,
                'filter[end_date]' => $endDate,
                'visit_type_id' => $visitTypeId,
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . "/vets/{$vetId}/schedule", $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/vets/{vet_id}/schedule');
        }
    }

    /**
     * Get visit types list with pagination and clinic filter
     */
    public function getVisitTypes(Request $request)
    {
        try {
            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 15)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/visit-types', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/visit-types');
        }
    }

    /**
     * Get medical records by pet ID
     */
    public function getRecordsByPet(Request $request)
    {
        try {
            $petId = $request->get('pet_id');

            if (!$petId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pet ID is required'
                ], 400);
            }

            $queryParams = [
                'filter[clinic_id]' => $request->get('clinic_id', $this->defaultClinicId),
                'filter[pet_id]' => $petId,
                'page' => $request->get('page', 1),
                'per_page' => $request->get('per_page', 50)
            ];

            $response = $this->createHttpClient()->get($this->baseUrl . '/records', $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, '/records (by pet)');
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