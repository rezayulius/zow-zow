<?php

namespace App\Support;

class ReservedSlugs
{
    /**
     * Top-level path segments already claimed by other routes. A ServiceCategory
     * or ClinicService slug must never collide with these, since both are matched
     * by the catch-all `/{category:slug}` public route.
     */
    public const LIST = [
        'admin', 'login', 'auth', 'api', 'profile', 'history', 'coming-soon',
        'set-locale', 'digitail', 'content', 'storage', 'our-vets', 'build',
        'sitemap.xml', 'robots.txt', 'favicon.ico', 'facility', 'articles',
        'executive',
    ];

    public static function contains(string $slug): bool
    {
        return in_array($slug, self::LIST, true);
    }
}
