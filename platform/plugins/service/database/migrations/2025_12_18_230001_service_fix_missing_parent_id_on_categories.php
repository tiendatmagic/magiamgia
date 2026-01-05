<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('service_categories') && ! Schema::hasColumn('service_categories', 'parent_id')) {
            Schema::table('service_categories', function (Blueprint $table) {
                $table->foreignId('parent_id')->nullable()->after('slug');
            });
        }
    }

    public function down(): void
    {
        // Shared tables; do not drop on rollback.
    }
};
