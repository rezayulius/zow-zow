<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Izinkan user mengakses Filament panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user is executive (uses the separate /executive dashboard,
     * not the Filament admin panel)
     */
    public function isExecutive(): bool
    {
        return $this->role === 'executive';
    }

    /**
     * Where to send this user immediately after a successful login
     */
    public function loginRedirectUrl(): string
    {
        return match ($this->role) {
            'admin' => '/admin',
            'executive' => '/executive',
            default => '/',
        };
    }

    /**
     * Get the OTP verifications for the user.
     */
    public function otpVerifications()
    {
        return $this->hasMany(OtpVerification::class, 'email', 'email');
    }
}
