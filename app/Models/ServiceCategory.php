<?php

namespace App\Models;

use App\Models\Concerns\HasUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServiceCategory extends Model
{
    use HasTranslations;
    use HasUniqueSlug;

    public array $translatable = [
        'name',
        'description',
        'meta_title',
        'meta_description',
    ];

    protected $fillable = [
        'slug',
        'name',
        'description',
        'icon',
        'image',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function clinicServices()
    {
        return $this->hasMany(ClinicService::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    protected function getSlugSourceString(): string
    {
        return $this->getTranslation('name', 'en') ?: $this->getTranslation('name', 'id') ?: 'category';
    }
}
