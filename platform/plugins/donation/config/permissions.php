<?php

return [
    [
        'name' => 'Donations',
        'flag' => 'donation.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'donation.create',
        'parent_flag' => 'donation.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'donation.edit',
        'parent_flag' => 'donation.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'donation.destroy',
        'parent_flag' => 'donation.index',
    ],
];
