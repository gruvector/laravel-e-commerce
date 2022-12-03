<?php

return [
    'services' => [
        'array' => ['latest_rates' => []],
        'fixer' => ['access_key' => env('FIXER_ACCESS_KEY')],
        'forge' => ['api_key' => env('FORGE_API_KEY')],
        'currency_data_feed' => ['api_key' => env('CURRENCY_DATA_FEED_API_KEY')],
    ],
];
