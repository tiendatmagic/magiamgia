<?php

namespace Botble\Tour\Forms;

use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImagesFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\DatePickerField;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\MediaFileField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\MediaImagesField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TreeCategoryField;
use Botble\Base\Forms\FormAbstract;
use Botble\Tour\Models\Tour;

class TourForm extends FormAbstract
{
    public function setup(): void
    {
        $images = $this->getModel() ? ($this->getModel()->images ?? []) : [];

        if (is_string($images) && $images !== '') {
            $images = [$images];
        }

        if (! is_array($images)) {
            $images = [];
        }

        $this
            ->model(Tour::class)
            // Prevent the Slug package from auto-injecting its Permalink field for this model.
            // This plugin uses the `link` column for routing, and we want the UI to match TourCategory.
            ->add('slug', HtmlField::class, [
                'html' => '',
            ])
            ->add('name', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_name'),
                'required' => true,
            ])
            ->add('link', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_link'),
                'required' => false,
                'attributes' => [
                    'id' => 'tour-link',
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

                        $link = $model->link;

                        // When editing translation, prefer translated link if present
                        if ($defaultLocaleCode && $currentLocaleCode && $currentLocaleCode !== $defaultLocaleCode && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                            try {
                                $translatedLink = \Illuminate\Support\Facades\DB::table('tours_translations')
                                    ->where('lang_code', $currentLocaleCode)
                                    ->where('tours_id', $model->getKey())
                                    ->value('link');

                                if ($translatedLink) {
                                    $link = $translatedLink;
                                }
                            } catch (\Throwable) {
                                // ignore
                            }
                        }

                        if (! $link) {
                            return '';
                        }

                        // Preview uses the canonical public URL: /{tour-prefix}/{link}
                        if (function_exists('tour_public_path')) {
                            $path = tour_public_path($link, $currentLocaleCode);
                        } else {
                            $path = '/tour/' . ltrim($link, '/');
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
            ->add('image', MediaImageField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_image'),
                'required' => true,
            ])
            ->add(
                'images[]',
                MediaImagesField::class,
                [
                    ...MediaImagesFieldOption::make()
                        ->label(trans('plugins/tour::tour.forms.tour_gallery'))
                        ->toArray(),
                    'values' => $images,
                ]
            )
            ->add('location', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_location'),
                'required' => false,
                'attributes' => [
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_location'),
                ],
            ])
            ->add('tour_meta_row_open', HtmlField::class, [
                'html' => '<div class="row">',
                'label' => false,
                'wrapper' => false,
            ])
            ->add('duration', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_duration'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_duration'),
                ],
            ])
            ->add('departure_time', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_departure_time'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_departure_time'),
                ],
            ])
            ->add('vehicle', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_vehicle'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_vehicle'),
                ],
            ])
            ->add('tour_meta_row_close', HtmlField::class, [
                'html' => '</div>',
                'label' => false,
                'wrapper' => false,
            ])
            ->add('tour_price_row_open', HtmlField::class, [
                'html' => '<div class="row">',
                'label' => false,
                'wrapper' => false,
            ])
            ->add('original_price', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_original_price'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'type' => 'number',
                    'step' => '1',
                    'min' => '0',
                    'inputmode' => 'numeric',
                    'pattern' => '\\d*',
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_price'),
                ],
            ])
            ->add('adult_price', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_adult_price'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'type' => 'number',
                    'step' => '1',
                    'min' => '0',
                    'inputmode' => 'numeric',
                    'pattern' => '\\d*',
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_price'),
                ],
            ])
            ->add('child_price', TextField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_child_price'),
                'required' => false,
                'wrapper' => [
                    'class' => 'col-md-4 mb-3',
                ],
                'attributes' => [
                    'type' => 'number',
                    'step' => '1',
                    'min' => '0',
                    'inputmode' => 'numeric',
                    'pattern' => '\\d*',
                    'placeholder' => trans('plugins/tour::tour.forms.placeholder_price'),
                ],
            ])
            ->add('tour_price_row_close', HtmlField::class, [
                'html' => '</div>',
                'label' => false,
                'wrapper' => false,
            ])

            ->add('intro', EditorField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_intro'),
                'required' => false,
                'attr' => [
                    'with-short-code' => true,
                    'rows' => 2,
                ],
            ])
            ->add('tour_editor_hr_1', HtmlField::class, [
                'html' => '<hr class="my-5">',
                'label' => false,
                'wrapper' => false,
            ])
            ->add('content', EditorField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_content'),
                'required' => false,
                'attr' => [
                    'with-short-code' => true,
                ],
            ])
            ->add('tour_editor_hr_2', HtmlField::class, [
                'html' => '<hr class="my-5">',
                'label' => false,
                'wrapper' => false,
            ])
            ->add('policy', EditorField::class, [
                'label' => trans('plugins/tour::tour.forms.tour_policy'),
                'required' => false,
                'attr' => [
                    'with-short-code' => true,
                    'rows' => 2,
                ],
            ])
            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()->toArray()
            )

            ->setBreakFieldPoint('status')

            ->add(
                'categories[]',
                TreeCategoryField::class,
                SelectFieldOption::make()
                    ->label(trans('plugins/tour::tour.forms.tour_categories'))
                    ->choices(get_tour_categories_with_children())
                    ->selected(is_array(request()->old('categories', [])) ? request()->old('categories', []) : [])
                    ->required()
                    ->when($this->getModel()->getKey(), function (SelectFieldOption $fieldOption) {
                        $model = $this->getModel();

                        return $fieldOption->selected($model->categories()->pluck('tour_category_id')->all());
                    })
                    ->toArray()
            )
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
    }
}
