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
        Schema::create('digitail_tokens', function (Blueprint $table) {
            $table->id();
            $table->text('access_token');
            $table->text('refresh_token')->nullable();
            $table->string('token_type')->default('Bearer');
            $table->integer('expires_in')->default(0); // Seconds
            $table->string('scope')->nullable();
            $table->unsignedBigInteger('clinic_id')->nullable(); // Optional: to distinguish if multiple clinics
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digitail_tokens');
    }
};
