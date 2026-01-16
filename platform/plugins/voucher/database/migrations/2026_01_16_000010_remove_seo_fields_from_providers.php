<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
  public function up(): void
  {
    if (Schema::hasTable('bng_voucher_providers')) {
      Schema::table('bng_voucher_providers', function (Blueprint $table) {
        if (Schema::hasColumn('bng_voucher_providers', 'seo_title')) {
          $table->dropColumn('seo_title');
        }
        if (Schema::hasColumn('bng_voucher_providers', 'seo_description')) {
          $table->dropColumn('seo_description');
        }
      });
    }
  }

  public function down(): void
  {
    if (Schema::hasTable('bng_voucher_providers')) {
      Schema::table('bng_voucher_providers', function (Blueprint $table) {
        if (!Schema::hasColumn('bng_voucher_providers', 'seo_title')) {
          $table->string('seo_title')->nullable()->after('cover_image');
        }
        if (!Schema::hasColumn('bng_voucher_providers', 'seo_description')) {
          $table->text('seo_description')->nullable()->after('seo_title');
        }
      });
    }
  }
};
