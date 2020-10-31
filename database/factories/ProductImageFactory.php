<?php

use Faker\Generator as Faker;
use Bluemmb\Faker\PicsumPhotosProvider as PicsumPhotos; //隨機 產生 PicsumPhotos 連結套件

$factory->define(App\ProductImage::class, function (Faker $faker) {

    $faker->addProvider(new PicsumPhotos($faker));

    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 100),
        'filename' => $faker->imageUrl(640,480, true),
        'filepath' => $faker->imageUrl(640,480, true),
        'ext' => '',
        'size' => '',
        'product_id' => '',
    ];
});
