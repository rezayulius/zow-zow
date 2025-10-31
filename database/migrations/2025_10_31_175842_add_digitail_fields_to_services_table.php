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
        Schema::table('services', function (Blueprint $table) {
            // Digitail API fields
            $table->unsignedBigInteger('digitail_id')->nullable()->after('id');
            $table->string('name')->nullable()->after('digitail_id'); // nama dari API
            $table->string('client_name')->nullable()->after('name'); // client_name dari API
            $table->unsignedBigInteger('clinic_id')->nullable()->after('client_name');
            $table->unsignedBigInteger('service_id')->nullable()->after('clinic_id');
            $table->unsignedBigInteger('visit_type_id')->nullable()->after('service_id');
            $table->decimal('unit_price', 10, 2)->nullable()->after('visit_type_id');
            $table->boolean('price_includes_tax')->default(false)->after('price');
            $table->decimal('tax', 5, 2)->nullable()->after('price_includes_tax'); // persentase pajak
            $table->string('aaha_code')->nullable()->after('tax');
            $table->string('barcode')->nullable()->after('aaha_code');
            $table->enum('status', ['enabled', 'disabled'])->default('enabled')->after('is_active');
            $table->json('lab_tests')->nullable()->after('status');
            $table->string('aaha_category')->nullable()->after('lab_tests');
            $table->boolean('is_plan_benefit')->default(false)->after('aaha_category');
            
            // Index untuk performa
            $table->index('digitail_id');
            $table->index('clinic_id');
            $table->index('service_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['digitail_id']);
            $table->dropIndex(['clinic_id']);
            $table->dropIndex(['service_id']);
            $table->dropIndex(['status']);
            
            // Drop columns
            $table->dropColumn([
                'digitail_id',
                'name',
                'client_name',
                'clinic_id',
                'service_id',
                'visit_type_id',
                'unit_price',
                'price_includes_tax',
                'tax',
                'aaha_code',
                'barcode',
                'status',
                'lab_tests',
                'aaha_category',
                'is_plan_benefit'
            ]);
        });
    }
};
