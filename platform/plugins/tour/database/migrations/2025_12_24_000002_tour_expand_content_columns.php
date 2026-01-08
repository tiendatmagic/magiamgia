<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // TEXT can be too small for rich editor HTML, especially with multilingual content.
        // Use LONGTEXT to avoid SQLSTATE[22001] 1406 errors.

        if (Schema::hasTable('tours') && Schema::hasColumn('tours', 'content')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->longText('content')->nullable()->change();
            });
        }

        if (Schema::hasTable('tours_translations') && Schema::hasColumn('tours_translations', 'content')) {
            Schema::table('tours_translations', function (Blueprint $table) {
                $table->longText('content')->nullable()->change();
            });
        }

        if (Schema::hasTable('tour_categories') && Schema::hasColumn('tour_categories', 'description')) {
            Schema::table('tour_categories', function (Blueprint $table) {
                $table->longText('description')->nullable()->change();
            });
        }

        if (Schema::hasTable('tour_categories_translations') && Schema::hasColumn('tour_categories_translations', 'description')) {
            Schema::table('tour_categories_translations', function (Blueprint $table) {
                $table->longText('description')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not downsize columns on rollback.
    }
};
