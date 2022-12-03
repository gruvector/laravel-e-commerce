<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'all_assets' => [
        'admin.css' => ['module' => 'admin:css/admin.css'],
        'admin.js' => ['module' => 'admin:js/admin.js'],
        'admin.dashboard.css' => ['module' => 'admin:css/dashboard.css'],
        'admin.dashboard.js' => ['module' => 'admin:js/dashboard.js'],
        'admin.polyfill.js' => ['cdn' => 'https://cdn.polyfill.io/v2/polyfill.min.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'required_assets' => ['admin.css', 'admin.polyfill.js', 'admin.js'],
];
