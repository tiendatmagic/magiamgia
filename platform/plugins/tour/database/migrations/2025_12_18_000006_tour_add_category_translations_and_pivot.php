<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tour_categories_translations')) {
            Schema::create('tour_categories_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('tour_categories_id');
                $table->string('name', 255)->nullable();
                $table->string('slug', 255)->nullable();
                $table->text('description')->nullable();

                $table->primary(
                    ['lang_code', 'tour_categories_id'],
                    'tour_categories_translations_primary'
                );
            });
        }

        if (! Schema::hasTable('tour_tour_categories')) {
            Schema::create('tour_tour_categories', function (Blueprint $table) {
                $table->string('plugin_id', 120)->index();
                $table->foreignId('tour_id');
                $table->foreignId('tour_category_id');

                $table->primary(
                    ['plugin_id', 'tour_id', 'tour_category_id'],
                    'tour_tour_categories_primary'
                );
            });
        } else {
            if (! Schema::hasColumn('tour_tour_categories', 'plugin_id')) {
                Schema::table('tour_tour_categories', function (Blueprint $table) {
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
