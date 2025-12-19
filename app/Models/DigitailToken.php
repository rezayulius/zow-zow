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

    /**
     * Check if the access token is expired.
     * We add a buffer of 60 seconds to be safe.
     */
    public function isExpired(): bool
    {
        // If created_at + expires_in < now, it's expired
        return $this->updated_at->addSeconds($this->expires_in)->subSeconds(60)->isPast();
    }
}
