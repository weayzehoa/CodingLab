<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Ottaviano\Faker\Gravatar as Gravatar;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    /*
        //隨機 Gravatar 頭像連結
        $imageLocalPath = $faker->gravatar();
        $imageContent = file_get_contents($imageLocalPath);
        // OR
        $imageUrl = $faker->gravatarUrl();
    */
    $faker->addProvider(new Gravatar($faker));
    $genderNo = mt_rand(1, 2);
    $genderNo == 1 ? $name = $faker->name($gender = 'male') : $name = $faker->name($gender = 'female');

    return [
        'name' => $name,
        'gender' => $genderNo,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpsdO0rOQ5byMi.Ye4oKwea3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'address' => $faker->address,
        'tel' => $faker->phoneNumber,
        'avatar' => 'upload/avatars/'.$faker->file(public_path() . '/img/samples/avatar', public_path() . '/upload/avatars' , false),
        // 'avatar' => $faker->gravatarUrl(),
    ];
});
