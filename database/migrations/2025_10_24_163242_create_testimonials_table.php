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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama customer
            $table->string('position')->nullable(); // jabatan/posisi
            $table->string('company')->nullable(); // nama perusahaan
            $table->text('content'); // isi testimoni
            $table->string('avatar')->nullable(); // foto customer
            $table->integer('rating')->default(5); // rating 1-5
            $table->string('pet_name')->nullable(); // nama hewan peliharaan
            $table->string('pet_type')->nullable(); // jenis hewan
            $table->boolean('is_featured')->default(false); // testimoni unggulan
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
        Schema::dropIfExists('testimonials');
    }
};
