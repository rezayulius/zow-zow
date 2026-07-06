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

// Tambahkan ini di paling atas routes/web.php
Route::post('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'POST works!',
        'method' => request()->method(),
        'all' => request()->all()
    ]);
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/coming-soon', [ComingSoonController::class, 'index'])->name('coming-soon');

Route::post('/content/{type}/{id}/view', [ContentViewController::class, 'increment'])
    ->where(['type' => 'article|news', 'id' => '[0-9]+'])
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
    Route::post('/signup', [AuthController::class, 'signUp'])->name('signup');
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
    Route::get('/vets', [DigitailApiController::class, 'getVets'])->name('vets');
    Route::get('/vet-schedule', [DigitailApiController::class, 'getVetSchedule'])->name('vet-schedule');
    Route::get('/visit-types', [DigitailApiController::class, 'getVisitTypes'])->name('visit-types');
    Route::get('/records-by-pet', [DigitailApiController::class, 'getRecordsByPet'])->name('records-by-pet');

    // Generic proxy for other endpoints
    Route::any('/{endpoint}', [DigitailApiController::class, 'proxyRequest'])
        ->where('endpoint', '.*')
        ->name('proxy');
});
