<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeroSlide extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'title',
        'highlight_text',
        'description',
        'badge_text',
        'primary_cta_text',
        'secondary_cta_text',
    ];

    protected $fillable = [
        'title',
        'highlight_text',
        'description',
        'badge_text',
        'primary_cta_text',
        'primary_cta_url',
        'secondary_cta_text',
        'secondary_cta_url',
        'main_image',
        'secondary_image',
        'theme_color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
