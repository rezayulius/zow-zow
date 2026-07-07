<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicServiceImage extends Model
{
    use HasTranslations;

    public array $translatable = ['alt_text'];

    protected $fillable = [
        'clinic_service_id',
        'image',
        'alt_text',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function clinicService()
    {
        return $this->belongsTo(ClinicService::class);
    }

    public function scopeService($query)
    {
        return $query->where('type', 'service');
    }

    public function scopeClinic($query)
    {
        return $query->where('type', 'clinic');
    }
}
