<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
  public function up(): void
  {
    if (Schema::hasTable('bng_voucher_providers')) {
      Schema::table('bng_voucher_providers', function (Blueprint $table) {
        if (!Schema::hasColumn('bng_voucher_providers', 'cover_image')) {
          $table->string('cover_image')->nullable()->after('logo');
        }
      });
    }
  }

  public function down(): void
  {
    if (Schema::hasTable('bng_voucher_providers')) {
      Schema::table('bng_voucher_providers', function (Blueprint $table) {
        if (Schema::hasColumn('bng_voucher_providers', 'cover_image')) {
          $table->dropColumn('cover_image');
        }
      });
    }
  }
};
