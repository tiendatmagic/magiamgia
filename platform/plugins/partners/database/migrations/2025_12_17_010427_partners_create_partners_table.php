<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('partners')) {
            Schema::create('partners', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('image')->nullable();
                $table->string('link')->nullable();
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('partners_translations')) {
            Schema::create('partners_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('partners_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'partners_id'], 'partners_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
        Schema::dropIfExists('partners_translations');
    }
};
