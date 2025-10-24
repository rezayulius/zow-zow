<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'icon',
        'image',
        'price',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope untuk service yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk urutan tampil
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Scope untuk kategori Wellness
    public function scopeWellness($query)
    {
        return $query->where('category', 'Wellness');
    }

    // Scope untuk kategori Health
    public function scopeHealth($query)
    {
        return $query->where('category', 'Health');
    }

    // Format harga
    public function getFormattedPriceAttribute()
    {
        return $this->price ? 'Rp ' . number_format($this->price, 0, ',', '.') : 'Gratis';
    }
}
