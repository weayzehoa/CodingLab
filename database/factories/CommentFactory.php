<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => mt_rand(1, 20),
        'post_id' => mt_rand(1, 50),
    ];
});
