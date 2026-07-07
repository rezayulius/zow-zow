<?php

namespace App\Models;

use App\Models\Concerns\HasUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicFacility extends Model
{
    use HasTranslations {
        setTranslation as baseSetTranslation;
    }
    use HasUniqueSlug;

    public array $translatable = [
        'name',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
    ];

    protected $fillable = [
        'slug',
        'name',
        'excerpt',
        'content',
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

    public function images()
    {
        return $this->hasMany(ClinicFacilityImage::class)->orderBy('sort_order');
    }

    public function getThumbnailAttribute(): ?string
    {
        return $this->images->first()->image ?? null;
    }

    public function equipment()
    {
        return $this->hasMany(ClinicFacilityEquipment::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(ClinicFacilityFaq::class)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // Sanitize rich-text HTML from the admin editor before it's persisted, per
    // locale, mirroring ClinicService::setTranslation() (same stored-XSS risk
    // since `content` is rendered unescaped on the public detail page).
    public function setTranslation(string $key, string $locale, $value): self
    {
        if ($key === 'content' && $value !== null) {
            $value = clean($value);
        }

        return $this->baseSetTranslation($key, $locale, $value);
    }

    protected function getSlugSourceString(): string
    {
        return $this->getTranslation('name', 'en') ?: $this->getTranslation('name', 'id') ?: 'facility';
    }
}
