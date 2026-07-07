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

            $stats = $this->syncServicesData($allServices, $clinicId);

            return response()->json([
                'success' => true,
                'message' => "Successfully synchronized " . $stats['total_synced'] . " services",
                'data' => $stats
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Synchronization failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Upserts services fetched from Digitail, keyed by digitail_id.
     *
     * Unlike a truncate+reinsert, this never touches locally-added services
     * (digitail_id IS NULL) and preserves admin-managed columns (icon, image,
     * sort_order, is_active) on rows that already exist instead of nulling
     * them out on every sync. Services no longer returned by the API are
     * removed, but only among digitail-sourced rows.
     */
    public function syncServicesData(array $allServices, $clinicId): array
    {
        DB::beginTransaction();

        try {
            // Simpan status is_active yang lama
            $existingStatus = DB::table('services')
                ->whereNotNull('digitail_id')
                ->pluck('is_active', 'digitail_id');

            $seenDigitailIds = [];
            $upsertData = [];

            foreach ($allServices as $service) {
                $digitailId = $service['id'] ?? null;

                if ($digitailId === null) {
                    continue;
                }

                $seenDigitailIds[] = $digitailId;

                // Tentukan is_active berdasarkan existing atau default false
                $isActive = $existingStatus[$digitailId] ?? false;

                $category = $service['category'] ?? '';
                if (is_array($category)) {
                    $category = json_encode($category);
                }

                $upsertData[] = [
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
                    // sort_order/icon/image are admin-managed locally and are
                    // intentionally omitted from $updateColumns below so an
                    // existing row's values are left untouched.
                    'sort_order' => 0,
                    'features' => json_encode([]),
                    'icon' => null,
                    'image' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $updateColumns = [
                'name', 'client_name', 'clinic_id', 'service_id', 'visit_type_id',
                'unit_price', 'price_includes_tax', 'tax', 'aaha_code', 'barcode',
                'status', 'lab_tests', 'aaha_category', 'is_plan_benefit',
                'title', 'description', 'category', 'price', 'is_active', 'updated_at',
            ];

            foreach (array_chunk($upsertData, 100) as $chunk) {
                DB::table('services')->upsert($chunk, ['digitail_id'], $updateColumns);
            }

            // Remove digitail-sourced services no longer returned by the API.
            // Locally-added services (digitail_id IS NULL) are never touched.
            DB::table('services')
                ->whereNotNull('digitail_id')
                ->whereNotIn('digitail_id', $seenDigitailIds)
                ->delete();

            DB::commit();

            return [
                'total_synced' => count($upsertData),
                'active_count' => DB::table('services')->where('is_active', true)->count(),
                'inactive_count' => DB::table('services')->where('is_active', false)->count(),
                'clinic_id' => $clinicId,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
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