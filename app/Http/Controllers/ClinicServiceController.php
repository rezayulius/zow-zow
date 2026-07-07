<?php

namespace App\Http\Controllers;

use App\Models\ClinicService;
use App\Models\ServiceCategory;
use App\Services\DigitailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClinicServiceController extends Controller
{
    public function __construct(private DigitailService $digitailService)
    {
    }

    public function show(ServiceCategory $category, ClinicService $service): View|RedirectResponse
    {
        abort_unless($service->is_active, 404);

        // The URL carries both category and service slugs independently, so a
        // stale/shared link with a mismatched category (e.g. the service moved
        // to a different category since being shared) redirects to the current
        // canonical URL instead of 404ing outright, preserving its SEO value.
        if ($service->service_category_id !== $category->id) {
            return redirect()->route('service.show', [
                $service->serviceCategory,
                $service,
            ], 301);
        }

        $service->load(['images', 'faqs']);

        $vetsById = collect($this->digitailService->getVets())->keyBy('id');
        $vets = $service->vets->map(fn ($vet) => $vetsById->get((int) $vet->digitail_vet_id) ?? $vetsById->get($vet->digitail_vet_id))
            ->filter()
            ->values();

        return view('services.service-show', compact('category', 'service', 'vets'));
    }
}
