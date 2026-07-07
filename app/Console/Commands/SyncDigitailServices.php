<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DigitailSyncController;

class SyncDigitailServices extends Command
{
    protected $signature = 'digitail:sync {--clinic_id=}';
    protected $description = 'Sinkronisasi data services dari Digitail API';

    public function handle(DigitailSyncController $controller)
    {
        $this->info('=== MULAI SINKRONISASI DIGITAIL ===');
        $startTime = now();

        Log::info('=== CRON: MULAI SINKRONISASI DIGITAIL ===', [
            'waktu_mulai' => $startTime->format('Y-m-d H:i:s T'),
            'triggered_by' => 'cron_job',
        ]);

        try {
            $clinicId = $this->option('clinic_id') ?? config('services.digitail.default_clinic_id');

            $baseUrl = config('services.digitail.api_base');
            if (!$baseUrl || !$clinicId) {
                $this->error('Konfigurasi Digitail tidak lengkap!');
                Log::error('Konfigurasi Digitail tidak lengkap');
                return 1;
            }

            $this->info("Mengambil data dari Digitail API (Clinic ID: {$clinicId})...");

            $servicePackages = $controller->fetchAllServices($clinicId);

            if (empty($servicePackages)) {
                $this->warn('Tidak ada data yang ditemukan dari API');
                Log::warning('Tidak ada service packages dari Digitail API');
                return 0;
            }

            $this->info('Total services dari API: ' . count($servicePackages));
            $this->info('Menyimpan data ke database...');

            $stats = $controller->syncServicesData($servicePackages, $clinicId);

            $endTime = now();
            $duration = $startTime->diffInSeconds($endTime);

            $this->newLine();
            $this->info('✓ SINKRONISASI BERHASIL!');
            $this->table(
                ['Metric', 'Value'],
                [
                    ['Total Services', $stats['total_synced']],
                    ['Active Services', $stats['active_count']],
                    ['Inactive Services', $stats['inactive_count']],
                    ['Duration', "{$duration} detik"],
                    ['Waktu Selesai', $endTime->format('Y-m-d H:i:s T')],
                ]
            );

            Log::info('=== CRON: SINKRONISASI BERHASIL ===', [
                'waktu_selesai' => $endTime->format('Y-m-d H:i:s T'),
                'total_synced' => $stats['total_synced'],
                'active_count' => $stats['active_count'],
                'inactive_count' => $stats['inactive_count'],
                'duration_seconds' => $duration,
            ]);

            return 0;

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
}
