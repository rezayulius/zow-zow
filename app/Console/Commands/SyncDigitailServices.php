<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class SyncDigitailServices extends Command
{
    protected $signature = 'digitail:sync {--clinic_id=}';
    protected $description = 'Sinkronisasi data services dari Digitail API';

    public function handle()
    {
        $this->info('=== MULAI SINKRONISASI DIGITAIL ===');
        $startTime = now();
        
        Log::info('=== CRON: MULAI SINKRONISASI DIGITAIL ===', [
            'waktu_mulai' => $startTime->format('Y-m-d H:i:s T'),
            'triggered_by' => 'cron_job',
        ]);

        try {
            $clinicId = $this->option('clinic_id') ?? config('services.digitail.default_clinic_id');
            
            // Validasi konfigurasi
            $baseUrl = config('services.digitail.api_base');
            if (!$baseUrl || !$clinicId) {
                $this->error('Konfigurasi Digitail tidak lengkap!');
                Log::error('Konfigurasi Digitail tidak lengkap');
                return 1;
            }

            $this->info("Mengambil data dari Digitail API (Clinic ID: {$clinicId})...");
            
            // Fetch data dari API
            $controller = app(\App\Http\Controllers\DigitailSyncController::class);
            $servicePackages = $controller->fetchAllServices($clinicId);

            if (empty($servicePackages)) {
                $this->warn('Tidak ada data yang ditemukan dari API');
                Log::warning('Tidak ada service packages dari Digitail API');
                return 0;
            }

            $this->info('Total services dari API: ' . count($servicePackages));

            DB::beginTransaction();

            try {
                // Simpan status is_active yang lama
                $existingServices = DB::select(
                    'SELECT digitail_id, is_active FROM services WHERE digitail_id IS NOT NULL'
                );
                
                $existingMap = [];
                foreach ($existingServices as $row) {
                    $existingMap[$row->digitail_id] = $row->is_active;
                }

                $this->info('Existing services: ' . count($existingMap));

                // Truncate table
                DB::statement('TRUNCATE TABLE services RESTART IDENTITY CASCADE');
                $this->info('Table services di-truncate');

                // Prepare data untuk insert
                $insertData = [];
                $progressBar = $this->output->createProgressBar(count($servicePackages));
                $progressBar->start();

                foreach ($servicePackages as $service) {
                    $digitailId = $service['id'] ?? null;
                    
                    // Tentukan is_active: pertahankan yang lama, atau false untuk service baru
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

                    $progressBar->advance();
                }

                $progressBar->finish();
                $this->newLine();

                // Insert dalam batch
                $this->info('Menyimpan data ke database...');
                foreach (array_chunk($insertData, 100) as $chunk) {
                    DB::table('services')->insert($chunk);
                }

                DB::commit();

                $endTime = now();
                $duration = $startTime->diffInSeconds($endTime);

                $activeCount = DB::table('services')->where('is_active', true)->count();
                $inactiveCount = DB::table('services')->where('is_active', false)->count();

                $this->newLine();
                $this->info('✓ SINKRONISASI BERHASIL!');
                $this->table(
                    ['Metric', 'Value'],
                    [
                        ['Total Services', count($insertData)],
                        ['Active Services', $activeCount],
                        ['Inactive Services', $inactiveCount],
                        ['Duration', "{$duration} detik"],
                        ['Waktu Selesai', $endTime->format('Y-m-d H:i:s T')],
                    ]
                );

                Log::info('=== CRON: SINKRONISASI BERHASIL ===', [
                    'waktu_selesai' => $endTime->format('Y-m-d H:i:s T'),
                    'total_synced' => count($insertData),
                    'active_count' => $activeCount,
                    'inactive_count' => $inactiveCount,
                    'duration_seconds' => $duration,
                ]);

                return 0;

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Exception $e) {
            $this->error('Sinkronisasi gagal: ' . $e->getMessage());
            
            Log::error('=== CRON: SINKRONISASI GAGAL ===', [
                'waktu_error' => now()->format('Y-m-d H:i:s T'),
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return 1;
        }
    }

    private function mapCategory($digitailCategory)
    {
        if (is_array($digitailCategory)) {
            $digitailCategory = reset($digitailCategory);
        }

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
}