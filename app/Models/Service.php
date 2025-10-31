<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'features',
        'category',
        'icon',
        'image',
        'price',
        'is_active',
        'sort_order',
        // Digitail API fields
        'digitail_id',
        'name',
        'client_name',
        'clinic_id',
        'service_id',
        'visit_type_id',
        'unit_price',
        'price_includes_tax',
        'tax',
        'aaha_code',
        'barcode',
        'status',
        'lab_tests',
        'aaha_category',
        'is_plan_benefit',
        'digitail_synced_at'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        // Digitail API field casts
        'digitail_id' => 'integer',
        'clinic_id' => 'integer',
        'service_id' => 'integer',
        'visit_type_id' => 'integer',
        'unit_price' => 'decimal:2',
        'price_includes_tax' => 'boolean',
        'tax' => 'decimal:2',
        'lab_tests' => 'array',
        'is_plan_benefit' => 'boolean',
        'digitail_synced_at' => 'datetime'
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

    // Scope untuk service yang berasal dari Digitail
    public function scopeFromDigitail($query)
    {
        return $query->whereNotNull('digitail_id');
    }

    // Scope untuk service lokal (bukan dari Digitail)
    public function scopeLocal($query)
    {
        return $query->whereNull('digitail_id');
    }

    // Scope untuk status enabled
    public function scopeEnabled($query)
    {
        return $query->where('status', 'enabled');
    }

    // Scope untuk status disabled
    public function scopeDisabled($query)
    {
        return $query->where('status', 'disabled');
    }

    // Scope untuk clinic tertentu
    public function scopeForClinic($query, $clinicId)
    {
        return $query->where('clinic_id', $clinicId);
    }

    // Format harga
    public function getFormattedPriceAttribute()
    {
        return $this->price ? 'Rp ' . number_format($this->price, 0, ',', '.') : 'Gratis';
    }

    // Format unit price
    public function getFormattedUnitPriceAttribute()
    {
        return $this->unit_price ? 'Rp ' . number_format($this->unit_price, 2, ',', '.') : 'Gratis';
    }

    // Check if service is from Digitail
    public function isFromDigitail()
    {
        return !is_null($this->digitail_id);
    }

    // Get display name (prioritize 'name' from Digitail, fallback to 'title')
    public function getDisplayNameAttribute()
    {
        return $this->name ?: $this->title;
    }

    // Get effective category (prioritize 'category' from Digitail, fallback to local category)
    public function getEffectiveCategoryAttribute()
    {
        return $this->category;
    }
}
