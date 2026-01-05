<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('service_categories_translations')) {
            Schema::create('service_categories_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('service_categories_id');
                $table->string('name', 255)->nullable();
                $table->string('slug', 255)->nullable();
                $table->text('description')->nullable();

                $table->primary(
                    ['lang_code', 'service_categories_id'],
                    'service_categories_translations_primary'
                );
            });
        }

        if (! Schema::hasTable('service_service_categories')) {
            Schema::create('service_service_categories', function (Blueprint $table) {
                $table->string('plugin_id', 120)->index();
                $table->foreignId('service_id');
                $table->foreignId('service_category_id');

                $table->primary(
                    ['plugin_id', 'service_id', 'service_category_id'],
                    'service_service_categories_primary'
                );
            });
        } else {
            if (! Schema::hasColumn('service_service_categories', 'plugin_id')) {
                Schema::table('service_service_categories', function (Blueprint $table) {
                    $table->string('plugin_id', 120)->nullable()->index();
                });
            }
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
