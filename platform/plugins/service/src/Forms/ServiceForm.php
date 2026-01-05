<?php

namespace Botble\Service\Forms;

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\TreeCategoryField;
use Botble\Base\Forms\FormAbstract;
use Botble\Service\Models\Service;

class ServiceForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(Service::class)
            ->add('name', TextField::class, [
                'label' => 'Tên dịch vụ',
                'required' => true,
            ])
            ->add('image', MediaImageField::class, [
                'label' => 'Hình ảnh',
                'required' => true,
            ])
            ->add('link', TextField::class, [
                'label' => 'Đường dẫn dịch vụ',
                'required' => false,
                'attributes' => [
                    'placeholder' => 'ví dụ: ten-dich-vu',
                    'pattern' => '^[A-Za-z0-9\-]+$',
                    'title' => 'Chỉ cho phép chữ, số và dấu gạch ngang (-).',
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
                                $translatedLink = \Illuminate\Support\Facades\DB::table('services_translations')
                                    ->where('lang_code', $currentLocaleCode)
                                    ->where('services_id', $model->getKey())
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

                        // Determine a category slug for building preview URL.
                        // Prefer translated category slug for current locale; fallback to base slug.
                        $categorySlug = null;

                        try {
                            $primaryCategoryId = $model->categories()->pluck('service_category_id')->first();

                            if ($primaryCategoryId) {
                                $categorySlug = \Botble\Service\Models\ServiceCategory::query()
                                    ->whereKey($primaryCategoryId)
                                    ->value('slug') ?: $categorySlug;

                                if ($defaultLocaleCode && $currentLocaleCode && $currentLocaleCode !== $defaultLocaleCode && function_exists('is_plugin_active') && is_plugin_active('language-advanced')) {
                                    $translatedCategorySlug = \Illuminate\Support\Facades\DB::table('service_categories_translations')
                                        ->where('lang_code', $currentLocaleCode)
                                        ->where('service_categories_id', $primaryCategoryId)
                                        ->value('slug');

                                    if ($translatedCategorySlug) {
                                        $categorySlug = $translatedCategorySlug;
                                    }
                                }
                            }
                        } catch (\Throwable) {
                            // ignore
                        }

                        // If no category is available, preview falls back to /{locale}/{link}
                        $path = $categorySlug ? ($categorySlug.'/'.$link) : $link;

                        $path = '/'.ltrim($path, '/');

                        if (function_exists('is_plugin_active') && is_plugin_active('language') && $currentLocaleKey) {
                            $url = \Botble\Language\Facades\Language::localizeURL($path, $currentLocaleKey);
                        } else {
                            $url = url($path);
                        }

                        return 'Xem trước: <a href="'.$url.'" target="_blank">'.$url.'</a>';
                    })(),
                ],
            ])
            ->add('content', EditorField::class, [
                'label' => 'Nội dung',
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
                'categories[]',
                TreeCategoryField::class,
                SelectFieldOption::make()
                    ->label('Danh mục dịch vụ')
                    ->choices(get_service_categories_with_children())
                    ->selected(is_array(request()->old('categories', [])) ? request()->old('categories', []) : [])
                    ->required()
                    ->when($this->getModel()->getKey(), function (SelectFieldOption $fieldOption) {
                        $model = $this->getModel();

                        return $fieldOption->selected($model->categories()->pluck('service_category_id')->all());
                    })
                    ->toArray()
            );
    }
}
