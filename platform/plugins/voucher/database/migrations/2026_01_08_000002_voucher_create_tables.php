<?php

use Botble\Base\Enums\BaseStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
  public function up(): void
  {
    Schema::create('bng_voucher_providers', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('logo')->nullable();
      $table->text('description')->nullable();
      $table->string('button_1_text')->nullable();
      $table->text('button_1_url')->nullable();
      $table->string('button_2_text')->nullable();
      $table->text('button_2_url')->nullable();
      $table->longText('tags')->nullable();
      $table->longText('accordions')->nullable();
      $table->string('status', 60)->default(BaseStatusEnum::PUBLISHED);
      $table->timestamps();
    });

    Schema::create('bng_vouchers', function (Blueprint $table) {
      $table->id();
      $table->foreignId('provider_id')->nullable()->constrained('bng_voucher_providers')->nullOnDelete();
      $table->string('category')->nullable();
      $table->string('code')->nullable();
      $table->enum('discount_type', ['percent', 'amount'])->default('percent');
      $table->decimal('discount_value', 15, 2)->default(0);
      $table->decimal('max_discount', 15, 2)->nullable();
      $table->decimal('min_order', 15, 2)->nullable();
      $table->text('note')->nullable();
      $table->text('apply_url')->nullable();
      $table->text('banner_url')->nullable();
      $table->date('expired_at')->nullable();
      $table->string('status', 60)->default(BaseStatusEnum::PUBLISHED);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('bng_vouchers');
    Schema::dropIfExists('bng_voucher_providers');
  }
};
