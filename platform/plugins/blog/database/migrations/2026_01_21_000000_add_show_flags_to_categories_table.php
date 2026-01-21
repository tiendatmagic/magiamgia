<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
  public function up(): void
  {
    Schema::table('categories', function (Blueprint $table) {
      if (! Schema::hasColumn('categories', 'show_on_homepage')) {
        $table->tinyInteger('show_on_homepage')->unsigned()->default(0)->after('is_default');
      }
      if (! Schema::hasColumn('categories', 'show_on_provider')) {
        $table->tinyInteger('show_on_provider')->unsigned()->default(0)->after('show_on_homepage');
      }
    });
  }

  public function down(): void
  {
    Schema::table('categories', function (Blueprint $table) {
      if (Schema::hasColumn('categories', 'show_on_provider')) {
        $table->dropColumn('show_on_provider');
      }
      if (Schema::hasColumn('categories', 'show_on_homepage')) {
        $table->dropColumn('show_on_homepage');
      }
    });
  }
};
