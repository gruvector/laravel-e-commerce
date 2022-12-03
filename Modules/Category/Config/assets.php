<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'all_assets' => [
        'admin.category.css' => ['module' => 'category:admin/css/category.css'],
        'admin.category.js' => ['module' => 'category:admin/js/category.js'],
        'admin.jstree.js' => ['module' => 'category:admin/js/jstree.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'required_assets' => [],
];
