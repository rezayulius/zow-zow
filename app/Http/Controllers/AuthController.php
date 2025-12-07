<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OtpVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Handle sign in request
     */
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }

    /**
     * Handle sign up request
     */
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create user (not verified yet)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Generate OTP
            $otpRecord = OtpVerification::generateOtp($request->email);

            // Send OTP email
            $this->sendOtpEmail($request->email, $otpRecord->otp);

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dibuat! Silakan cek email untuk kode verifikasi.',
                'email' => $request->email
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat akun: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify OTP code
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $otpRecord = OtpVerification::getLatestForEmail($request->email);

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP tidak ditemukan. Silakan minta kode baru.'
            ], 404);
        }

        if ($otpRecord->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kadaluarsa. Silakan minta kode baru.'
            ], 400);
        }

        if ($otpRecord->verify($request->otp)) {
            // Mark email as verified
            $user = User::where('email', $request->email)->first();
            $user->update(['email_verified_at' => now()]);

            // Auto login
            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Email berhasil diverifikasi! Anda sekarang sudah login.',
                'user' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kode OTP salah. Silakan coba lagi.'
        ], 400);
    }

    /**
     * Resend OTP code
     */
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate new OTP
            $otpRecord = OtpVerification::generateOtp($request->email);

            // Send OTP email
            $this->sendOtpEmail($request->email, $otpRecord->otp);

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP baru telah dikirim ke email Anda.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle sign out
     */
    public function signOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }

    /**
     * Send OTP email
     */
    private function sendOtpEmail(string $email, string $otp)
    {
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
            $message->to($email)
                ->subject('Kode Verifikasi OTP - ZowZowVetique');
        });
    }
}
