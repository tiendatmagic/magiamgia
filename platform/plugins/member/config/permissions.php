<?php

return [
    [
        'name' => 'Members',
        'flag' => 'member.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'member.create',
        'parent_flag' => 'member.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'member.edit',
        'parent_flag' => 'member.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'member.destroy',
        'parent_flag' => 'member.index',
    ],
    [
        'name' => 'Member Settings',
        'flag' => 'member.settings',
        'parent_flag' => 'member.index',
    ],
];
