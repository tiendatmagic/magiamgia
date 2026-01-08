<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tours')) {
            return;
        }

        $columns = ['original_price', 'adult_price', 'child_price'];

        foreach ($columns as $column) {
            if (! Schema::hasColumn('tours', $column)) {
                return;
            }
        }

        $driver = Schema::getConnection()->getDriverName();

        try {
            if ($driver === 'mysql') {
                // Convert decimals to integer (VND). MySQL will truncate decimals.
                DB::statement('ALTER TABLE `tours` MODIFY `original_price` BIGINT NULL');
                DB::statement('ALTER TABLE `tours` MODIFY `adult_price` BIGINT NULL');
                DB::statement('ALTER TABLE `tours` MODIFY `child_price` BIGINT NULL');

                return;
            }

            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE tours ALTER COLUMN original_price TYPE BIGINT USING ROUND(original_price)::BIGINT');
                DB::statement('ALTER TABLE tours ALTER COLUMN adult_price TYPE BIGINT USING ROUND(adult_price)::BIGINT');
                DB::statement('ALTER TABLE tours ALTER COLUMN child_price TYPE BIGINT USING ROUND(child_price)::BIGINT');

                return;
            }

            // sqlite / sqlsrv: no-op (schema change requires table rebuild)
        } catch (Throwable) {
            // Best-effort migration for shared installations.
        }
    }

    public function down(): void
    {
        // Shared tables; do not revert.
    }
};
