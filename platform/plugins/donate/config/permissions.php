<?php

return [
    [
        'name' => 'Donates',
        'flag' => 'donate.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'donate.create',
        'parent_flag' => 'donate.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'donate.edit',
        'parent_flag' => 'donate.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'donate.destroy',
        'parent_flag' => 'donate.index',
    ],
];
