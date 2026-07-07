<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
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
    }
}
