<?php

namespace App\Models\Concerns;

use App\Support\ReservedSlugs;
use Illuminate\Support\Str;

/**
 * Auto-generates a unique, stable slug on create (never regenerated afterwards,
 * so previously-shared/indexed URLs keep working even if the source name changes
 * later). Unlike Article's slug boot-hook, this handles collisions (including
 * against reserved top-level route segments) by appending -2, -3, etc.
 */
trait HasUniqueSlug
{
    protected static function bootHasUniqueSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->getSlugSourceString());
            }
        });
    }

    public static function generateUniqueSlug(string $source): string
    {
        $base = Str::slug($source) ?: 'item';
        $slug = $base;
        $suffix = 2;

        while (ReservedSlugs::contains($slug) || static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    /**
     * The string used as the base for slug generation, e.g. the model's
     * translatable "name" resolved to a stable locale.
     */
    abstract protected function getSlugSourceString(): string;
}
