<?php

use Illuminate\Support\Str;

if (! function_exists('voucher_plugin_id')) {
  function voucher_plugin_id(): string
  {
    try {
      if (function_exists('plugin_path')) {
        $jsonPath = plugin_path('voucher/plugin.json');

        if (\Illuminate\Support\Facades\File::exists($jsonPath)) {
          $content = \Botble\Base\Facades\BaseHelper::getFileData($jsonPath);

          $id = (string) ($content['id'] ?? '');
          if ($id !== '') {
            return $id;
          }
        }
      }
    } catch (\Throwable) {
      // ignore
    }

    return 'bng/voucher';
  }
}

if (! function_exists('voucher_permalink_setting_key')) {
  function voucher_permalink_setting_key(string $modelClass): string
  {
    return 'permalink-' . Str::slug(str_replace('\\', '_', $modelClass));
  }
}
