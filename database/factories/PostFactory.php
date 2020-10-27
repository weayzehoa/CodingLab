<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'user_id' => mt_rand(1, 20),
        'approved' => mt_rand(0, 2),
        'isshow' => mt_rand(0, 1),
        'istop' => mt_rand(0, 1),
        'onlinedate' => new DateTime(),
        'offlinedate' => Carbon::now()->addDays(90)->toDateTimeString(),
    ];
});
