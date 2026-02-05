<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            // Ubah default value ke false
            $table->boolean('is_active')->default(false)->change();
        });
        
        // PENTING: Reset semua is_active yang tidak ada di existing active
        DB::table('services')->update(['is_active' => false]);
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->change();
        });
    }
};