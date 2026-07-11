<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitailController;
use App\Http\Controllers\DigitailApiController;
use App\Http\Controllers\DigitailSyncController;
use App\Http\Controllers\DigitailAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\ContentViewController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ClinicServiceController;
use App\Http\Controllers\ClinicFacilityController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/coming-soon', [ComingSoonController::class, 'index'])->name('coming-soon');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::post('/content/{type}/{id}/view', [ContentViewController::class, 'increment'])
    ->where(['type' => 'article|news|clinic-service', 'id' => '[0-9]+'])
    ->middleware('throttle:30,1')
    ->name('content.view');

// Redirect default auth middleware target to home
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Doc
// Language switcher routes
Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])
    ->name('locale.set')
    ->where('locale', '[a-zA-Z]{2}');

// Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/signin', [AuthController::class, 'signIn'])->middleware('throttle:5,1')->name('signin');
    Route::post('/signup', [AuthController::class, 'signUp'])->middleware('throttle:5,1')->name('signup');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:10,1')->name('verify-otp');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->middleware('throttle:5,1')->name('resend-otp');
    Route::post('/signout', [AuthController::class, 'signOut'])->name('signout');

    // Google OAuth
    Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
});

// Profile & History Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
});

// Digitail Dynamic Dashboard Route (Admin only - internal API testing/config tool)
Route::middleware(['auth', 'admin'])->prefix('digitail')->name('digitail.')->group(function () {
    Route::get('/', [DigitailController::class, 'dashboard'])->name('dashboard');

    // OAuth Routes
    Route::get('/auth/redirect', [DigitailAuthController::class, 'redirect'])->name('auth.redirect');
    Route::get('/auth/callback', [DigitailAuthController::class, 'handleCallback'])->name('auth.callback');
});

// Digitail Synchronization Routes (Admin only)
Route::middleware(['auth', 'admin'])->prefix('admin/digitail-sync')->name('admin.digitail-sync.')->group(function () {
    Route::post('/services', [DigitailSyncController::class, 'syncServices'])->name('services');
    Route::get('/status', [DigitailSyncController::class, 'getSyncStatus'])->name('status');
});

// Digitail Public API Routes (read-only, powers the "Schedule Visit" widget on the homepage)
// Registered before the admin group below so its wildcard proxy route can't swallow these paths first.
Route::middleware('throttle:30,1')->prefix('api/digitail/public')->name('api.digitail.public.')->group(function () {
    Route::get('/visit-types', [DigitailApiController::class, 'getVisitTypes'])->name('visit-types');
    Route::get('/vet-schedule', [DigitailApiController::class, 'getVetSchedule'])->name('vet-schedule');
});

// Digitail API Proxy Routes (Admin only - internal API testing tool, not for end-user/customer access)
Route::middleware(['auth', 'admin'])->prefix('api/digitail')->name('api.digitail.')->group(function () {
    // Specific endpoints
    Route::get('/auth/me', [DigitailApiController::class, 'getMe'])->name('auth.me');
    Route::get('/pets', [DigitailApiController::class, 'getPets'])->name('pets');
    Route::get('/pet-parents', [DigitailApiController::class, 'getPetParents'])->name('pet-parents');
    Route::get('/pet-parent-by-email', [DigitailApiController::class, 'getPetParentByEmail'])->name('pet-parent-by-email');
    Route::get('/pets-by-owner', [DigitailApiController::class, 'getPetsByOwner'])->name('pets-by-owner');
    Route::get('/service-packages', [DigitailApiController::class, 'getServicePackages'])->name('service-packages');
    Route::get('/sales', [DigitailApiController::class, 'getSales'])->name('sales');
    Route::get('/invoices', [DigitailApiController::class, 'getInvoices'])->name('invoices');
    Route::get('/credit-notes', [DigitailApiController::class, 'getCreditNotes'])->name('credit-notes');
    Route::get('/reports/appointments', [DigitailApiController::class, 'getAppointmentsReport'])->name('reports.appointments');
    Route::get('/integrations/labs/orders', [DigitailApiController::class, 'getLabOrders'])->name('labs.orders');
    Route::get('/reminder-protocol-usages', [DigitailApiController::class, 'getReminderProtocolUsages'])->name('reminder-protocol-usages');
    Route::get('/vets', [DigitailApiController::class, 'getVets'])->name('vets');
    Route::get('/vet-schedule', [DigitailApiController::class, 'getVetSchedule'])->name('vet-schedule');
    Route::get('/visit-types', [DigitailApiController::class, 'getVisitTypes'])->name('visit-types');
    Route::get('/records-by-pet', [DigitailApiController::class, 'getRecordsByPet'])->name('records-by-pet');

    // Generic proxy for other endpoints
    Route::any('/{endpoint}', [DigitailApiController::class, 'proxyRequest'])
        ->where('endpoint', '.*')
        ->name('proxy');
});

// Executive Dashboard (standalone, outside Filament, role=executive only)
Route::prefix('executive')->name('executive.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\ExecutiveController::class, 'showLogin'])->name('login');
        Route::post('/login', [App\Http\Controllers\ExecutiveController::class, 'login'])->name('login.store');
    });

    Route::middleware(['auth', 'executive'])->group(function () {
        Route::get('/', [App\Http\Controllers\ExecutiveController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\ExecutiveController::class, 'logout'])->name('logout');
    });
});

// Service category/detail catch-all routes. Registered last so their single
// dynamic segment never shadows a specific route above (e.g. /admin, /login,
// /profile, /coming-soon). The negative-lookahead constraint is defense in
// depth on top of that ordering — it guarantees a reserved top-level path can
// never resolve as a category slug regardless of route registration order
// (e.g. across Filament's own panel routes, registered by a different
// provider). Built from the same reserved-slugs list Filament's admin form
// validates against, so the two can't drift out of sync.
$reservedSlugPattern = '^(?!(?:' . implode('|', array_map(
    'preg_quote',
    \App\Support\ReservedSlugs::LIST
)) . ')$)[^/]+$';

// Clinic facilities (Ruang Operasi, ICU, dst.) are informational/SEO pages,
// deliberately NOT a ServiceCategory — they aren't bookable, so they don't
// belong in the {category:slug} catch-all below. Registered here, ahead of
// it, and 'facility' is reserved in ReservedSlugs so no ServiceCategory can
// ever claim that slug and shadow this route.
Route::get('/facility', [ClinicFacilityController::class, 'index'])->name('facility.index');
Route::get('/facility/{facility:slug}', [ClinicFacilityController::class, 'show'])->name('facility.show');

// Articles ("Wawasan Perawatan Hewan") get their own canonical, crawlable URL
// here so they can be indexed/cited independently — previously they only
// existed as homepage modal content (see resources/js/testimonials.js), which
// is invisible to search engines and non-JS-executing bots alike.
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/{category:slug}', [ServiceCategoryController::class, 'show'])
    ->where('category', $reservedSlugPattern)
    ->name('service-category.show');

// withoutScopedBindings(): Laravel's implicit nested-binding convention would
// otherwise try to resolve {service} via a `$category->services()` relation
// (pluralizing the param name) instead of `clinicServices()`. Scoping is
// deliberately not used anyway — a service whose category no longer matches
// the URL should 301 to its canonical URL (handled in the controller), not 404.
Route::get('/{category:slug}/{service:slug}', [ClinicServiceController::class, 'show'])
    ->where('category', $reservedSlugPattern)
    ->withoutScopedBindings()
    ->name('service.show');
