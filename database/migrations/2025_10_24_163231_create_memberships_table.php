<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // judul membership
            $table->text('description');
            $table->string('type'); // Basic, Premium, VIP, dll
            $table->decimal('price', 10, 2);
            $table->string('duration'); // 1 bulan, 6 bulan, 1 tahun
            $table->json('benefits')->nullable(); // keuntungan membership dalam JSON
            $table->string('image')->nullable(); // gambar membership
            $table->string('badge_color')->default('#007bff'); // warna badge
            $table->boolean('is_featured')->default(false); // membership unggulan
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
