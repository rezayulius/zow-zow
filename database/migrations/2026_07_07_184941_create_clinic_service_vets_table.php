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
        Schema::create('clinic_service_vets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_service_id')->constrained('clinic_services')->cascadeOnDelete();
            $table->string('digitail_vet_id');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['clinic_service_id', 'digitail_vet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_service_vets');
    }
};
