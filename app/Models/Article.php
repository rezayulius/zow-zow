<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasTranslations {
        setTranslation as baseSetTranslation;
    }

    public array $translatable = [
        'title',
        'excerpt',
        'content',
    ];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'tags',
        'status',
        'is_featured',
        'views',
        'published_at',
        'sort_order'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
        'sort_order' => 'integer'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Scope untuk artikel yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk artikel unggulan
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk urutan tampil
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }

    // Sanitize rich-text HTML from the admin editor before it's persisted, per
    // locale, so a compromised/malicious admin account can't stash a stored-XSS
    // payload in `content`, which is rendered unescaped ({!! !!}) on the public
    // detail page. Mirrors ClinicService::setTranslation() — a plain attribute
    // mutator is bypassed by Translatable's locale-keyed writes.
    public function setTranslation(string $key, string $locale, $value): self
    {
        if ($key === 'content' && $value !== null) {
            $value = clean($value);
        }

        return $this->baseSetTranslation($key, $locale, $value);
    }

    // Estimated reading time in minutes, based on a 200 words/minute pace
    public function getReadingTimeAttribute(): int
    {
        return (int) ceil(str_word_count(strip_tags($this->content)) / 200);
    }
}
