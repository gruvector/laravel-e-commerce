<?php

use Faker\Generator as Faker;
use Modules\Option\Entities\Option;
use Modules\Option\Entities\OptionValue;

$factory->define(OptionValue::class, function (Faker $faker) {
    return [
        'option_id' => function () {
            return factory(Option::class)->create()->id;
        },
        'name' => $faker->word(),
        'price' => $faker->randomNumber(),
        'price_type' => $faker->randomElement(['fixed', 'percent']),
    ];
});

$factory->define(Option::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'type' => $faker->randomElement(['field', 'dropdown']),
        'is_required' => $faker->boolean(),
    ];
});
