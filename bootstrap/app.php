<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Disable trailing slash redirect for POST requests
            // This prevents POST becoming GET when trailing slash is present
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);

        // Trust only Cloudflare's published edge IP ranges (see config/trusted_proxies.php)
        // instead of '*', so X-Forwarded-For can't be spoofed by a client that
        // reaches the origin directly and defeat IP-based rate limiting.
        // The config() helper isn't available yet this early in bootstrapping,
        // so the file is loaded directly instead.
        $middleware->trustProxies(at: (require __DIR__.'/../config/trusted_proxies.php')['cloudflare']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();