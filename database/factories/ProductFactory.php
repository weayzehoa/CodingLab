<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'no' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200),
        'content' => $faker->paragraph,
        'type' => mt_rand(1, 5),
        'defaultprice' => 100,
        'saleprice' => 90,
        'isshow' => mt_rand(0, 1),
        'istop' => mt_rand(0, 1),
        'onlinedate' => new DateTime(),
        'offlinedate' => Carbon::now()->addDays(90)->toDateTimeString(),
    ];
});
