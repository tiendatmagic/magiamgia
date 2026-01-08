<?php

return [
    [
        'name' => 'Tours',
        'flag' => 'tour.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'tour.create',
        'parent_flag' => 'tour.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'tour.edit',
        'parent_flag' => 'tour.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'tour.destroy',
        'parent_flag' => 'tour.index',
    ],
    [
        'name' => 'Tour categories',
        'flag' => 'tour-category.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'tour-category.create',
        'parent_flag' => 'tour-category.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'tour-category.edit',
        'parent_flag' => 'tour-category.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'tour-category.destroy',
        'parent_flag' => 'tour-category.index',
    ],
];
