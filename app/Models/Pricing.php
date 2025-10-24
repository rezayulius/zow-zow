<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $table = 'pricing';

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'features',
        'is_popular',
        'is_active',
        'sort_order',
        'button_text',
        'button_link'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope untuk paket yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk paket populer
    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    // Scope untuk urutan tampil
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
