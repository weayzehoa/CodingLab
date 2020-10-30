<?php

use Faker\Generator as Faker;

$factory->define(App\ProductComment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => mt_rand(1, 20),
        'product_id' => mt_rand(1, 50),
    ];
});
