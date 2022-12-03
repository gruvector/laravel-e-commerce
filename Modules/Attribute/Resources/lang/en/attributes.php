<?php

return [
    'attributes' => [
        'attribute_set_id' => 'Attribute Set',
        'name' => 'Name',
        'categories' => 'Categories',
        'slug' => 'URL',
        'is_filterable' => 'Filterable',
    ],
    'attribute_sets' => [
        'name' => 'Name',
    ],
    'product_attributes' => [
        'attributes.*.attribute_id' => 'Attribute',
        'attributes.*.values' => 'Values',
    ],
];
