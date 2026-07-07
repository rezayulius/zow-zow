<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
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

    // Estimated reading time in minutes, based on a 200 words/minute pace
    public function getReadingTimeAttribute(): int
    {
        return (int) ceil(str_word_count(strip_tags($this->content)) / 200);
    }
}
