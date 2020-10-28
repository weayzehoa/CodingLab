<?php

use Faker\Generator as Faker;

$factory->define(App\ProductType::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});
