<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\View\View;

class ServiceCategoryController extends Controller
{
    public function show(ServiceCategory $category): View
    {
        abort_unless($category->is_active, 404);

        // Lightweight, unpaginated list used only for the hero's service count
        // badge and the CollectionPage JSON-LD; the actual grid (with live
        // search + pagination) is rendered by the ServiceCategoryBrowser
        // Livewire component further down the page.
        $allServices = $category->clinicServices()->active()->ordered()->get(['id', 'service_category_id', 'slug', 'name']);

        return view('services.category-show', [
            'category' => $category,
            'allServices' => $allServices,
            'totalServices' => $allServices->count(),
        ]);
    }
}
