<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('services_translations') && ! Schema::hasColumn('services_translations', 'link')) {
            Schema::table('services_translations', function (Blueprint $table) {
                $table->string('link', 255)->nullable()->after('name');
            });
        }

        if (Schema::hasTable('service_categories_translations') && ! Schema::hasColumn('service_categories_translations', 'slug')) {
            Schema::table('service_categories_translations', function (Blueprint $table) {
                $table->string('slug', 255)->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
