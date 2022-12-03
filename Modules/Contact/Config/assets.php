<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'all-assets' => [
        'admin.contact.css' => ['module' => 'contact:admin/css/contact.css'],
        'admin.contact.js' => ['module' => 'contact:admin/js/contact.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'required-assets' => [],
];
