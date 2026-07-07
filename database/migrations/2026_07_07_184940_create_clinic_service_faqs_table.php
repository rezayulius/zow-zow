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
        Schema::create('clinic_service_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_service_id')->constrained('clinic_services')->cascadeOnDelete();
            $table->json('question');
            $table->json('answer');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_service_faqs');
    }
};
