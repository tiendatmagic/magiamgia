<?php

namespace Botble\Service;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\DB;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        $pluginId = function_exists('service_plugin_id')
            ? service_plugin_id()
            : 'al/service';

        // Delete translation rows first (Language Advanced tables don't have plugin_id)
        DB::table('services_translations')
            ->whereIn('services_id', function ($query) use ($pluginId) {
                $query->select('id')->from('services')->where('plugin_id', $pluginId);
            })
            ->delete();

        DB::table('service_categories_translations')
            ->whereIn('service_categories_id', function ($query) use ($pluginId) {
                $query->select('id')->from('service_categories')->where('plugin_id', $pluginId);
            })
            ->delete();

        DB::table('service_service_categories')->where('plugin_id', $pluginId)->delete();
        DB::table('services')->where('plugin_id', $pluginId)->delete();
        DB::table('service_categories')->where('plugin_id', $pluginId)->delete();
    }
}
