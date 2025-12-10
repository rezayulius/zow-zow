<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'A Second Home',
                'highlight_text' => 'for Your Pet',
                'description' => 'Where love, care, and comfort are always present. We are building a lifestyle ecosystem that nurtures wellness, joy, and community.',
                'badge_text' => 'More Than Just a Place',
                'primary_cta_text' => 'Start Your Journey',
                'primary_cta_url' => '#booking',
                'secondary_cta_text' => 'Chat with Us',
                'secondary_cta_url' => 'https://wa.me/6281219088899',
                'main_image' => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1601758228041-f3b2795255f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'theme_color' => 'forest-moss-green',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Your Pet\'s Health',
                'highlight_text' => 'In Safe Hands',
                'description' => 'Comprehensive medical services with a gentle touch. From routine check-ups to emergency care, we treat your pets like family.',
                'badge_text' => 'Expert Veterinary Care',
                'primary_cta_text' => 'Explore Services',
                'primary_cta_url' => '#health',
                'secondary_cta_text' => 'Book Visit',
                'secondary_cta_url' => '#booking',
                'main_image' => 'https://images.unsplash.com/photo-1628009368231-760335298025?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1599443015574-be5fe8a05783?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'theme_color' => 'chai',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Pampering They',
                'highlight_text' => 'Truly Deserve',
                'description' => 'More than just a bath. A relaxing spa experience designed to make your pet look and feel their absolute best.',
                'badge_text' => 'Luxury Grooming & Spa',
                'primary_cta_text' => 'See Spa Menu',
                'primary_cta_url' => '#wellness',
                'secondary_cta_text' => 'Book Spa',
                'secondary_cta_url' => '#booking',
                'main_image' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'secondary_image' => 'https://images.unsplash.com/photo-1535930749574-1399327ce78f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'theme_color' => 'soft-blush-pink',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
