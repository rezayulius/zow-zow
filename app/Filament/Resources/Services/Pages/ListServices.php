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
                    'client_name' => $package['client_name'] ?? null,
                    'clinic_id' => $package['clinic_id'],
                    'service_id' => $package['service_id'],
                    'visit_type_id' => $package['visit_type_id'],
                    'unit_price' => $package['unit_price'],
                    'price_includes_tax' => $package['price_includes_tax'] ?? false,
                    'tax' => $package['tax'] ?? null,
                    'aaha_code' => $package['aaha_code'] ?? null,
                    'barcode' => $package['barcode'] ?? null,
                    'status' => $package['status'] ?? 'enabled',
                    'lab_tests' => $package['lab_tests'] ?? null,
                    'aaha_category' => $package['aaha_category'] ?? null,
                    'is_plan_benefit' => $package['is_plan_benefit'] ?? false,
                    'digitail_synced_at' => $now,
                ];

                if ($service) {
                    // Update existing service - update field Digitail dan field lokal
                    $updateData = array_merge($digitailData, [
                        'title' => $package['name'],
                        'description' => $package['description'] ?? $service->description,
                        'category' => $package['client_name'] ?? $service->category,
                        'price' => $package['unit_price'],
                        'is_active' => $package['status'] === 'enabled',
                    ]);
                    $service->update($updateData);
                    $updatedCount++;
                } else {
                    // Create new service dengan mapping ke field lokal
                    $serviceData = array_merge($digitailData, [
                        'title' => $package['name'],
                        'description' => $package['description'] ?? 'Service dari Digitail',
                        'category' => $package['client_name'] ?? 'Health', // client_name dari API menjadi category
                        'price' => $package['unit_price'],
                        'is_active' => $package['status'] === 'enabled',
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
