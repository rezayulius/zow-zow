<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DigitailToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_token',
        'refresh_token',
        'token_type',
        'expires_in',
        'scope',
        'clinic_id',
    ];

    protected $casts = [
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted',
    ];

    /**
     * Check if the access token is expired.
     * We add a buffer of 60 seconds to be safe.
     */
    public function isExpired(): bool
    {
        // updated_at is a shared mutable Carbon instance; copy() before mutating
        // so repeated calls don't permanently shift the stored timestamp.
        return $this->updated_at->copy()->addSeconds($this->expires_in)->subSeconds(60)->isPast();
    }
}
