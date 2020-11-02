<?php
/*
    1. 規劃與建立路由
*/
//首頁及搜尋，連接Home控制器路由
Route::get('/', 'HomeController@index')->name('index');
Route::get('search', 'HomeController@search')->name('search');

//登入登出，對應 Auth\LoginController
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);

/*
    2.產生資料表
    在產生資料表之前要先設定 .env 並在資料庫建立相對應的設定
    DB_PORT=3306
    DB_DATABASE=HelloBlog
    DB_USERNAME=root
    DB_PASSWORD=
    然後使用
    php artisan make:migration create_posts_table --create=posts
    php artisan make:migration create_post_types_table --create=post_types
    建立兩個 migration
    建立好後，到 database\migrations 中找到
    [timestamp]_create_posts_table.php
    [timestamp]_create_post_types_table.php
    並在裡面增加要的資料結構
*/
/*
    create_posts_table.php
*/
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('type')->unsigned()->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }
/*
    create_post_types_table.php
*/
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }
/*
    建立好後，使用
    php artisan migrate
    產生資料表欄位, 這時候 Laravel 會將 database\目錄下的所有table結構建立起來
    包括新開專案中的users及password_resets與failed_jobs
    進入資料庫中確認是否已經建立完成.
*/

/*
    3. 建立 Post 與 PostType 的 Eloquent
    使用
    php artisan make:model Post
    php artisan make:model PostType
    那為何不建立 User ?? 因為 Laravel 已經在安裝專案時已經內建 UserEloquent 不需要重複建立
    建立好後可以在 app 目錄下看到 Post.php 與 PostType.php 檔案出現
    在 Post.php 與 PostType.php 填入相關欄位資訊
*/
/*
    Post.php
*/

//別忘記這兩行務必要寫, 關聯使用 User 與 PostType 模型
use App\User as UserEloquent;
use App\PostType as PostTypeEloquent;

class Post extends Model
{
    //可讓使用者新增編輯的欄位名稱
  	protected $fillable = [
		'title', 'type', 'content', 'user_id'
	];
    //與users資料表一對一關聯
	public function user(){
		return $this->belongsTo(UserEloquent::class);
	}
    //type欄位與post_types資料表一對一關聯
	public function postType(){
		return $this->belongsTo(PostTypeEloquent::class, 'type');
    }
    /*
        補充說明
        belongsTo()第二個參數是放[外來鍵]名稱，第三參數則是[參考鍵]名稱，
        通常參考鍵預設名稱為id，而外來鍵名稱預設為[資料表名稱_id]，
        上述例子因為在建立table時已經將user_id欄位建立來對應user資料表id
        而並沒有建立與post_types的id欄位，故在 postType() 裡面的
        belongsTo()就必須將[外來鍵]名稱對應到 type 欄位中, 而第三個參數未填寫
        主要對應的還是post_type資料表的id, 故[參考鍵]不需要填寫id.
    */

}

/*
    PostType.php
*/
//別忘記這行務必要寫, 關聯使用 PostType 模型
use App\Post as PostEloquent;

class PostType extends Model
{
    //資料表名稱
    protected $table = 'post_types';
    //可新增編輯欄位
    protected $fillable = [
		'name'
	];
    //不使用時間戳記
    public $timestamps = false;
    //建立文章類型與文章間的關聯
	public function posts(){
		return $this->hasMany(PostEloquent::class, 'type');
	}
}

/*
    4. 產生假資料
    使用
    php artisan make:seed UsersTableSeeder
    php artisan make:seed PostsTableSeeder
    產生
    database\seeds\UsersTableSeeder.php
    database\seeds\PostsTableSeeder.php
    然後寫入相關的欄位設定
*/
/*
    UsersTableSeeder.php
    建立一筆管理者
*/
public function run()
{
    //建立一筆管理者
    UserEloquent::create([
        'name' => '管理者',
        'email' => 'admin@mail.com',
        'password' => bcrypt('admin'),
    ]);
}
/*
    PostsTableSeeder.php
    建立連續產生POST資料
*/
public function run()
{
    //在users資料表建立4筆
    $users = factory(UserEloquent::class, 4)->create();
    //在post_type資料表建立10筆
    $postTypes = factory(PostTypeEloquent::class, 10)->create();
    //在posts資料表建立50筆, 且用each方法一個一個處理
    //並用 use 帶入 $postTypes 上面的10筆其中一筆.
    $posts = factory(PostEloquent::class, 50)->create()->each(function($post) use ($postTypes){
        $post->type = $postTypes[mt_rand(0, (count($postTypes)-1))]->id;
        $post->save();
    });
}
/*
    建立好後, 別急著使用指令建立假資料
    factories模型還沒建立. 不然factory()不知道要建啥假資料
    到 database\factories 目錄下新增 PostFactory.php 及 PostTypeFactory.php 兩個對應的檔案
*/
/*
    PostFactory.php
*/
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'user_id' => mt_rand(1, 5),
    ];
});

/*
    PostTypeFactory.php
*/
use Faker\Generator as Faker;

$factory->define(App\PostType::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

/*
    建立好模型後, 去DatabaseSeeder.php將
    上面兩個假資料程式呼叫進來才能使用下面指令產生假資料
*/
public function run()
{
    $this->call(UsersTableSeeder::class);
    $this->call(PostsTableSeeder::class);
}
/*
    使用
    php artisan db:seed
    或者使用直接使用
    php artisan db:seed --class=類別名稱
*/
