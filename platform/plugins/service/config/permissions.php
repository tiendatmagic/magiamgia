<?php

return [
    [
        'name' => 'Services',
        'flag' => 'service.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'service.create',
        'parent_flag' => 'service.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'service.edit',
        'parent_flag' => 'service.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'service.destroy',
        'parent_flag' => 'service.index',
    ],
    [
        'name' => 'Service categories',
        'flag' => 'service-category.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'service-category.create',
        'parent_flag' => 'service-category.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'service-category.edit',
        'parent_flag' => 'service-category.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'service-category.destroy',
        'parent_flag' => 'service-category.index',
    ],
];
