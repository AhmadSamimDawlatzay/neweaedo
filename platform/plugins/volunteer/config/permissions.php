<?php

return [
    [
        'name' => 'Volunteers',
        'flag' => 'volunteer.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'volunteer.create',
        'parent_flag' => 'volunteer.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'volunteer.edit',
        'parent_flag' => 'volunteer.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'volunteer.destroy',
        'parent_flag' => 'volunteer.index',
    ],
];
