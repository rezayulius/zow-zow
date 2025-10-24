<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'category',
        'tags',
        'status',
        'is_breaking',
        'is_featured',
        'views',
        'published_at',
        'sort_order'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_breaking' => 'boolean',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
        'sort_order' => 'integer'
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Scope untuk berita yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk breaking news
    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    // Scope untuk berita unggulan
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
}
