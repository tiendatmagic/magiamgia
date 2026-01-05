<?php

return [
    'name' => 'Service Contact Form',
    'description' => 'Service detail contact form template',

    'settings' => [
        'template_label' => 'Contact form (service detail)',
        'template_help' => 'Supported placeholders: [[action]], [[csrf]], [[service_title]], [[service_id]].',
    ],

    'form' => [
        'title' => 'INFORMATION FORM',
        'service_selected_label' => 'Selected service',
        'name_label' => 'Full name',
        'name_placeholder' => 'Enter your full name',
        'phone_label' => 'Phone number',
        'phone_placeholder' => 'Enter your phone number',
        'date_label' => 'Departure date',
        'date_placeholder' => 'Select departure date',
        'submit' => 'Send information',
    ],
];
