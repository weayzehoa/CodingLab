<?php
/*
    在部落格上面加上留言版
    3. 產生資料表
    新增留言用與記錄第三方登入的登入資料
    php artisan make:model Comment -m
    php artisan make:model SocialUser -m
*/
/*
    修改 [timestamps]_create_comments_table.php
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
/*
    修改 [timestamps]_create_social_users_table.php
*/
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_users', function (Blueprint $table) {
            $table->string('provider_user_id')->primary();
            $table->string('provider');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_users');
    }
}
/*
    修改 [timestamps]_create_users_table.php
    之前的 USERS 資料表 需增加 管理者與使用者區分、頭像及第三方登入之使用者關聯
*/
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('avatar')->nullable(); //頭像功能,可為空值
        $table->integer('type')->unsigned()->default(0); //身分判別 0 為使用者
        $table->rememberToken();
        $table->timestamps();
    });
/*
    完成後，清空舊資料，並重建
    php artisan migrate:refresh
*/
/*
    修改相關的模型
    由於登入驗證增加管理者與使用者所以須調整及新增留言和第三方登入的Eloquent
*/
/*
    Comment.php
*/
//別忘記這兩行，與 User 跟 Post 有關聯需要引用
use App\User as UserEloquent;
use App\Post as PostEloquent;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'content',
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function post(){
        return $this->belongsTo(PostEloquent::class);
    }
}

/*
    SocialUser.php
*/
//別忘記這行 關聯 使用者資料表
use App\User as UserEloquent;

class SocialUser extends Model
{
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider',
    ];

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
}

/*
    修改 User.php
    新增與第三方帳號、頭像、取得頭像連結、判斷是否為管理者及與Comment關聯
*/

use URL; //新增
use App\Post as PostEloquent;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //與POST關聯
    public function posts(){
		return $this->hasMany(PostEloquent::class);
	}
    //與COMMENT關聯
    public function socialuser(){
        return $this->hasOne(SocialUserEloquent::class);
    }
    //判斷是否為管理員
    public function isAdmin(){
        return ($this->type == 1);
    }
    //得到頭像
    public function getAvatarUrl(){
        //空資料使用預設圖片
        if(empty($this->avatar)){
            return URL::asset('images/avatars/default.png');
        }else{
            //若不是網址則直接回傳
            if(!preg_match("/^[a-zA-z]+:\/\//", $this->avatar)){
                return URL::asset($this->avatar);
            }else{
                return $this->avatar;
            }
        }
    }
}
/*
    修改 Post.php
    與Comment關聯
*/
//關聯 Comment 模型
use App\Comment as CommentEloquent;

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
    //關聯comments
    public function comments(){
        return $this->hasMany(CommentEloquent::class);
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
    修改Seed假資料注入
*/
/*
    修改管理者假資料 UsersTableSeeder.php
    加入判斷欄位
    'type' => 1,
*/
/*
    修改PostsTableSeeder.php
*/
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
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
        //留言資料
        $comments = factory(CommentEloquent::class, 300)->create();
    }
}
/*
    php artisan db:seed
*/
