<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('service_categories')->insert([
            [
                'slug' => 'health',
                'name' => json_encode(['id' => 'Kesehatan', 'en' => 'Health']),
                'description' => json_encode([
                    'id' => 'Layanan pemeriksaan dan perawatan medis untuk hewan peliharaan Anda.',
                    'en' => 'Medical examination and treatment services for your pet.',
                ]),
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'wellness',
                'name' => json_encode(['id' => 'Kebugaran', 'en' => 'Wellness']),
                'description' => json_encode([
                    'id' => 'Layanan perawatan dan kebugaran untuk menjaga hewan peliharaan tetap bahagia dan sehat.',
                    'en' => 'Grooming and wellness services to keep your pet happy and healthy.',
                ]),
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
