<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicFacilityImage extends Model
{
    use HasTranslations;

    public array $translatable = ['alt_text'];

    protected $fillable = [
        'clinic_facility_id',
        'image',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function clinicFacility()
    {
        return $this->belongsTo(ClinicFacility::class);
    }
}
