<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Pricing;
use App\Models\Membership;
use App\Models\Testimonial;
use App\Models\Article;
use App\Models\News;
use App\Models\Promo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password')
            ]
        );

        // Seed Services
        Service::create([
            'title' => 'Konsultasi Dokter Hewan',
            'description' => 'Konsultasi kesehatan hewan peliharaan dengan dokter hewan berpengalaman',
            'category' => 'Health',
            'icon' => 'stethoscope',
            'image' => 'services/consultation.jpg',
            'price' => 150000,
            'is_active' => true,
            'sort_order' => 1
        ]);

        Service::create([
            'title' => 'Grooming Premium',
            'description' => 'Layanan grooming lengkap untuk menjaga kebersihan dan kesehatan hewan',
            'category' => 'Wellness',
            'icon' => 'scissors',
            'image' => 'services/grooming.jpg',
            'price' => 200000,
            'is_active' => true,
            'sort_order' => 2
        ]);

        Service::create([
            'title' => 'Vaksinasi',
            'description' => 'Program vaksinasi lengkap untuk melindungi hewan dari berbagai penyakit',
            'category' => 'Health',
            'icon' => 'shield',
            'image' => 'services/vaccination.jpg',
            'price' => 300000,
            'is_active' => true,
            'sort_order' => 3
        ]);

        // Seed Pricing
        Pricing::create([
            'name' => 'Basic Care',
            'description' => 'Paket perawatan dasar untuk hewan peliharaan',
            'price' => 500000,
            'duration' => 'per bulan',
            'features' => ['Konsultasi 2x', 'Grooming 1x', 'Vitamin'],
            'is_popular' => false,
            'is_active' => true,
            'sort_order' => 1
        ]);

        Pricing::create([
            'name' => 'Premium Care',
            'description' => 'Paket perawatan premium dengan layanan lengkap',
            'price' => 1000000,
            'duration' => 'per bulan',
            'features' => ['Konsultasi unlimited', 'Grooming 2x', 'Vaksinasi', 'Emergency call'],
            'is_popular' => true,
            'is_active' => true,
            'sort_order' => 2
        ]);

        // Seed Memberships
        Membership::create([
            'title' => 'Gold Member',
            'description' => 'Keanggotaan premium dengan benefit eksklusif',
            'type' => 'premium',
            'price' => 2000000,
            'duration' => 'per tahun',
            'benefits' => ['Diskon 20%', 'Priority booking', 'Free consultation'],
            'image' => 'membership/gold.jpg',
            'badge_color' => '#FFD700',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1
        ]);

        // Seed Testimonials
        Testimonial::create([
            'name' => 'Sarah Johnson',
            'position' => 'Pet Owner',
            'company' => 'Jakarta',
            'content' => 'Pelayanan di Zow Zow sangat memuaskan. Dokter hewannya sangat berpengalaman dan ramah.',
            'avatar' => 'testimonials/sarah.jpg',
            'rating' => 5,
            'pet_name' => 'Milo',
            'pet_type' => 'Golden Retriever',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1
        ]);

        Testimonial::create([
            'name' => 'Ahmad Rizki',
            'position' => 'Cat Lover',
            'company' => 'Bandung',
            'content' => 'Grooming service terbaik! Kucing saya jadi lebih sehat dan bersih.',
            'avatar' => 'testimonials/ahmad.jpg',
            'rating' => 5,
            'pet_name' => 'Whiskers',
            'pet_type' => 'Persian Cat',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 2
        ]);

        // Seed Articles
        Article::create([
            'title' => 'Tips Merawat Hewan Peliharaan di Musim Hujan',
            'slug' => 'tips-merawat-hewan-peliharaan-musim-hujan',
            'excerpt' => 'Panduan lengkap merawat hewan peliharaan saat musim hujan tiba',
            'content' => 'Musim hujan memerlukan perhatian khusus dalam merawat hewan peliharaan...',
            'featured_image' => 'articles/rainy-season.jpg',
            'author' => 'Dr. Veteriner',
            'tags' => ['tips', 'perawatan', 'musim hujan'],
            'status' => 'published',
            'is_featured' => true,
            'views' => 150,
            'published_at' => now(),
            'sort_order' => 1
        ]);

        // Seed News
        News::create([
            'title' => 'Pembukaan Cabang Baru Zow Zow di Surabaya',
            'slug' => 'pembukaan-cabang-baru-surabaya',
            'excerpt' => 'Zow Zow membuka cabang baru di Surabaya untuk melayani pet lovers di Jawa Timur',
            'content' => 'Kami dengan bangga mengumumkan pembukaan cabang baru...',
            'featured_image' => 'news/new-branch.jpg',
            'author' => 'Tim Zow Zow',
            'category' => 'Company News',
            'tags' => ['pembukaan', 'cabang baru', 'surabaya'],
            'status' => 'published',
            'is_breaking' => false,
            'is_featured' => true,
            'views' => 200,
            'published_at' => now(),
            'sort_order' => 1
        ]);

        // Seed Promos
        Promo::create([
            'title' => 'Diskon 50% Grooming Pertama',
            'slug' => 'diskon-50-grooming-pertama',
            'description' => 'Dapatkan diskon 50% untuk layanan grooming pertama Anda',
            'promo_code' => 'GROOMING50',
            'discount_type' => 'percentage',
            'discount_value' => 50,
            'min_purchase' => 100000,
            'featured_image' => 'promos/grooming-discount.jpg',
            'terms_conditions' => ['Berlaku untuk pelanggan baru', 'Tidak dapat digabung dengan promo lain'],
            'is_active' => true,
            'is_featured' => true,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'usage_limit' => 100,
            'used_count' => 0,
            'sort_order' => 1
        ]);
    }
}
