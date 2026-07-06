<?php

namespace App\Http\Controllers;

use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
     * Shared GET-and-format helper used by every read-only proxy action below,
     * so the request/response/error shape only needs to be fixed in one place.
     */
    private function proxyGet(string $path, array $queryParams, string $errorContext)
    {
        try {
            $response = $this->createHttpClient()->get($this->baseUrl . $path, $queryParams);
            return $this->formatResponse($response);
        } catch (\Exception $e) {
            return $this->handleError($e, $errorContext);
        }
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
        ], $response->status());
    }

    /**
     * Handle API errors. The raw exception is logged server-side only —
     * some of these endpoints are public and must never echo internal
     * exception text (which can carry upstream URLs or request details)
     * back to an anonymous caller.
     */
    private function handleError(\Exception $e, string $endpoint)
    {
        Log::error("Digitail API {$endpoint} error: " . $e->getMessage());

        return response()->json([
            'success' => false,
            'error' => 'API request failed',
            'message' => 'Terjadi kesalahan saat menghubungi layanan Digitail. Silakan coba lagi.',
        ], 500);
    }

    /**
     * A required id/parameter that must be a positive integer (used for any
     * value interpolated into the upstream URL path, not just query params).
     */
    private function invalidPositiveInt($value): bool
    {
        return !ctype_digit((string) $value) || (int) $value < 1;
    }

    private function invalidDate($value): bool
    {
        return !is_string($value) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $value);
    }

    /**
     * Get authenticated user information
     */
    public function getMe()
    {
        return $this->proxyGet('/auth/me', [], '/auth/me');
    }

    /**
     * Get pets list with pagination
     */
    public function getPets(Request $request)
    {
        return $this->proxyGet('/pets', [
            'filter[clinic_id]' => $this->defaultClinicId,
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 15),
        ], '/pets');
    }

    /**
     * Get pet parents list with pagination
     */
    public function getPetParents(Request $request)
    {
        return $this->proxyGet('/pet-parents', [
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 15),
        ], '/pet-parents');
    }

    /**
     * Get pets by owner ID
     */
    public function getPetsByOwner(Request $request)
    {
        $ownerId = $request->get('owner_id');

        if (!$ownerId) {
            return response()->json([
                'success' => false,
                'message' => 'Owner ID is required'
            ], 400);
        }

        return $this->proxyGet('/pets', [
            'filter[clinic_id]' => $this->defaultClinicId,
            'filter[owner_id]' => $ownerId,
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 15),
        ], '/pets (by owner)');
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
        return $this->proxyGet('/service-packages', [
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 15),
            'filter[clinic_id]' => $this->defaultClinicId,
        ], '/service-packages');
    }

    /**
     * Get vets list with pagination and clinic filter
     */
    public function getVets(Request $request)
    {
        return $this->proxyGet('/vets', [
            'filter[clinic_id]' => $this->defaultClinicId,
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 15),
        ], '/vets');
    }

    /**
     * Get a veterinarian's schedule for a date range and visit type.
     *
     * Reachable from an unauthenticated public route (the homepage booking
     * widget), so every input that ends up in the upstream URL/query is
     * validated here rather than trusted.
     */
    public function getVetSchedule(Request $request)
    {
        $vetId = $request->get('vet_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $visitTypeId = $request->get('visit_type_id');

        if ($this->invalidPositiveInt($vetId) || $this->invalidPositiveInt($visitTypeId)) {
            return response()->json([
                'success' => false,
                'message' => 'vet_id and visit_type_id must be positive integers',
            ], 422);
        }

        if ($this->invalidDate($startDate) || $this->invalidDate($endDate)) {
            return response()->json([
                'success' => false,
                'message' => 'start_date and end_date must be in YYYY-MM-DD format',
            ], 422);
        }

        return $this->proxyGet("/vets/{$vetId}/schedule", [
            'filter[clinic_id]' => $this->defaultClinicId,
            'filter[start_date]' => $startDate,
            'filter[end_date]' => $endDate,
            'visit_type_id' => $visitTypeId,
        ], '/vets/{vet_id}/schedule');
    }

    /**
     * Get visit types list, cached — this is near-static reference data and
     * this endpoint is public, so every visitor who opens the booking widget
     * would otherwise trigger a live upstream call.
     */
    public function getVisitTypes(Request $request)
    {
        $cacheKey = "digitail.visit_types.{$this->defaultClinicId}";

        $payload = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($request) {
            $response = $this->createHttpClient()->get($this->baseUrl . '/visit-types', [
                'filter[clinic_id]' => $this->defaultClinicId,
                'page' => 1,
                'per_page' => $request->get('per_page', 100),
            ]);

            if (!$response->successful()) {
                return null;
            }

            return [
                'success' => true,
                'status' => $response->status(),
                'data' => $response->json(),
            ];
        });

        if ($payload === null) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat visit types.',
            ], 502);
        }

        return response()->json($payload, $payload['status']);
    }

    /**
     * Get medical records by pet ID
     */
    public function getRecordsByPet(Request $request)
    {
        $petId = $request->get('pet_id');

        if (!$petId) {
            return response()->json([
                'success' => false,
                'message' => 'Pet ID is required'
            ], 400);
        }

        return $this->proxyGet('/records', [
            'filter[clinic_id]' => $this->defaultClinicId,
            'filter[pet_id]' => $petId,
            'page' => $request->get('page', 1),
            'per_page' => $request->get('per_page', 50),
        ], '/records (by pet)');
    }

    /**
     * Generic API proxy method for other endpoints (admin testing tool only)
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
