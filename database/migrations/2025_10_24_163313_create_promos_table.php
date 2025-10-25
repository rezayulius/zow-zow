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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('promo_code')->nullable(); // kode promo
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 8, 2); // nilai diskon
            $table->decimal('min_purchase', 10, 2)->nullable(); // minimal pembelian
            $table->string('featured_image')->nullable();
            $table->json('terms_conditions')->nullable(); // syarat dan ketentuan
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->integer('usage_limit')->nullable(); // batas penggunaan
            $table->integer('used_count')->default(0); // jumlah yang sudah digunakan
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
