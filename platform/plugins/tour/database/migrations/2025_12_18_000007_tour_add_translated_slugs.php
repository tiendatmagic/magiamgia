<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tours_translations') && ! Schema::hasColumn('tours_translations', 'link')) {
            Schema::table('tours_translations', function (Blueprint $table) {
                $table->string('link', 255)->nullable()->after('name');
            });
        }

        if (Schema::hasTable('tour_categories_translations') && ! Schema::hasColumn('tour_categories_translations', 'slug')) {
            Schema::table('tour_categories_translations', function (Blueprint $table) {
                $table->string('slug', 255)->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
