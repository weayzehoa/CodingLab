<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('welcome');
    }
}
?>
<?php
//Eloquent 資料操作
    //新增資料, 先建立一個 Post 物件, 讓 title 賦值, 再使用 save() 儲存.
    //若Eloquent有使用內建timestamps的話,也就是 create_at 和 update_at 兩個欄位
    //是不需要手動賦值, Laravel會自動給予正確的時間.
    $post = new App\Post;
    $post->title = 'Hello World';
    $post->save();

    //更新資料, 同上使用find()找到要更新的id做更新動作, 一樣要使用save()函式,
    //此處只會更新update_at的時間戳記.
    $post = new App\Post::find(1);
    $post->title = '我是標題';
    $post->content = '我是內容';
    $post->author = '我是作者';
    $post->catalog = '我是類別';
    $post->save();

    //如上若對更多欄位資料時會很混亂, Eloquent提供批量新增與批量更新及批量刪除
    //批量更新
    $post = App\Post::create{[
        'title' => '我是標題',
        'content' => '我是內容',
        'author' => '我是作者',
        'catalog' => '我是類別'
    ]};
    //上面內容如同一個陣列值 array('title' => '我是標題' ... )
    //前端視圖回傳到控制器中是陣列型態並儲存於$request變數中
    //簡短效果, 只要一行就可以將所有資料儲存
    $post = App\Post::create{$request->all()};

    //批量更新
    $post = App\Post::find(1);
    $post->update ([
        'title' => '我是新的標題';
        'content' => '我是新的內容',
    ]);
    //同樣的可以使用一行將所有資料更新
    App\Post::get()->update($request->all());

    /* 
    使用批量新增或更新時，需特別注意Eloquent中要設定$fillable或$guarded
    否則會發生 MassAssignmentException 例外錯誤.
    批量賦值 (MassAssignment) 是 Laravel 資料保護機制.
    例如使用者資料表中 除了編號(id),姓名(name),信箱(email),密碼(password)之外
    還有一個is_admin來判斷是否為管理員,0為一般使用者1為管理員,
    若表單中有惡意偽造['is_admin'=>1]加上又剛好使用$request帶入create()中
    如此一來就會讓惡意使用者建立一個具有管理權限的帳號
    所以user的Eloquent需定義如下: 
    */
    $protected $fillable = [
        'name','email','password'
    ];

    //或者
    $protected $guarded = [
        'is_admin'
    ];
    /* 
    以上兩者擇一, $fillable 如同白名單, $guarded 如同黑名單, 若被設定保護
    的欄位就不能用批量方式賦值，只能使用傳統方式賦值.
    */
    $user = App\user::create($request->all());
    $user->is_admin = 1;
    $user->save()

    /* 
    刪除資料
    很直覺使用find()找出主鍵, 再使用delete()函式刪除資料
    既然要刪除, 就不需要作保護
    */
    $post = App\Post::find(1);
    $post->delete();
    //另一種刪除方法, 可複數可陣列
    App\Post::destory(1);
    App\Post::destory(1,5,3);
    App\Post::destory([1,2,3]);
    //使用條件式刪除
    App\Post::where('author' => '我是作者')->delete();
?><?php
    /* 
    軟刪除 (Soft Delete)
    將要刪除的資料標記為已刪除，實際上並未刪除該資料.
    此方法在做保護重要資料相當有用，但日積月累會造成資料庫越來越龐大
    需要定期清理或維護.否則建議不要使用.
    */
    //1. 先在 migration 中加上 delete_at 欄位
    Schema::table('posts',function(Blueprint $table){
        $table->softDeletes();
    });
    //2. 在模型中匯入 SoftDeletes 特徵及為 $data 屬性加上 delete_at 欄位
?><?php
    namespace App;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    class Post extends Model
    {
        use SoftDeletes;
        $protected $data = ['delete_at'];
    }
    /*
    成功開啟軟刪除後，只要使用destroy()或是delete()都會將該筆資料中的delete_at
    欄位設定為目前的日期與時間，而不是直接刪除該筆資料.使用下面方法:
     */
    $post = App\Post::withTrashed()->find(1);
    if($post->trashed()){
        //Do something...
    }
    //也可以只取得被軟刪除的資料
    $post = App\Post::onlyTrashed()->get();
    //若要恢復被軟刪除的項目
    $post = App\Post::find(1);
    $post->restore();
    //或者一次恢復多筆資料
    App\Post::onlyTrashed()->restore();
    //強制刪除資料
    $post = App\Post::find(1);
    $post->forceDelete();
    //或者強制刪除多筆資料
    App\Post::onlyTrashed()->forceDelete();
    /* 
    forceDelete()是強制刪除資料,不論是否有被軟刪除過,可以直接對沒有
    被軟刪除過的資料進行強制刪除.
    */
?>