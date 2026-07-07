<?php

namespace App\Support;

/**
 * Visual theme (Tailwind class tokens) per service category slug, so the new
 * category/service pages inherit the same per-category color language already
 * established on the homepage (Health = forest-moss-green, Wellness = chai).
 * Any category beyond these two falls back to the forest-moss-green theme.
 */
class CategoryTheme
{
    public static function for(?string $slug): array
    {
        return match ($slug) {
            'facility' => [
                'icon' => 'building-2',
                'blob1' => 'bg-rusty-caramel-200/40',
                'blob2' => 'bg-old-mustard-yellow-100/40',
                'iconBg' => 'bg-rusty-caramel-100',
                'iconText' => 'text-rusty-caramel-600',
                'iconShadow' => 'shadow-rusty-caramel-200/50',
                'heading' => 'text-rusty-caramel-900',
                'headingHover' => 'text-rusty-caramel-600',
                'body' => 'text-rusty-caramel-800/80',
                'badgeBg' => 'bg-rusty-caramel-100',
                'badgeText' => 'text-rusty-caramel-800',
                'linkText' => 'text-rusty-caramel-700',
                'border' => 'border-rusty-caramel-100',
                'borderHover' => 'hover:border-rusty-caramel-300',
                'divider' => 'border-rusty-caramel-100',
                'shadowSoft' => 'shadow-rusty-caramel-100/30',
                'shadowStrongHover' => 'hover:shadow-rusty-caramel-200/50',
                'buttonBg' => 'bg-rusty-caramel-600',
                'buttonBgHover' => 'hover:bg-rusty-caramel-700',
                'imageOverlay' => 'from-rusty-caramel-900/40',
                'gradientFrom' => 'from-rusty-caramel-50/30',
                'sectionBg' => 'bg-soft-linen-50',
            ],
            'wellness' => [
                'icon' => 'sparkles',
                'blob1' => 'bg-chai-200/40',
                'blob2' => 'bg-soft-blush-pink-100/40',
                'iconBg' => 'bg-chai-100',
                'iconText' => 'text-chai-600',
                'iconShadow' => 'shadow-chai-200/50',
                'heading' => 'text-chai-900',
                'headingHover' => 'text-chai-600',
                'body' => 'text-chai-800/80',
                'badgeBg' => 'bg-chai-100',
                'badgeText' => 'text-chai-800',
                'linkText' => 'text-chai-700',
                'border' => 'border-chai-100',
                'borderHover' => 'hover:border-chai-300',
                'divider' => 'border-chai-100',
                'shadowSoft' => 'shadow-chai-100/30',
                'shadowStrongHover' => 'hover:shadow-chai-200/50',
                'buttonBg' => 'bg-chai-600',
                'buttonBgHover' => 'hover:bg-chai-700',
                'imageOverlay' => 'from-chai-900/40',
                'gradientFrom' => 'from-chai-50/30',
                'sectionBg' => 'bg-soft-linen-50',
            ],
            default => [
                'icon' => 'stethoscope',
                'blob1' => 'bg-forest-moss-green-200/40',
                'blob2' => 'bg-pistache-100/40',
                'iconBg' => 'bg-forest-moss-green-100',
                'iconText' => 'text-forest-moss-green-600',
                'iconShadow' => 'shadow-forest-moss-green-200/50',
                'heading' => 'text-forest-moss-green-900',
                'headingHover' => 'text-forest-moss-green-600',
                'body' => 'text-forest-moss-green-700/80',
                'badgeBg' => 'bg-forest-moss-green-100',
                'badgeText' => 'text-forest-moss-green-800',
                'linkText' => 'text-forest-moss-green-700',
                'border' => 'border-forest-moss-green-100',
                'borderHover' => 'hover:border-forest-moss-green-300',
                'divider' => 'border-forest-moss-green-100',
                'shadowSoft' => 'shadow-forest-moss-green-50',
                'shadowStrongHover' => 'hover:shadow-forest-moss-green-200/30',
                'buttonBg' => 'bg-forest-moss-green-600',
                'buttonBgHover' => 'hover:bg-forest-moss-green-700',
                'imageOverlay' => 'from-forest-moss-green-900/40',
                'gradientFrom' => 'from-forest-moss-green-50/30',
                'sectionBg' => 'bg-white',
            ],
        };
    }
}
