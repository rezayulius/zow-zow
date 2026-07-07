<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // User exists, login
                Auth::login($user);
                $request->session()->regenerate();
                $redirectUrl = $user->role === 'admin' ? '/admin' : '/';
                return redirect($redirectUrl)->with('success', 'Berhasil login dengan Google!');
            }

            // Check if user exists with this email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // User exists with email, link Google account.
                // Rotate the password so a pre-existing (possibly attacker-set,
                // unverified) local password can no longer be used to sign in
                // once Google has verified real ownership of this email.
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(), // Auto verify email from Google
                    'password' => Hash::make(Str::random(40)),
                ]);

                Auth::login($user);
                $request->session()->regenerate();
                $redirectUrl = $user->role === 'admin' ? '/admin' : '/';
                return redirect($redirectUrl)->with('success', 'Akun Google berhasil dihubungkan!');
            }

            // Create new user
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(uniqid()), // Random password
                'email_verified_at' => now(), // Auto verify email from Google
                'role' => 'user', // Default role
            ]);

            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Akun berhasil dibuat dengan Google!');

        } catch (\Exception $e) {
            Log::error('Google OAuth login failed', ['message' => $e->getMessage()]);

            return redirect('/')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}
