<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;

app('events')->listen(RenderingThemeOptionSettings::class, function () {
    theme_option()
        ->setField([
            'id' => 'primary_font',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'googleFonts',
            'label' => __('Primary font'),
            'attributes' => [
                'name' => 'primary_font',
                'value' => 'Roboto',
            ],
        ])
        ->setField([
            'id' => 'primary_color',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'customColor',
            'label' => __('Primary color'),
            'attributes' => [
                'name' => 'primary_color',
                'value' => '#AF0F26',
            ],
        ])
        ->setField([
            'id' => 'default_breadcrumb_banner_image',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'mediaImage',
            'label' => __('Default banner image (1920x170px)'),
            'attributes' => [
                'name' => 'default_breadcrumb_banner_image',
                'value' => null,
            ],
        ])
        ->setField([
            'id' => 'site_description',
            'section_id' => 'opt-text-subsection-general',
            'type' => 'textarea',
            'label' => __('Site description'),
            'attributes' => [
                'name' => 'site_description',
                'value' => null,
                'options' => [
                    'rows' => 5,
                    'class' => 'form-control',
                    'data-counter' => 255,
                ],
            ],
        ])
        ->setField([
            'id' => 'facebook_comment_enabled_in_gallery',
            'section_id' => 'opt-text-subsection-facebook-integration',
            'type' => 'customSelect',
            'label' => __('Enable Facebook comment in the gallery detail?'),
            'attributes' => [
                'name' => 'facebook_comment_enabled_in_gallery',
                'list' => [
                    'no' => trans('core/base::base.no'),
                    'yes' => trans('core/base::base.yes'),
                ],
                'value' => 'no',
            ],
        ]);

    theme_option()->setSection([
        'title' => __('Contact Button Settings'),
        'desc' => __('Contact Button Settings'),
        'id' => 'contact-button-settings',
        'subsection' => true,
        'priority' => 2,
        'icon' => 'fa fa-id-card',
    ]);

    theme_option()->setField([
        'id' => 'phone_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Phone Number'),
        'attributes' => [
            'name' => 'phone_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Phone Number'),
                'data-counter' => 255,
            ],
        ],
    ]);

    theme_option()->setField([
        'id' => 'facebook_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Facebook Link'),
        'attributes' => [
            'name' => 'facebook_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Facebook Link'),
                'data-counter' => 255,
            ],
        ],
    ]);

    theme_option()->setField([
        'id' => 'facebook_messenger_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Facebook Messenger Link'),
        'attributes' => [
            'name' => 'facebook_messenger_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Facebook Messenger Link'),
                'data-counter' => 255,
            ],
        ],
    ]);

    theme_option()->setField([
        'id' => 'whatsapp_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Whatsapp Link'),
        'attributes' => [
            'name' => 'whatsapp_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Whatsapp Link'),
                'data-counter' => 255,
            ],
        ],
    ]);

    theme_option()->setField([
        'id' => 'zalo_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Zalo Link'),
        'attributes' => [
            'name' => 'zalo_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Zalo Link'),
                'data-counter' => 255,
            ],
        ],
    ]);

    theme_option()->setField([
        'id' => 'google_map_link',
        'section_id' => 'contact-button-settings',
        'type' => 'text',
        'label' => __('Enter Google Map Link'),
        'attributes' => [
            'name' => 'google_map_link',
            'value' => null,
            'options' => [
                'class' => 'form-control',
                'placeholder' => __('Enter Google Map Link'),
                'data-counter' => 255,
            ],
        ],
    ]);
    theme_option()->setField([
        'id' => 'contact_button_position',
        'section_id' => 'contact-button-settings',
        'type' => 'customSelect',
        'label' => __('Contact buttons position'),
        'attributes' => [
            'name' => 'contact_button_position',
            'list' => [
                'right' => __('Right'),
                'left' => __('Left'),
            ],
            'value' => 'right',
        ],
    ]);

    theme_option()->setField([
        'id' => 'contact_button_show_on_mobile',
        'section_id' => 'contact-button-settings',
        'type' => 'customSelect',
        'label' => __('Show contact buttons on mobile?'),
        'attributes' => [
            'name' => 'contact_button_show_on_mobile',
            'list' => [
                'no' => trans('core/base::base.no'),
                'yes' => trans('core/base::base.yes'),
            ],
            'value' => 'yes',
        ],
    ]);

    theme_option()->setField([
        'id' => 'contact_button_show_on_desktop',
        'section_id' => 'contact-button-settings',
        'type' => 'customSelect',
        'label' => __('Show contact buttons on desktop?'),
        'attributes' => [
            'name' => 'contact_button_show_on_desktop',
            'list' => [
                'no' => trans('core/base::base.no'),
                'yes' => trans('core/base::base.yes'),
            ],
            'value' => 'yes',
        ],
    ]);
});
