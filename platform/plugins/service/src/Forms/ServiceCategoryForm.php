<?php

namespace Botble\Service\Forms;

use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Service\Models\ServiceCategory;

class ServiceCategoryForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(ServiceCategory::class)
            ->add('name', TextField::class, [
                'label' => 'Tên danh mục',
                'required' => true,
            ])
            ->add('slug', TextField::class, [
                'label' => 'Đường dẫn danh mục',
                'required' => false,
                'attributes' => [
                    'id' => 'service-category-slug',
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

                        $slug = $model->slug;

                        // When editing translation, prefer translated slug if present
                        if ($defaultLocaleCode && $currentLocaleCode && $currentLocaleCode !== $defaultLocaleCode && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                            try {
                                $translatedSlug = \Illuminate\Support\Facades\DB::table('service_categories_translations')
                                    ->where('lang_code', $currentLocaleCode)
                                    ->where('service_categories_id', $model->getKey())
                                    ->value('slug');

                                if ($translatedSlug) {
                                    $slug = $translatedSlug;
                                }
                            } catch (\Throwable) {
                                // ignore
                            }
                        }

                        if (! $slug) {
                            return '';
                        }

                        $path = '/' . ltrim($slug, '/');

                        if (function_exists('is_plugin_active') && is_plugin_active('language') && $currentLocaleKey) {
                            $url = \Botble\Language\Facades\Language::localizeURL($path, $currentLocaleKey);
                        } else {
                            $url = url($path);
                        }

                        return 'Xem trước: <a href="' . $url . '" target="_blank">' . $url . '</a>';
                    })(),
                ],
            ])
            ->add('description', EditorField::class, [
                'label' => 'Mô tả',
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
            ->setBreakFieldPoint('status');

        // Slug uniqueness is handled in the model booted() saving callback.
    }
}
