<?php

namespace App\View\Composers;

use App\Models\ServiceCategory;
use Illuminate\View\View;

/**
 * Shares the Services mega-menu data with the header partial regardless of
 * which controller renders the current page (homepage, category page, service
 * detail page, etc.), so the nav doesn't need to be queried per-controller.
 */
class NavigationComposer
{
    public function compose(View $view): void
    {
        $view->with('navCategories', ServiceCategory::active()
            ->ordered()
            ->with(['clinicServices' => fn ($query) => $query->active()->ordered()])
            ->get());
    }
}
