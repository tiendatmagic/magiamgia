<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tours')) {
            Schema::table('tours', function (Blueprint $table) {
                if (! Schema::hasColumn('tours', 'duration')) {
                    $table->string('duration', 255)->nullable()->after('location');
                }

                if (! Schema::hasColumn('tours', 'vehicle')) {
                    $table->string('vehicle', 255)->nullable()->after('departure_time');
                }

                if (! Schema::hasColumn('tours', 'original_price')) {
                    $table->bigInteger('original_price')->nullable()->after('vehicle');
                }

                if (! Schema::hasColumn('tours', 'adult_price')) {
                    $table->bigInteger('adult_price')->nullable()->after('original_price');
                }

                if (! Schema::hasColumn('tours', 'child_price')) {
                    $table->bigInteger('child_price')->nullable()->after('adult_price');
                }

                if (! Schema::hasColumn('tours', 'attachment')) {
                    $table->string('attachment', 255)->nullable()->after('child_price');
                }

                if (! Schema::hasColumn('tours', 'intro')) {
                    $table->longText('intro')->nullable()->after('attachment');
                }

                if (! Schema::hasColumn('tours', 'policy')) {
                    $table->longText('policy')->nullable()->after('intro');
                }
            });
        }

        if (Schema::hasTable('tours_translations')) {
            Schema::table('tours_translations', function (Blueprint $table) {
                if (! Schema::hasColumn('tours_translations', 'intro')) {
                    $table->longText('intro')->nullable()->after('content');
                }

                if (! Schema::hasColumn('tours_translations', 'policy')) {
                    $table->longText('policy')->nullable()->after('intro');
                }
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop columns on rollback.
    }
};
