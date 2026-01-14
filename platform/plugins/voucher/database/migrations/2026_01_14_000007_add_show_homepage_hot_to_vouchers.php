<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
  public function up(): void
  {
    Schema::table('bng_vouchers', function (Blueprint $table) {
      $table->boolean('show_homepage_hot')->default(false)->after('is_hot');
    });
  }

  public function down(): void
  {
    Schema::table('bng_vouchers', function (Blueprint $table) {
      $table->dropColumn('show_homepage_hot');
    });
  }
};
