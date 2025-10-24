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
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama paket
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // harga
            $table->string('duration')->nullable(); // durasi (per bulan, per tahun, dll)
            $table->json('features')->nullable(); // fitur-fitur dalam bentuk JSON array
            $table->boolean('is_popular')->default(false); // untuk highlight paket populer
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('button_text')->default('Pilih Paket'); // text tombol
            $table->string('button_link')->nullable(); // link tombol
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing');
    }
};
