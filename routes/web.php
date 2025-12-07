<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DigitailController;
use App\Http\Controllers\DigitailApiController;
use App\Http\Controllers\DigitailSyncController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Language switcher routes
Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])
    ->name('locale.set')
    ->where('locale', '[a-zA-Z]{2}');

// Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/signin', [AuthController::class, 'signIn'])->name('signin');
    Route::post('/signup', [AuthController::class, 'signUp'])->name('signup');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend-otp');
    Route::post('/signout', [AuthController::class, 'signOut'])->name('signout');

    // Google OAuth
    Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
});

// Profile Route (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
});

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
