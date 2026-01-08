<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tours')) {
            return;
        }

        Schema::table('tours', function (Blueprint $table) {
            if (! Schema::hasColumn('tours', 'images')) {
                $table->json('images')->nullable()->after('image');
            }

            if (! Schema::hasColumn('tours', 'location')) {
                $table->string('location', 255)->nullable()->after('images');
            }

            if (! Schema::hasColumn('tours', 'departure_time')) {
                $table->string('departure_time', 255)->nullable()->after('location');
            }
        });
    }

    public function down(): void
        // Shared table; do not drop columns on rollback.
    {
    }
};
