<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class DigitailSyncController extends Controller
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
     * Synchronize services from Digitail API
     */
    public function syncServices(Request $request)
    {
        try {
            Log::info('Starting Digitail services synchronization');

            // Validate clinic_id parameter
            $clinicId = $request->get('clinic_id', $this->defaultClinicId);
            
            // Fetch all services from Digitail API
            $allServices = $this->fetchAllServices($clinicId);
            
            if (empty($allServices)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No services found from Digitail API',
                    'data' => []
                ], 404);
            }

            // Start database transaction
            DB::beginTransaction();

            try {
                // Truncate services table to ensure fresh data
                Service::truncate();
                Log::info('Services table truncated');

                // Insert new services from Digitail
                $insertedCount = 0;
                foreach ($allServices as $serviceData) {
                    $mappedData = $this->mapServiceData($serviceData);
                    Service::create($mappedData);
                    $insertedCount++;
                }

                DB::commit();
                Log::info("Successfully synchronized {$insertedCount} services from Digitail");

                return response()->json([
                    'success' => true,
                    'message' => "Successfully synchronized {$insertedCount} services from Digitail",
                    'data' => [
                        'total_synced' => $insertedCount,
                        'clinic_id' => $clinicId
                    ]
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            Log::error('Digitail sync error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Synchronization failed: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    /**
     * Fetch all services from Digitail API with pagination
     */
    public function fetchAllServices($clinicId)
    {
        $allServices = [];
        $page = 1;
        $hasMorePages = true;

        while ($hasMorePages) {
            try {
                $queryParams = [
                    'page' => $page,
                    'per_page' => 50, // Fetch more per page for efficiency
                    'filter[clinic_id]' => $clinicId
                ];

                $response = $this->createHttpClient()->get($this->baseUrl . '/service-packages', $queryParams);

                if (!$response->successful()) {
                    Log::error("API request failed on page {$page}: " . $response->body());
                    break;
                }

                $responseData = $response->json();
                
                if (isset($responseData['data']) && is_array($responseData['data'])) {
                    $allServices = array_merge($allServices, $responseData['data']);
                    
                    // Check if there are more pages
                    $meta = $responseData['meta'] ?? [];
                    $hasMorePages = isset($meta['next_page_url']) && $meta['next_page_url'] !== null;
                    $page++;
                    
                    Log::info("Fetched page {$page} with " . count($responseData['data']) . " services");
                } else {
                    $hasMorePages = false;
                }

            } catch (Exception $e) {
                Log::error("Error fetching page {$page}: " . $e->getMessage());
                break;
            }
        }

        return $allServices;
    }

    /**
     * Map Digitail service data to local service model structure
     */
    private function mapServiceData($digitailService)
    {
        return [
            // Digitail specific fields
            'digitail_id' => $digitailService['id'] ?? null,
            'name' => $digitailService['name'] ?? null,
            'client_name' => $digitailService['client_name'] ?? null,
            'clinic_id' => $digitailService['clinic_id'] ?? null,
            'service_id' => $digitailService['service_id'] ?? null,
            'visit_type_id' => $digitailService['visit_type_id'] ?? null,
            'unit_price' => $digitailService['unit_price'] ?? null,
            'price_includes_tax' => $digitailService['price_includes_tax'] ?? false,
            'tax' => $digitailService['tax'] ?? null,
            'aaha_code' => $digitailService['aaha_code'] ?? null,
            'barcode' => $digitailService['barcode'] ?? null,
            'status' => $digitailService['status'] ?? 'enabled',
            'lab_tests' => $digitailService['lab_tests'] ?? [],
            'aaha_category' => $digitailService['aaha_category'] ?? null,
            'is_plan_benefit' => $digitailService['is_plan_benefit'] ?? false,
            
            // Map to existing local fields
            'title' => $digitailService['name'] ?? 'Untitled Service',
            'description' => $digitailService['description'] ?? '',
            'category' => $this->mapCategory($digitailService['category'] ?? ''),
            'price' => $digitailService['price'] ?? null,
            'is_active' => ($digitailService['status'] ?? 'enabled') === 'enabled',
            'sort_order' => 0,
            'features' => [], // Can be populated later if needed
            'icon' => null,
            'image' => null,
        ];
    }

    /**
     * Map Digitail category to local category enum
     */
    private function mapCategory($digitailCategory)
    {
        $categoryMap = [
            'Grooming' => 'Wellness',
            'Vaccinations' => 'Health',
            'Wellness' => 'Wellness',
            'Health' => 'Health',
            'Medical' => 'Health',
            'Preventive' => 'Health',
            'Diagnostic' => 'Health',
            'Treatment' => 'Health',
            'Surgery' => 'Health',
            'Emergency' => 'Health',
        ];

        return $categoryMap[$digitailCategory] ?? 'Wellness';
    }

    /**
     * Get sync status and statistics
     */
    public function getSyncStatus()
    {
        try {
            $totalServices = Service::count();
            $digitailServices = Service::fromDigitail()->count();
            $localServices = Service::local()->count();
            $enabledServices = Service::enabled()->count();
            $disabledServices = Service::disabled()->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total_services' => $totalServices,
                    'digitail_services' => $digitailServices,
                    'local_services' => $localServices,
                    'enabled_services' => $enabledServices,
                    'disabled_services' => $disabledServices,
                    'last_sync' => Service::fromDigitail()->latest('updated_at')->first()?->updated_at,
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error getting sync status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get sync status: ' . $e->getMessage()
            ], 500);
        }
    }
}
