<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicServiceFaq extends Model
{
    use HasTranslations;

    public array $translatable = ['question', 'answer'];

    protected $fillable = [
        'clinic_service_id',
        'question',
        'answer',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function clinicService()
    {
        return $this->belongsTo(ClinicService::class);
    }
}
