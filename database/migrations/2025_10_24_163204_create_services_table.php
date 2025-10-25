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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['Wellness', 'Health'])->default('Wellness'); // kategori service
            $table->string('icon')->nullable(); // untuk icon class atau path gambar
            $table->string('image')->nullable(); // untuk gambar service
            $table->decimal('price', 10, 2)->nullable(); // harga service
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // untuk urutan tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
