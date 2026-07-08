<?php

namespace App\Providers;

use App\View\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Most existing content was authored in Indonesian; fall back to it
        // until English translations are filled in via Filament.
        Translatable::fallback(fallbackLocale: 'id', fallbackAny: true);

        // Debugbar is normally gated by APP_DEBUG, but a dev dependency ended
        // up in this production build's autoloaded packages. Force it off
        // in production so an accidental APP_DEBUG=true doesn't expose
        // SQL/session/request data via /_debugbar/*.
        if ($this->app->environment('production')) {
            config(['debugbar.enabled' => false]);
        }

        View::composer('partials.header', NavigationComposer::class);

        // The Livewire runtime is only needed for wire:navigate link
        // interception on this site (no page-critical component hydrates
        // above the fold), so there's no reason it should block rendering.
        // Without `defer`, the ~79KB script (mostly Alpine + its sort/focus/
        // anchor plugins, per Lighthouse's "unused JavaScript" audit) still
        // forces the browser to pause before it can finish the document and
        // start compositing, which was showing up as main-thread contention
        // delaying LCP on mobile.
        Livewire::useScriptTagAttributes(['defer' => true]);
    }
}
