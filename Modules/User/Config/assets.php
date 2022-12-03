<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'all_assets' => [
        'admin.user.css' => ['module' => 'user:admin/css/user.css'],
        'admin.user.js' => ['module' => 'user:admin/js/user.js'],
        'admin.login.css' => ['module' => 'user:admin/css/login.css'],
        'admin.login.js' => ['module' => 'user:admin/js/login.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'required_assets' => [],
];
