<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicFacilityFaq extends Model
{
    use HasTranslations;

    public array $translatable = ['question', 'answer'];

    protected $fillable = [
        'clinic_facility_id',
        'question',
        'answer',
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
