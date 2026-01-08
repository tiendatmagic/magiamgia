<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tour_categories') && ! Schema::hasColumn('tour_categories', 'parent_id')) {
            Schema::table('tour_categories', function (Blueprint $table) {
                $table->foreignId('parent_id')->nullable()->after('slug');
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
