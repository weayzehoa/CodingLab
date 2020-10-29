<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
use Bluemmb\Faker\PicsumPhotosProvider as PicsumPhotos; //隨機 產生 PicsumPhotos 連結套件

$factory->define(App\Product::class, function (Faker $faker) {

    $faker->addProvider(new PicsumPhotos($faker));

    return [
        'no' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'image' => $faker->imageUrl(640,480, false, true),
        'imagepath' => $faker->imageUrl(640,480, false, true),
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
