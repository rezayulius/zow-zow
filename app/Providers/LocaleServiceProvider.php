<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share current locale with all views
        View::composer('*', function ($view) {
            $view->with('currentLocale', app()->getLocale());
        });
        
        // Create Blade directive for language switcher
        Blade::directive('langSwitch', function ($expression) {
            return "<?php echo view('components.lang-switch', ['locales' => $expression]); ?>";
        });
    }
}