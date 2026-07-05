<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OtpVerification extends Model
{
    /**
     * Maximum number of incorrect verification attempts allowed per OTP.
     */
    public const MAX_ATTEMPTS = 5;

    protected $fillable = [
        'email',
        'otp',
        'attempts',
        'expires_at',
        'verified_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /**
     * Generate a new 6-digit OTP
     */
    public static function generateOtp(string $email): self
    {
        // Delete any existing unverified OTPs for this email
        self::where('email', $email)
            ->whereNull('verified_at')
            ->delete();

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create new OTP with 10 minute expiry
        return self::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);
    }

    /**
     * Check if OTP is expired
     */
    public function isExpired(): bool
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    /**
     * Check if the maximum number of failed attempts has been reached.
     */
    public function hasTooManyAttempts(): bool
    {
        return $this->attempts >= self::MAX_ATTEMPTS;
    }

    /**
     * Verify OTP code
     */
    public function verify(string $otpCode): bool
    {
        if ($this->isExpired() || !is_null($this->verified_at) || $this->hasTooManyAttempts()) {
            return false;
        }

        if (hash_equals($this->otp, $otpCode)) {
            $this->update(['verified_at' => Carbon::now()]);
            return true;
        }

        $this->increment('attempts');

        return false;
    }

    /**
     * Get the latest unverified OTP for an email
     */
    public static function getLatestForEmail(string $email): ?self
    {
        return self::where('email', $email)
            ->whereNull('verified_at')
            ->latest()
            ->first();
    }
}
