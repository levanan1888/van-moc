<?php

return [
    [
        'name' => 'Customer',
        'flag' => 'plugins.customer',
    ],
    [
        'name' => 'Customers',
        'flag' => 'customers.index',
        'parent_flag' => 'plugins.customers',
    ],
    [
        'name' => 'Create',
        'flag' => 'customers.create',
        'parent_flag' => 'customers.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'customers.edit',
        'parent_flag' => 'customers.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'customers.destroy',
        'parent_flag' => 'customers.index',
    ]
];
