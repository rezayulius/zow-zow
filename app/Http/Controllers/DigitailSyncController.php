<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\DigitailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class DigitailSyncController extends Controller
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

    public function syncServices(Request $request)
    {
        try {
            $clinicId = $request->get('clinic_id', $this->defaultClinicId);
            
            $allServices = $this->fetchAllServices($clinicId);
            
            if (empty($allServices)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No services found from Digitail API',
                    'data' => []
                ], 404);
            }

            DB::beginTransaction();

            try {
                // Simpan status is_active yang lama
                $existingStatus = DB::select(
                    'SELECT digitail_id, is_active FROM services WHERE digitail_id IS NOT NULL'
                );
                
                $existingMap = [];
                foreach ($existingStatus as $row) {
                    $existingMap[$row->digitail_id] = $row->is_active;
                }

                // Truncate table
                DB::statement('TRUNCATE TABLE services RESTART IDENTITY CASCADE');

                // Prepare data untuk insert
                $insertData = [];
                
                foreach ($allServices as $service) {
                    $digitailId = $service['id'] ?? null;
                    
                    // Tentukan is_active berdasarkan existing atau default false
                    $isActive = $existingMap[$digitailId] ?? false;
                    
                    $category = $service['category'] ?? '';
                    if (is_array($category)) {
                        $category = json_encode($category);
                    }
                    
                    $insertData[] = [
                        'digitail_id' => $digitailId,
                        'name' => $service['name'] ?? null,
                        'client_name' => is_array($service['client_name'] ?? null) 
                            ? json_encode($service['client_name']) 
                            : ($service['client_name'] ?? null),
                        'clinic_id' => $service['clinic_id'] ?? null,
                        'service_id' => $service['service_id'] ?? null,
                        'visit_type_id' => $service['visit_type_id'] ?? null,
                        'unit_price' => $service['unit_price'] ?? null,
                        'price_includes_tax' => $service['price_includes_tax'] ?? false,
                        'tax' => $service['tax'] ?? null,
                        'aaha_code' => is_array($service['aaha_code'] ?? null) 
                            ? json_encode($service['aaha_code']) 
                            : ($service['aaha_code'] ?? null),
                        'barcode' => is_array($service['barcode'] ?? null) 
                            ? json_encode($service['barcode']) 
                            : ($service['barcode'] ?? null),
                        'status' => $service['status'] ?? 'enabled',
                        'lab_tests' => json_encode($service['lab_tests'] ?? []),
                        'aaha_category' => is_array($service['aaha_category'] ?? null) 
                            ? json_encode($service['aaha_category']) 
                            : ($service['aaha_category'] ?? null),
                        'is_plan_benefit' => $service['is_plan_benefit'] ?? false,
                        'title' => $service['name'] ?? 'Untitled Service',
                        'description' => $service['description'] ?? '',
                        'category' => $this->mapCategory($category),
                        'price' => $service['price'] ?? null,
                        'is_active' => $isActive,
                        'sort_order' => 0,
                        'features' => json_encode([]),
                        'icon' => null,
                        'image' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Insert dalam batch
                foreach (array_chunk($insertData, 100) as $chunk) {
                    DB::table('services')->insert($chunk);
                }

                DB::commit();

                $stats = [
                    'total_synced' => count($insertData),
                    'active_count' => DB::table('services')->where('is_active', true)->count(),
                    'inactive_count' => DB::table('services')->where('is_active', false)->count(),
                    'clinic_id' => $clinicId
                ];

                return response()->json([
                    'success' => true,
                    'message' => "Successfully synchronized " . count($insertData) . " services",
                    'data' => $stats
                ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Synchronization failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function fetchAllServices($clinicId)
    {
        $allServices = [];
        $page = 1;
        $hasMorePages = true;

        while ($hasMorePages) {
            try {
                $response = $this->createHttpClient()->get($this->baseUrl . '/service-packages', [
                    'page' => $page,
                    'per_page' => 50,
                    'filter[clinic_id]' => $clinicId
                ]);

                if (!$response->successful()) {
                    break;
                }

                $responseData = $response->json();
                
                if (isset($responseData['data']) && is_array($responseData['data'])) {
                    $allServices = array_merge($allServices, $responseData['data']);
                    $meta = $responseData['meta'] ?? [];
                    $hasMorePages = isset($meta['next_page_url']) && $meta['next_page_url'] !== null;
                    $page++;
                } else {
                    $hasMorePages = false;
                }

            } catch (Exception $e) {
                break;
            }
        }

        return $allServices;
    }

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
            return response()->json([
                'success' => false,
                'message' => 'Failed to get sync status: ' . $e->getMessage()
            ], 500);
        }
    }
}