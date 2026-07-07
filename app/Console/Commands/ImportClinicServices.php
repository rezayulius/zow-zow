<?php

namespace App\Console\Commands;

use App\Models\ClinicService;
use App\Models\ServiceCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportClinicServices extends Command
{
    protected $signature = 'clinic-services:import {category : Slug kategori, mis. health} {path : Path file JSON, relatif ke storage/app atau absolut}';

    protected $description = 'Import ClinicService secara bulk dari file JSON (nama, konten, foto, FAQ)';

    // Dipakai kalau field terkait tidak diisi pada item JSON, supaya prompt ChatGPT
    // tidak perlu mengulang data klinik yang sama di setiap layanan.
    private const DEFAULT_ADDRESS = 'Jl. Prapanca Raya No.25A, RT.2/RW.3, Pulo, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12160';

    private const DEFAULT_OPERATING_HOURS = [
        'Setiap Hari' => '07:00 AM - 10:00 PM',
    ];

    private const DEFAULT_BOOKING_CTA_URL = 'https://vet.digitail.io/clinics/zow-vet-clinic';

    private const DEFAULT_VET_IDS = ['39926', '47088', '48388', '53395'];

    public function handle(): int
    {
        $categorySlug = $this->argument('category');
        $path = $this->argument('path');
        $fullPath = str_starts_with($path, '/') ? $path : storage_path('app/'.$path);

        if (! file_exists($fullPath)) {
            $this->error("File tidak ditemukan: {$fullPath}");

            return self::FAILURE;
        }

        $category = ServiceCategory::where('slug', $categorySlug)->first();

        if (! $category) {
            $this->error("Kategori dengan slug '{$categorySlug}' tidak ditemukan.");

            return self::FAILURE;
        }

        $items = json_decode(file_get_contents($fullPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('JSON tidak valid: '.json_last_error_msg());

            return self::FAILURE;
        }

        $created = 0;

        foreach ($items as $i => $item) {
            if (empty($item['name']['en']) && empty($item['name']['id'])) {
                $this->warn("Item #{$i} dilewati: field 'name' kosong.");

                continue;
            }

            DB::transaction(function () use ($item, $category, &$created) {
                $service = new ClinicService;
                $service->service_category_id = $category->id;
                $service->name = $item['name'];
                $service->excerpt = $item['excerpt'] ?? null;
                $service->content = $item['content'] ?? null;
                $service->address = $item['address'] ?? self::DEFAULT_ADDRESS;
                $service->operating_hours = $item['operating_hours'] ?? self::DEFAULT_OPERATING_HOURS;
                $service->whatsapp_message = $item['whatsapp_message'] ?? null;
                $service->booking_cta_url = $item['booking_cta_url'] ?? self::DEFAULT_BOOKING_CTA_URL;
                $service->meta_title = $item['meta_title'] ?? null;
                $service->meta_description = $item['meta_description'] ?? null;
                $service->is_active = $item['is_active'] ?? true;
                $service->sort_order = $item['sort_order'] ?? 0;

                if (! empty($item['slug'])) {
                    $service->slug = $item['slug'];
                }

                $service->save();

                foreach ($item['images'] ?? [] as $imgIndex => $img) {
                    $service->images()->create([
                        'image' => $img['image'],
                        'alt_text' => $img['alt_text'] ?? null,
                        'type' => $img['type'] ?? 'service',
                        'sort_order' => $img['sort_order'] ?? $imgIndex,
                    ]);
                }

                foreach ($item['faqs'] ?? [] as $faqIndex => $faq) {
                    $service->faqs()->create([
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'sort_order' => $faq['sort_order'] ?? $faqIndex,
                    ]);
                }

                $vetIds = $item['vets'] ?? self::DEFAULT_VET_IDS;

                foreach (array_values($vetIds) as $vetIndex => $vetId) {
                    $service->vets()->create([
                        'digitail_vet_id' => (string) $vetId,
                        'sort_order' => $vetIndex,
                    ]);
                }

                $created++;
                $this->info("Dibuat: {$service->getTranslation('name', 'en')} (slug: {$service->slug})");
            });
        }

        $this->newLine();
        $this->info("Selesai. {$created} layanan berhasil dibuat di kategori '{$category->getTranslation('name', 'en')}'.");

        return self::SUCCESS;
    }
}
