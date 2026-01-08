<?php

namespace Botble\Voucher;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\DB;

class Plugin extends PluginOperationAbstract
{
  public static function remove(): void
  {
    DB::table('bng_vouchers')->delete();
    DB::table('bng_voucher_providers')->delete();
  }
}
