<?php

namespace Botble\Tour\Forms;

use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\DatePickerField;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Tour\Models\TourCategory;

class TourCategoryForm extends FormAbstract
{
    public function setup(): void
    {
        $modelId = $this->getModel() ? $this->getModel()->getKey() : null;
        $parentOptions = [
            '' => trans('plugins/tour::tour.forms.no_parent'),
        ];

        $parents = TourCategory::query()
            ->when($modelId, fn($q) => $q->whereKeyNot($modelId))
            ->orderBy('name')
            ->pluck('name', 'id')
            ->all();

        $parentOptions = $parentOptions + $parents;

        $this
            ->model(TourCategory::class)
            ->add('name', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.category_name'),
                'required' => true,
            ])
            ->add('parent_id', SelectField::class, [
                'label' => trans('plugins/tour::tour.forms.category_parent'),
                'required' => false,
                'choices' => $parentOptions,
            ])
            ->add('slug', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.category_slug'),
                'required' => false,
                'attributes' => [
                    'id' => 'tour-category-slug',
                ],
                'help_block' => [
                    'text' => (function () {
                        $model = $this->getModel();

                        if (! $model || ! $model->getKey()) {
                            return '';
                        }

                        $currentLocaleKey = null;
                        $currentLocaleCode = null;
                        $defaultLocaleCode = null;

                        if (function_exists('is_plugin_active') && is_plugin_active('language')) {
                            try {
                                $currentLocaleKey = \Botble\Language\Facades\Language::getCurrentAdminLocale();
                                $currentLocaleCode = \Botble\Language\Facades\Language::getCurrentAdminLocaleCode();
                                $defaultLocaleCode = \Botble\Language\Facades\Language::getDefaultLocaleCode();
                            } catch (\Throwable) {
                                // ignore
                            }
                        }

                        $pluginId = function_exists('tour_plugin_id')
                            ? tour_plugin_id()
                            : 'al/tour';

                        // Build a canonical, locale-aware path without duplicating locale segments.
                        // Avoid using $model->url because it may already include a locale prefix.
                        $segments = [];
                        $current = $model;
                        $guard = 0;

                        while ($current && $guard++ < 10) {
                            $slug = $current->slug;

                            // When editing translation, prefer translated slug if present for each segment
                            if ($defaultLocaleCode && $currentLocaleCode && $currentLocaleCode !== $defaultLocaleCode && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                                try {
                                    $translatedSlug = \Illuminate\Support\Facades\DB::table('tour_categories_translations')
                                        ->where('lang_code', $currentLocaleCode)
                                        ->where('tour_categories_id', $current->getKey())
                                        ->value('slug');

                                    if ($translatedSlug) {
                                        $slug = $translatedSlug;
                                    }
                                } catch (\Throwable) {
                                    // ignore
                                }
                            }

                            if (! $slug) {
                                break;
                            }

                            array_unshift($segments, trim((string) $slug, '/'));

                            if (! $current->parent_id) {
                                break;
                            }

                            $current = \Botble\Tour\Models\TourCategory::query()
                                ->where('plugin_id', $pluginId)
                                ->whereKey($current->parent_id)
                                ->first(['id', 'slug', 'parent_id']);
                        }

                        if (empty($segments)) {
                            return '';
                        }

                        $slugPath = implode('/', array_filter($segments));

                        if (function_exists('tour_public_path')) {
                            $path = tour_public_path($slugPath, $currentLocaleCode);
                        } else {
                            $path = '/' . ltrim($slugPath, '/');
                        }

                        if (function_exists('is_plugin_active') && is_plugin_active('language') && $currentLocaleKey) {
                            $url = \Botble\Language\Facades\Language::localizeURL($path, $currentLocaleKey);
                        } else {
                            $url = url($path);
                        }

                        return trans('plugins/tour::tour.forms.preview') . ': <a href="' . $url . '" target="_blank">' . $url . '</a>';
                    })(),
                ],
            ])
            ->add('description', EditorField::class, [
                'label' => trans('plugins/tour::tour.forms.category_description'),
                'required' => false,
                'attr' => [
                    'with-short-code' => true,
                ],
            ])
            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()->toArray()
            )
            ->setBreakFieldPoint('status')

            ->add(
                'created_at',
                DatePickerField::class,
                DatePickerFieldOption::make()
                    ->label(trans('core/base::tables.created_at'))
                    ->value(old('created_at', $this->getModel()?->created_at?->format('d/m/Y')))
                    ->attributes([
                        'data-date-format' => 'd/m/Y',
                        'data-enable-time' => true,
                        'data-enable-seconds' => true,
                        'data-time-24hr' => true,
                        'placeholder' => 'dd/mm/yyyy HH:mm:ss',
                        'readonly' => false,
                        'inputmode' => 'numeric',
                    ])
                    ->toArray()
            );

        // Slug uniqueness is handled in the model booted() saving callback.
    }
}
