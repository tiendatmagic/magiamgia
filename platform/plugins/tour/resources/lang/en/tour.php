<?php

return [
    'name' => 'Tours',
    'subpage' => 'Tours page',
    'category' => 'Tour categories',
    'create' => 'Create tour',
    'settings' => 'Settings',
    'settings_description' => 'Configure tour URLs and other options.',
    'slug_prefix' => 'Tour URL prefix',
    'slug_prefix_helper' => 'Example: tour (no slashes).',
    'default_slug_prefix_en' => 'tour',
    'default_slug_prefix_vi' => 'tour',
    'view_more' => 'View more',
    'collapse' => 'Collapse',

    'public' => [
        'location' => 'Location',
        'duration' => 'Duration',
        'departure' => 'Departure',
        'vehicle' => 'Vehicle',

        'adult' => 'Adult',
        'child' => 'Child',
        'per_adult' => '/ adult',
        'per_child' => '/ child',

        'download_itinerary' => 'Download itinerary',
        'booking' => 'Booking',
        'information' => 'Information :name',
        'policy' => 'Policy :name',
    ],

    'forms' => [
        'preview' => 'Preview',

        'tour_name' => 'Tour name',
        'tour_link' => 'Tour URL',
        'tour_image' => 'Image',
        'tour_gallery' => 'Gallery',
        'tour_location' => 'Location',
        'tour_duration' => 'Duration',
        'tour_departure_time' => 'Departure',
        'tour_vehicle' => 'Vehicle',
        'tour_original_price' => 'Original price',
        'tour_adult_price' => 'Adult price',
        'tour_child_price' => 'Child price',
        'tour_attachment' => 'Attachment file',
        'tour_intro' => 'Intro',
        'tour_content' => 'Content',
        'tour_policy' => 'Policy',
        'tour_categories' => 'Tour categories',

        'placeholder_location' => 'Example: Nha Trang',
        'placeholder_duration' => 'Example: 3 days 2 nights',
        'placeholder_departure_time' => 'Example: Daily / 08:00',
        'placeholder_vehicle' => 'Example: bus, canoe',
        'placeholder_price' => 'Example: 3450000',

        'category_name' => 'Category name',
        'category_parent' => 'Parent category',
        'category_slug' => 'Category URL',
        'category_description' => 'Description',
        'no_parent' => '— None —',
    ],

    'validation' => [
        'tour_link_regex' => 'The tour URL may only contain letters, numbers, and hyphens (-).',
        'tour_link_unique' => 'This tour URL is already in use. Please choose another one.',
        'category_slug_regex' => 'The category slug may only contain letters, numbers, and hyphens (-).',
        'category_slug_unique' => 'This category slug is already in use. Please choose another one.',
    ],
];
