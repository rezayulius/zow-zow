<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // title/content are NOT NULL; excerpt is nullable, so its NULL rows
        // must stay NULL rather than becoming the JSON literal "null".
        DB::statement(<<<'SQL'
            ALTER TABLE articles
                ALTER COLUMN title TYPE json USING json_build_object('id', title),
                ALTER COLUMN excerpt TYPE json USING (CASE WHEN excerpt IS NULL THEN NULL ELSE json_build_object('id', excerpt) END),
                ALTER COLUMN content TYPE json USING json_build_object('id', content)
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement(<<<'SQL'
            ALTER TABLE articles
                ALTER COLUMN title TYPE varchar(255) USING (title->>'id'),
                ALTER COLUMN excerpt TYPE text USING (excerpt->>'id'),
                ALTER COLUMN content TYPE text USING (content->>'id')
        SQL);
    }
};
