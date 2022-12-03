<?php

use Modules\Tax\Entities\TaxClass;

return [
    'tax' => 'Tax',
    'taxes' => 'Taxes',
    'table' => [
        'tax_class' => 'Tax Class',
    ],
    'tabs' => [
        'group' => [
            'tax_information' => 'Tax Information',
        ],
        'general' => 'General',
        'rates' => 'Rates',
    ],
    'form' => [
        'add_new_rate' => 'Add New Rate',
        'delete_rate' => 'Delete Rate',
        'based_on' => [
            TaxClass::SHIPPING_ADDRESS => 'Shipping Address',
            TaxClass::BILLING_ADDRESS => 'Billing Address',
            TaxClass::STORE_ADDRESS => 'Store Address',
        ],
    ],
];
