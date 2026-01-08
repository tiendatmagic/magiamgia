<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\SortItemsWithChildrenHelper;
use Botble\Tour\Models\Tour;
use Botble\Tour\Models\TourCategory;
use Illuminate\Support\Str;

if (! function_exists('tour_plugin_id')) {
    function tour_plugin_id(): string
    {
        try {
            if (function_exists('plugin_path')) {
                $jsonPath = plugin_path('tour/plugin.json');

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

        return 'al/tour';
    }
}

if (! function_exists('get_tour_categories_with_children')) {
    function get_tour_categories_with_children(): array
    {
        $categories = TourCategory::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->select(['id', 'name', 'parent_id'])
            ->get();

        return app(SortItemsWithChildrenHelper::class)
            ->setChildrenProperty('child_cats')
            ->setItems($categories)
            ->sort();
    }
}

if (! function_exists('tour_default_slug_prefix')) {
    function tour_default_slug_prefix(?string $locale = null): string
    {
        $locale = $locale ?: (function_exists('is_plugin_active') && is_plugin_active('language')
            ? \Botble\Language\Facades\Language::getCurrentLocaleCode()
            : app()->getLocale());

        $locale = (string) $locale;
        $short = strtolower(strtok(str_replace('-', '_', $locale), '_') ?: $locale);

        // Use locale-specific defaults when available (e.g. default_slug_prefix_vi, default_slug_prefix_en).
        // This keeps the logic flexible for new languages without hard-coding them.
        $dynamicKey = 'plugins/tour::tour.default_slug_prefix_' . $short;

        try {
            if (\Illuminate\Support\Facades\Lang::hasForLocale($dynamicKey, $short)) {
                $value = trans($dynamicKey, [], $short);
                if ($value) {
                    return (string) $value;
                }
            }
        } catch (\Throwable) {
            // ignore
        }

        // Generic fallback if locale-specific default isn't defined.
        return trans('plugins/tour::tour.default_slug_prefix_en', [], 'en') ?: 'tour';
    }
}

if (! function_exists('tour_permalink_setting_key')) {
    function tour_permalink_setting_key(): string
    {
        // Must match Botble\Slug\SlugHelper::getPermalinkSettingKey() naming.
        return 'permalink-'.Str::slug(str_replace('\\', '_', Tour::class));
    }
}

if (! function_exists('tour_normalize_slug_prefix')) {
    function tour_normalize_slug_prefix(string $value): string
    {
        $value = trim($value);
        $value = trim($value, '/');
        $value = Str::slug($value);

        return $value;
    }
}

if (! function_exists('tour_slug_prefix')) {
    function tour_slug_prefix(?string $locale = null): string
    {
        $locale = $locale ?: (function_exists('is_plugin_active') && is_plugin_active('language')
            ? \Botble\Language\Facades\Language::getCurrentLocaleCode()
            : app()->getLocale());

        $locale = (string) $locale;

        $key = tour_permalink_setting_key();

        $defaultLocale = null;
        if (function_exists('is_plugin_active') && is_plugin_active('language')) {
            try {
                $defaultLocale = \Botble\Language\Facades\Language::getDefaultLocaleCode();
            } catch (\Throwable) {
                $defaultLocale = null;
            }
        }

        $defaultLocale = $defaultLocale ?: app()->getLocale();

        $localeNormalized = str_replace('-', '_', $locale);
        $localeShort = strtolower(strtok($localeNormalized, '_') ?: $localeNormalized);

        $keysToTry = [];

        // Primary key for the requested locale.
        $keysToTry[] = $localeNormalized !== $defaultLocale ? ($key.'-'.$localeNormalized) : $key;

        // Try short locale (en for en_US) or inverse (en_US for en) when settings were stored differently.
        if ($localeShort && $localeShort !== $localeNormalized) {
            $keysToTry[] = $localeShort !== $defaultLocale ? ($key.'-'.$localeShort) : $key;
        }

        // If Language plugin uses full codes like en_US but current locale is short (en),
        // try matching supported locale codes.
        if ($localeShort && function_exists('is_plugin_active') && is_plugin_active('language')) {
            try {
                $supported = array_keys(\Botble\Language\Facades\Language::getSupportedLocales());
                foreach ($supported as $supportedCode) {
                    $supportedCode = (string) $supportedCode;
                    $supportedShort = strtolower(strtok(str_replace('-', '_', $supportedCode), '_') ?: $supportedCode);
                    if ($supportedShort === $localeShort && $supportedCode !== $defaultLocale) {
                        $keysToTry[] = $key.'-'.str_replace('-', '_', $supportedCode);
                    }
                }
            } catch (\Throwable) {
                // ignore
            }
        }

        // Finally, fall back to default locale key.
        $keysToTry[] = $key;

        $value = null;
        foreach (array_unique(array_filter($keysToTry)) as $tryKey) {
            $tryValue = setting($tryKey);
            if ($tryValue !== null && $tryValue !== '') {
                $value = $tryValue;
                break;
            }
        }

        if ($value === null) {
            $value = tour_default_slug_prefix($locale);
        }

        $value = tour_normalize_slug_prefix((string) $value);

        return $value ?: tour_normalize_slug_prefix(tour_default_slug_prefix($locale));
    }
}

if (! function_exists('tour_all_locales_slug_prefixes')) {
    function tour_all_locales_slug_prefixes(): array
    {
        $prefixes = [];

        if (function_exists('is_plugin_active') && is_plugin_active('language')) {
            try {
                $languages = \Botble\Language\Facades\Language::getActiveLanguage(['lang_code']);
                foreach ($languages as $language) {
                    $code = $language->lang_code;
                    $prefixes[] = tour_slug_prefix($code);
                }
            } catch (\Throwable) {
                // ignore
            }
        }

        // If Language plugin is off (or fails), keep at least the current app locale prefix.
        if (empty($prefixes)) {
            $prefixes[] = tour_slug_prefix(app()->getLocale());
        }

        return array_values(array_unique(array_filter($prefixes)));
    }
}

if (! function_exists('tour_public_path')) {
    function tour_public_path(string $slug = '', ?string $locale = null): string
    {
        $prefix = trim(tour_slug_prefix($locale), '/');
        $slug = trim($slug, '/');

        return '/'.trim($prefix.'/'.$slug, '/');
    }
}
