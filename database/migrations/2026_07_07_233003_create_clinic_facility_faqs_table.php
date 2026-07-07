<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinic_facility_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_facility_id')->constrained('clinic_facilities')->cascadeOnDelete();
            $table->json('question');
            $table->json('answer');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinic_facility_faqs');
    }
};
