<?php

namespace Botble\Tour;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\DB;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        $pluginId = function_exists('tour_plugin_id')
            ? tour_plugin_id()
            : 'al/tour';

        // Delete translation rows first (Language Advanced tables don't have plugin_id)
        DB::table('tours_translations')
            ->whereIn('tours_id', function ($query) use ($pluginId) {
                $query->select('id')->from('tours')->where('plugin_id', $pluginId);
            })
            ->delete();

        DB::table('tour_categories_translations')
            ->whereIn('tour_categories_id', function ($query) use ($pluginId) {
                $query->select('id')->from('tour_categories')->where('plugin_id', $pluginId);
            })
            ->delete();

        DB::table('tour_tour_categories')->where('plugin_id', $pluginId)->delete();
        DB::table('tours')->where('plugin_id', $pluginId)->delete();
        DB::table('tour_categories')->where('plugin_id', $pluginId)->delete();
    }
}
