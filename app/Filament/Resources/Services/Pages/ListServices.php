<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use App\Models\Service;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('sync_digitail')
                ->label('Sinkronisasi Digitail')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(function () {
                    return $this->syncDigitailData();
                })
                ->requiresConfirmation()
                ->modalHeading('Sinkronisasi Data Digitail')
                ->modalDescription('Apakah Anda yakin ingin melakukan sinkronisasi data dari Digitail API? Data yang sudah ada akan diperbarui dan data baru akan ditambahkan.')
                ->modalSubmitActionLabel('Ya, Sinkronisasi Sekarang')
                ->modalCancelActionLabel('Batal'),
        ];
    }

    private function mapCategory($digitailCategory)
    {
        if (is_array($digitailCategory)) {
            // Jika kategori berupa array, ambil nilai pertama atau default
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

    private function syncDigitailData()
    {
        try {
            // Validasi konfigurasi API
            $baseUrl = config('services.digitail.api_base');
            $clinicId = config('services.digitail.default_clinic_id');

            if (!$baseUrl || !$clinicId) {
                Notification::make()
                    ->title('Konfigurasi API Tidak Lengkap')
                    ->body('Pastikan konfigurasi Digitail sudah lengkap.')
                    ->danger()
                    ->send();
                return;
            }

            // Fetch data dari Digitail API
            $controller = app(\App\Http\Controllers\DigitailSyncController::class);
            $servicePackages = $controller->fetchAllServices($clinicId);

            if (empty($servicePackages)) {
                Notification::make()
                    ->title('Tidak Ada Data')
                    ->body('Tidak ada service packages yang ditemukan dari Digitail API.')
                    ->warning()
                    ->send();
                return;
            }

            $syncedCount = 0;
            $updatedCount = 0;
            $now = now();

            foreach ($servicePackages as $package) {
                // Cari service berdasarkan digitail_id
                $service = Service::where('digitail_id', $package['id'])->first();

                // Data untuk field Digitail
                $digitailData = [
                    'digitail_id' => $package['id'],
                    'name' => $package['name'],
                    'client_name' => is_array($package['client_name'] ?? null) ? json_encode($package['client_name']) : ($package['client_name'] ?? null),
                    'clinic_id' => $package['clinic_id'],
                    'service_id' => $package['service_id'],
                    'visit_type_id' => $package['visit_type_id'],
                    'unit_price' => $package['unit_price'],
                    'price_includes_tax' => $package['price_includes_tax'] ?? false,
                    'tax' => $package['tax'] ?? null,
                    'aaha_code' => is_array($package['aaha_code'] ?? null) ? json_encode($package['aaha_code']) : ($package['aaha_code'] ?? null),
                    'barcode' => is_array($package['barcode'] ?? null) ? json_encode($package['barcode']) : ($package['barcode'] ?? null),
                    'status' => $package['status'] ?? 'enabled',
                    'lab_tests' => $package['lab_tests'] ?? [],
                    'aaha_category' => is_array($package['aaha_category'] ?? null) ? json_encode($package['aaha_category']) : ($package['aaha_category'] ?? null),
                    'is_plan_benefit' => $package['is_plan_benefit'] ?? false,
                    'digitail_synced_at' => $now,
                ];

                // Map category correctly using helper function
                $rawCategory = $package['category'] ?? ($package['client_name'] ?? '');
                $category = $this->mapCategory($rawCategory);

                if ($service) {
                    // PERBAIKAN: Update existing service - PERTAHANKAN is_active yang lama
                    $updateData = array_merge($digitailData, [
                        'title' => $package['name'],
                        'description' => $package['description'] ?? $service->description,
                        'category' => $category,
                        'price' => $package['unit_price'],
                        // HAPUS baris ini: 'is_active' => $package['status'] === 'enabled',
                        // is_active TIDAK diupdate, biarkan tetap seperti nilai sebelumnya
                    ]);
                    $service->update($updateData);
                    $updatedCount++;
                } else {
                    // PERBAIKAN: Create new service - DEFAULT is_active = FALSE
                    $serviceData = array_merge($digitailData, [
                        'title' => $package['name'],
                        'description' => $package['description'] ?? 'Service dari Digitail',
                        'category' => $category,
                        'price' => $package['unit_price'],
                        'is_active' => false, // <<< DEFAULT FALSE untuk service baru
                        'sort_order' => 0,
                    ]);
                    
                    Service::create($serviceData);
                    $syncedCount++;
                }
            }

            Notification::make()
                ->title('Sinkronisasi Berhasil')
                ->body("Berhasil menambahkan {$syncedCount} service baru dan memperbarui {$updatedCount} service yang sudah ada.")
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Sinkronisasi Gagal')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
