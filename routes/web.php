<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitailController;
use App\Http\Controllers\DigitailApiController;
use App\Http\Controllers\DigitailSyncController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switcher routes
Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])
    ->name('locale.set')
    ->where('locale', '[a-zA-Z]{2}');

// Digitail Dynamic Dashboard Route
Route::prefix('digitail')->name('digitail.')->group(function () {
    Route::get('/', [DigitailController::class, 'dashboard'])->name('dashboard');
});

// Digitail Synchronization Routes (Admin only)
Route::prefix('admin/digitail-sync')->name('admin.digitail-sync.')->group(function () {
    Route::post('/services', [DigitailSyncController::class, 'syncServices'])->name('services');
    Route::get('/status', [DigitailSyncController::class, 'getSyncStatus'])->name('status');
});

// Digitail API Proxy Routes (to avoid CORS issues)
Route::prefix('api/digitail')->name('api.digitail.')->group(function () {
    // Specific endpoints
    Route::get('/auth/me', [DigitailApiController::class, 'getMe'])->name('auth.me');
    Route::get('/pets', [DigitailApiController::class, 'getPets'])->name('pets');
    Route::get('/pet-parents', [DigitailApiController::class, 'getPetParents'])->name('pet-parents');
    Route::get('/service-packages', [DigitailApiController::class, 'getServicePackages'])->name('service-packages');
    Route::get('/vets', [DigitailApiController::class, 'getVets'])->name('vets');

    // Generic proxy for other endpoints
    Route::any('/{endpoint}', [DigitailApiController::class, 'proxyRequest'])
        ->where('endpoint', '.*')
        ->name('proxy');
});
