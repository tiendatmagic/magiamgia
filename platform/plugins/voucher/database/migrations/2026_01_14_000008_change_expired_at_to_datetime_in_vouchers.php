<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // First change column type to datetime
    Schema::table('bng_vouchers', function (Blueprint $table) {
      $table->dateTime('expired_at')->nullable()->change();
    });

    // Convert DATE to DATETIME at 00:00:00 (start of day)
    // No timezone conversion needed since MySQL is set to GMT+7
    DB::statement("
            UPDATE bng_vouchers
            SET expired_at = CONCAT(DATE(expired_at), ' 00:00:00')
            WHERE expired_at IS NOT NULL
        ");
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('bng_vouchers', function (Blueprint $table) {
      $table->date('expired_at')->nullable()->change();
    });
  }
};
