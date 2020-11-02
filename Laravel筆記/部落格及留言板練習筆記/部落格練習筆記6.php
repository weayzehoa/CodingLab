<?php
/*
    8. 註冊視圖組件
    在寫Controller過程中會發現有兩個變數 $post_types 及 $posts_total 必須被傳入posts.index視圖
    例如: HomeController 的 search()、PostsController 的 index() 及 PostTypesController 的
    show() 都會有以下程式碼.
*/
    $post_types = PostTypeEloquent::orderBy('name','ASC')->get();
    $posts_total = PostEloquent::where('type', $id)->get()->count();
/*
    若以後要修改或忘記加入，就會造成錯誤出現，我們可以用視圖組件將其整理在一起.
    先在app\Http目錄下建立一個 viewComposers 目錄 並在裡面新增 PostsIndexComposer.php
*/
use Illuminate\View\View;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;

class PostsIndexComposer
{
    public function compose(View $view){
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
        $posts_total = PostEloquent::get()->count();

        $view->with('post_types', $post_types);
        $view->with('posts_total', $posts_total);
    }
}
/*
    刪除 HomeController 的 search()、PostsController 的 index() 及
    PostTypesController 的 show() 中的兩個變數

    $post_types = PostTypeEloquent::orderBy('name','ASC')->get();
    $posts_total = PostEloquent::where('type', $id)->get()->count();

    另外別忘記刪除回傳到view的變數
    return View::make('posts.index', compact('posts','post_types','posts_total'));
    改成
    return View::make('posts.index', compact('posts'));
*/
/*
    然後將 PostsIndexComposer 註冊到 ServiceProvider 即可。
    或者 可以自行建立一個 ServiceProvider 專門來註冊 ViewComposer
    或是 寫在 AppServiceProvide.php 裡面也可以
*/
/*
    AppServiceProvide.php
*/
//這行別忘記寫進去
use \App\Http\ViewComposers\PostsIndexComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('posts.index', PostsIndexComposer::class);
    }
}

/*
    如此一來只要載入 Posts.index 視圖時，都會自動傳入 $post_types 和 $posts_total 這兩個變數
    讓你的Controller更加簡潔乾淨。
*/
?>
