<?php

return [
    [
        'name' => 'Product',
        'flag' => 'plugins.product',
    ],
    [
        'name' => 'Products',
        'flag' => 'products.index',
        'parent_flag' => 'plugins.product',
    ],
    [
        'name' => 'Create',
        'flag' => 'products.create',
        'parent_flag' => 'products.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'products.edit',
        'parent_flag' => 'products.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'products.destroy',
        'parent_flag' => 'products.index',
    ],

    [
        'name' => 'ProductCategories',
        'flag' => 'pcategories.index',
        'parent_flag' => 'plugins.product',
    ],
    [
        'name' => 'Create',
        'flag' => 'pcategories.create',
        'parent_flag' => 'pcategories.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'pcategories.edit',
        'parent_flag' => 'pcategories.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'pcategories.destroy',
        'parent_flag' => 'pcategories.index',
    ],

    [
        'name' => 'ProductTags',
        'flag' => 'ptags.index',
        'parent_flag' => 'plugins.product',
    ],
    [
        'name' => 'Create',
        'flag' => 'ptags.create',
        'parent_flag' => 'ptags.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'ptags.edit',
        'parent_flag' => 'ptags.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'ptags.destroy',
        'parent_flag' => 'ptags.index',
    ],
];
