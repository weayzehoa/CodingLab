<?
/* 
    使用artisan的make指令來產生Seeder檔案並放在database/seeds目錄下
    php artisan make:seeder [名稱]

    一個Seeder只有一個run函式，可以在此函式中寫任何Laravel指令，例如:
    操作資料庫和Model來新增、寫入、刪除，但一般情況下直接在console下操作.
*/
/* 
    先建立DataTableSeeder，建立後會在database\seeds目錄下看到DataTableSeeder.php
    php artisan make:seeder DataTableSeeder
*/
/* 
    Factory模型工廠
    通常都會需要大量的資料而不是一筆資料所以Laravel提供Eloquent模型的工廠
    能夠直接設定每個欄位所需要的資料類型，利用 factory方法快速產生所需數量的資料
    而模型資料類型的定義通常放置以下目錄檔案中

    database/factories/UserFactory.php
    database/factories/[Eloquent單數名稱]Factory.php

    其主要透過 fzaniontto/faker的函式來協助產生大量資料
*/
/* 
    試著在 UserFactory.php 中建立 Student 及 Score 的假資料模型
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Student::class, function(Faker $faker) {
	return [
		'user_id' => function(){ //這邊使用User建立好的id
			return factory(App\User::class)->create()->id;
		},
		'no' => $faker->regexify('s[0-9]{10}'),
		'tel' => $faker->phoneNumber()
	];
});

$factory->define(App\Score::class, function(Faker $faker) {
	return [
		'student_id' => function(){
			return factory(App\Student::class)->create()->id; //這邊使用Students建立好的id
		},
		'chinese' => $faker->numberBetween(0, 100),
		'english' => $faker->numberBetween(0, 100),
		'math' => $faker->numberBetween(0, 100),
	    'total' => 0
	];
});

/* 
    定義好後，先用指令建立一個TestTableSeeder並在裡面定義
    主要是將分數統計起來放入Scores資料表中的total欄位
*/
class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $score = factory(ScoreEloquent::class, 20)
            ->create()
            ->each(function($score){
                $score->total = $score->chinese + $score->english + $score->math;
                $score->save();
            });
    }
}

/* 
    設定DataBase
    db:seed指令預設只會執行DataBaseSeeder.php，所以要將剛剛寫好的Seeder在DatabaseleSeeder.php中呼叫
*/
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestTableSeeder::class);
        $this->call(DataTableSeeder::class);
    }
}
/* 
    設定完成後，就可以用artisan中的 db:seed 指令來建立資料了
    php artisan db:seed
    php artisan db:seed --class=類別名稱
*/
/* 
    建立好後修改board.blade.php, student.blade.php
    就可以進入資料庫或執行網頁看是否有資料出現
*/
/* 
    清除seed資料
    php artisan migrate:refresh -seed //5.7版使用方式
    php artisan migrate:refresh //7.x版使用方式
*/