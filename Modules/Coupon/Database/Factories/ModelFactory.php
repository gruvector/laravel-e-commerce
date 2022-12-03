<?php

use Modules\Coupon\Entities\Coupon;

$factory->define(Coupon::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'code' => $faker->word(),
        'value' => $faker->randomNumber(),
        'is_percent' => $faker->boolean(),
        'is_active' => $faker->boolean(),
    ];
});
