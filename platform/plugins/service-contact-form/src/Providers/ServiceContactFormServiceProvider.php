<?php

namespace Botble\ServiceContactForm\Providers;

use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\FormAbstract;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Contact\Forms\Settings\ContactSettingForm;
use Botble\ServiceContactForm\Support\ServiceContactFormTemplate;

class ServiceContactFormServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/service-contact-form')
            ->loadAndPublishViews()
            ->loadAndPublishTranslations();

        FormAbstract::beforeRendering(function (FormAbstract $form) {
            if ($form instanceof ContactSettingForm) {
                $form->addAfter('blacklist_keywords', 'service_detail_contact_form_template', EditorField::class, [
                    'label' => trans('plugins/service-contact-form::service-contact-form.settings.template_label'),
                    'value' => setting('service_detail_contact_form_template', ServiceContactFormTemplate::defaultTemplate()),
                    'attr' => [
                        'with-short-code' => false,
                    ],
                    'help_block' => [
                        'text' => trans('plugins/service-contact-form::service-contact-form.settings.template_help'),
                    ],
                ]);
            }

            return $form;
        }, 9999);

        add_filter('contact_settings_validation_rules', function (array $rules): array {
            return array_merge($rules, [
                'service_detail_contact_form_template' => ['nullable', 'string'],
            ]);
        }, 99);
    }
}
