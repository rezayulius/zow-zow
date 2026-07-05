<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->json('title_i18n')->nullable()->after('title');
            $table->json('highlight_text_i18n')->nullable()->after('highlight_text');
            $table->json('description_i18n')->nullable()->after('description');
            $table->json('badge_text_i18n')->nullable()->after('badge_text');
            $table->json('primary_cta_text_i18n')->nullable()->after('primary_cta_text');
            $table->json('secondary_cta_text_i18n')->nullable()->after('secondary_cta_text');
        });

        // Existing content was authored in Indonesian, so it becomes the "id" translation.
        DB::statement(<<<SQL
            UPDATE hero_slides SET
                title_i18n = jsonb_build_object('id', title)::json,
                highlight_text_i18n = CASE WHEN highlight_text IS NULL THEN NULL ELSE jsonb_build_object('id', highlight_text)::json END,
                description_i18n = jsonb_build_object('id', description)::json,
                badge_text_i18n = CASE WHEN badge_text IS NULL THEN NULL ELSE jsonb_build_object('id', badge_text)::json END,
                primary_cta_text_i18n = CASE WHEN primary_cta_text IS NULL THEN NULL ELSE jsonb_build_object('id', primary_cta_text)::json END,
                secondary_cta_text_i18n = CASE WHEN secondary_cta_text IS NULL THEN NULL ELSE jsonb_build_object('id', secondary_cta_text)::json END
        SQL);

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'highlight_text',
                'description',
                'badge_text',
                'primary_cta_text',
                'secondary_cta_text',
            ]);
        });

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->renameColumn('title_i18n', 'title');
            $table->renameColumn('highlight_text_i18n', 'highlight_text');
            $table->renameColumn('description_i18n', 'description');
            $table->renameColumn('badge_text_i18n', 'badge_text');
            $table->renameColumn('primary_cta_text_i18n', 'primary_cta_text');
            $table->renameColumn('secondary_cta_text_i18n', 'secondary_cta_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('title_old')->nullable()->after('title');
            $table->string('highlight_text_old')->nullable()->after('highlight_text');
            $table->text('description_old')->nullable()->after('description');
            $table->string('badge_text_old')->nullable()->after('badge_text');
            $table->string('primary_cta_text_old')->nullable()->after('primary_cta_text');
            $table->string('secondary_cta_text_old')->nullable()->after('secondary_cta_text');
        });

        DB::statement(<<<SQL
            UPDATE hero_slides SET
                title_old = title->>'id',
                highlight_text_old = highlight_text->>'id',
                description_old = description->>'id',
                badge_text_old = badge_text->>'id',
                primary_cta_text_old = primary_cta_text->>'id',
                secondary_cta_text_old = secondary_cta_text->>'id'
        SQL);

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'highlight_text',
                'description',
                'badge_text',
                'primary_cta_text',
                'secondary_cta_text',
            ]);
        });

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->renameColumn('title_old', 'title');
            $table->renameColumn('highlight_text_old', 'highlight_text');
            $table->renameColumn('description_old', 'description');
            $table->renameColumn('badge_text_old', 'badge_text');
            $table->renameColumn('primary_cta_text_old', 'primary_cta_text');
            $table->renameColumn('secondary_cta_text_old', 'secondary_cta_text');
        });

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
};
