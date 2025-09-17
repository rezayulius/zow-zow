<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    /**
     * Set the application locale
     *
     * @param Request $request
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale(Request $request, string $locale)
    {
        // Validate locale
        $supportedLocales = ['en', 'id'];
        
        if (!in_array($locale, $supportedLocales)) {
            return Redirect::back()->with('error', 'Unsupported locale');
        }

        // Store locale in session
        Session::put('locale', $locale);
        
        // Set application locale for current request
        app()->setLocale($locale);
        
        return Redirect::back()->with('success', 'Language changed successfully');
    }
    
    /**
     * Get current locale
     *
     * @return string
     */
    public function getCurrentLocale()
    {
        return Session::get('locale', config('app.locale'));
    }
}