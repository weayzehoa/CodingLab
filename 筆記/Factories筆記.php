<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use Ottaviano\Faker\Gravatar as Gravatar; //隨機 Gravatar 套件
use Bluemmb\Faker\PicsumPhotosProvider as PicsumPhotos; //隨機 產生 PicsumPhotos 連結套件
use Faker\Provider\Youtube as YoutubeLink; //隨機 產生 Youtube 連結套件
use bheller\ImagesGenerator\ImagesGeneratorProvider; //隨機 產生 圖片 套件

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

    /*
        //隨機 picsum.photos 圖片連結
        // simple usage
        $url = $faker->imageUrl();              // https://picsum.photos/640/480
        $url = $faker->imageUrl(500);           // https://picsum.photos/500/480
        $url = $faker->imageUrl(500,500);       // https://picsum.photos/500/500

        // $specific = false | int[0..1084] | true ( generates a random valid image id in [0..1084] )
        $url = $faker->imageUrl(500,500, false);    // https://picsum.photos/500/500
        $url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=70
        $url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=413
        $url = $faker->imageUrl(500,500, true);     // https://picsum.photos/500/500?image=270
        $url = $faker->imageUrl(500,500, 55);       // https://picsum.photos/500/500?image=55

        // Some image id's are invalid, So the package automatically replaces them
        $url = $faker->imageUrl(500,500, 86);       // https://picsum.photos/500/500?image=82

        More options :
        function imageUrl($width = 640, $height = 480, $specific=false, $random=false, $gray=false, $blur=false, $gravity=null)

        // https://picsum.photos/100/100?random=1
        $url = $faker->imageUrl(100,100, false, true);

        // https://picsum.photos/g/100/100
        $url = $faker->imageUrl(100,100, false, false, true);

        // https://picsum.photos/100/100?blur=1
        $url = $faker->imageUrl(100,100, false, false, false, true);

        // $gravity = north|east|south|west|center
        // https://picsum.photos/300/100?gravity=north
        $url = $faker->imageUrl(300,100, false, false, false, false, 'north');

        // mixed
        // https://picsum.photos/g/300/100?blur=1&gravity=west&image=88
        $url = $faker->imageUrl(300,100, 88, false, true, true, 'west');
    */
    $faker->addProvider(new PicsumPhotos($faker));

    /*
        //隨機 Youtube 影片連結
        $faker->youtubeUri()
        // https://www.youtube.com/watch?v=KyXYWQ-B3zO

        $faker->youtubeShortUri()
        // https://youtu.be/watch?v=rsPyiZSzj3g

        $faker->youtubeEmbedUri()
        // https://www.youtube.com/embed/aUgKvcNS6en

        $faker->youtubeEmbedCode()
        // <iframe width="560" height="315" src="https://www.youtube.com/embed/aUgKvcNS6en" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>

        $faker->youtubeRandomUri()
        // https://youtu.be/watch?v=lctkDb05MKT
    */
    $faker->addProvider(new YoutubeLink($faker));

    /*
        //隨機 產生 圖片 套件
        $faker->addProvider(new ImagesGeneratorProvider($faker));
        $image = $faker->imageGenerator();

        預設參數
        imageGenerator($dir = null, $width = 640, $height = 480, $format = 'png', $fullPath = true, $text = null, $backgroundColor = null, $textColor = null)

        Description:
        $dir: (string) 產生檔案的路徑. 預設為系統 /tmp (usualy /tmp on Linux systems).
        $width: (integer) 圖片寬度 (pixels), default to 640.
        $height: (integer) 圖片高度 (pixels), default to 480.
        $format: (string) 輸出格式 (jpg, jpeg or png), default to png.
        $fullPath: (boolean) 完整路徑 (false: 只輸出檔名), default to true.
        $text: (string) 圖片內文字. (輸出符合整個圖片寬度) Default to null (no text).
                        ($text: true, 參數設定為 true時，圖片內文字為 寬x高 的數字 (example: 640x480).
        $backgroundColor: (string) 背景顏色 (such as '#1f1f1f' or '1f1f1f'), default to black.
        $textColor: (string) 文字顏色 (such as '#ff2222' or 'ff2222'), default to white.

        範例:
        $faker->imageGenerator(null, 640, 480, 'png', false, true, '#1f1f1f', '#ff2222')
     */

    return [
        'name' => $faker->name,
        'gender' => mt_rand(1, 2),
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
