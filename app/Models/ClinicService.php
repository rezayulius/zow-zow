<?php

namespace App\Models;

use App\Models\Concerns\HasUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClinicService extends Model
{
    use HasTranslations {
        setTranslation as baseSetTranslation;
    }
    use HasUniqueSlug;

    public array $translatable = [
        'name',
        'excerpt',
        'content',
        'whatsapp_message',
        'meta_title',
        'meta_description',
    ];

    protected $fillable = [
        'service_category_id',
        'slug',
        'name',
        'excerpt',
        'content',
        'address',
        'operating_hours',
        'whatsapp_message',
        'booking_cta_url',
        'meta_title',
        'meta_description',
        'views',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'views' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ClinicServiceImage::class)->orderBy('sort_order');
    }

    public function serviceImages()
    {
        return $this->images()->where('type', 'service');
    }

    public function clinicImages()
    {
        return $this->images()->where('type', 'clinic');
    }

    public function getThumbnailAttribute(): ?string
    {
        return $this->serviceImages->first()->image ?? null;
    }

    public function faqs()
    {
        return $this->hasMany(ClinicServiceFaq::class)->orderBy('sort_order');
    }

    public function vets()
    {
        return $this->hasMany(ClinicServiceVet::class)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    // Sanitize rich-text HTML from the admin editor before it's persisted, per
    // locale, so a compromised/malicious admin account can't stash a stored-XSS
    // payload in `content`, which is rendered unescaped ({!! !!}) on the public
    // detail page. Mirrors Article::setContentAttribute, adapted for Translatable's
    // locale-keyed writes (a plain attribute mutator is bypassed by setTranslation).
    public function setTranslation(string $key, string $locale, $value): self
    {
        if ($key === 'content' && $value !== null) {
            $value = clean($value);
        }

        return $this->baseSetTranslation($key, $locale, $value);
    }

    protected function getSlugSourceString(): string
    {
        return $this->getTranslation('name', 'en') ?: $this->getTranslation('name', 'id') ?: 'service';
    }
}
