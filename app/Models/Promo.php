<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'promo_code',
        'discount_type',
        'discount_value',
        'min_purchase',
        'featured_image',
        'terms_conditions',
        'is_active',
        'is_featured',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'sort_order'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'terms_conditions' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'sort_order' => 'integer'
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($promo) {
            if (empty($promo->slug)) {
                $promo->slug = Str::slug($promo->title);
            }
        });
    }

    // Scope untuk promo yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk promo yang sedang berlangsung
    public function scopeOngoing($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    // Scope untuk promo unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk urutan tampil
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Check apakah promo masih berlaku
    public function isValid()
    {
        $now = Carbon::now();
        return $this->is_active && 
               $this->start_date <= $now && 
               $this->end_date >= $now &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    // Format diskon
    public function getFormattedDiscountAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        } else {
            return 'Rp ' . number_format($this->discount_value, 0, ',', '.');
        }
    }
}
