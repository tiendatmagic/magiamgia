<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('service_categories')) {
            Schema::create('service_categories', function (Blueprint $table) {
                $table->id();
                $table->string('plugin_id', 120)->index();
                $table->string('name', 255);
                $table->string('slug', 255);
                $table->foreignId('parent_id')->nullable();
                $table->text('description')->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();

                $table->unique(['plugin_id', 'slug'], 'service_categories_plugin_id_slug_unique');
            });
        } else {
            if (! Schema::hasColumn('service_categories', 'plugin_id')) {
                Schema::table('service_categories', function (Blueprint $table) {
                    $table->string('plugin_id', 120)->nullable()->index()->after('id');
                });
            }

            if (! Schema::hasColumn('service_categories', 'parent_id')) {
                Schema::table('service_categories', function (Blueprint $table) {
                    $table->foreignId('parent_id')->nullable()->after('slug');
                });
            }
        }

        if (! Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('plugin_id', 120)->index();
                $table->string('name', 255);
                $table->string('image')->nullable();
                $table->text('content')->nullable();
                $table->string('link', 255)->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();

                $table->unique(['plugin_id', 'link'], 'services_plugin_id_link_unique');
            });
        } else {
            if (! Schema::hasColumn('services', 'plugin_id')) {
                Schema::table('services', function (Blueprint $table) {
                    $table->string('plugin_id', 120)->nullable()->index()->after('id');
                });
            }
        }

        if (! Schema::hasTable('services_translations')) {
            Schema::create('services_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('services_id');
                $table->string('name', 255)->nullable();
                $table->string('link', 255)->nullable();
                $table->text('content')->nullable();

                $table->primary(['lang_code', 'services_id'], 'services_translations_primary');
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
