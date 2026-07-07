<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicServiceVet extends Model
{
    protected $fillable = [
        'clinic_service_id',
        'digitail_vet_id',
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
