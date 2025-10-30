<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitailController;
use App\Http\Controllers\DigitailApiController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switcher routes
Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])
    ->name('locale.set')
    ->where('locale', '[a-zA-Z]{2}');

// Digitail Dynamic Dashboard Route
Route::prefix('digitail')->name('digitail.')->group(function () {
    Route::get('/', [DigitailController::class, 'dashboard'])->name('dashboard');
});

// Digitail API Proxy Routes (to avoid CORS issues)
Route::prefix('api/digitail')->name('api.digitail.')->group(function () {
    // Specific endpoints
    Route::get('/auth/me', [DigitailApiController::class, 'getMe'])->name('auth.me');
    Route::get('/pets', [DigitailApiController::class, 'getPets'])->name('pets');
    Route::get('/pet-parents', [DigitailApiController::class, 'getPetParents'])->name('pet-parents');
    
    // Generic proxy for other endpoints
    Route::any('/{endpoint}', [DigitailApiController::class, 'proxyRequest'])
        ->where('endpoint', '.*')
        ->name('proxy');
});
