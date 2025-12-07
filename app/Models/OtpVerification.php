<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OtpVerification extends Model
{
    protected $fillable = [
        'email',
        'otp',
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
     * Verify OTP code
     */
    public function verify(string $otpCode): bool
    {
        if ($this->otp === $otpCode && !$this->isExpired() && is_null($this->verified_at)) {
            $this->update(['verified_at' => Carbon::now()]);
            return true;
        }

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
