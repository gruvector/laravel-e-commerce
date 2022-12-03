<?php

use Modules\Category\Entities\Category;

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'slug' => $faker->slug(),
        'on_navigation' => $faker->boolean(),
        'is_active' => $faker->boolean(),
    ];
});
