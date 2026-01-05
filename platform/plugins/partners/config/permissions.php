<?php

return [
    [
        'name' => 'Partners',
        'flag' => 'partners.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'partners.create',
        'parent_flag' => 'partners.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'partners.edit',
        'parent_flag' => 'partners.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'partners.destroy',
        'parent_flag' => 'partners.index',
    ],
];
