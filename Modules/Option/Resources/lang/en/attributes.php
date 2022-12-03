<?php

return [
    'name' => 'Name',
    'type' => 'Type',
    'is_required' => 'Required',
    'label' => 'Label',
    'price' => 'Price',
    'price_type' => 'Price Type',

    // Validations
    'values.*.label' => 'Label',
    'values.*.price' => 'Price',
    'values.*.price_type' => 'Price Type',

    'options.*.name' => 'Name',
    'options.*.type' => 'Type',
    'options.*.values.*.label' => 'Label',
    'options.*.values.*.price' => 'Price',
    'options.*.values.*.price_type' => 'Price Type',
];
