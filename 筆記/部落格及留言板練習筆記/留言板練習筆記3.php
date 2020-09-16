<?php
/*
    在部落格上面加上留言版
    4. 修改身分驗證相關
    之前部落格是任何使用者都可以修改文章，現在需要透過管理者來管理所有的資料
*/
/*
    Middleware 在指定的程式執行之前先做驗證
    php artisan make:middleware [中介層名稱]
    使用下面指令建立 AdminAuthenticate 的 Middleware
    php artisan make:middleware AdminAuthenticate
*/
/*
    app\Http\MdminAuthenticate.php
*/
use Closure;
use Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //取得目前使用者資料
        $current_user = Auth::user();
        //取得文章編號
        $id = $request->post;
        //使用者存在且文章編號存在
        if(!empty($current_user) && !empty($id)){
            //檢查是否為該使用者文章或者為管理員
            $post = $current_user->posts()->find($request->post);
            if($current_user->isAdmin() || !empty($post)){
                return $next($request);
            }
        }
        //判斷請求是否為ajax或json，如果不是跳轉文章首頁
        if ($request->ajax() || $request->wantsJson()) {
            return response('您沒有權限操作此項目.', 401);
        } else {
            return redirect()->route('posts.index');
        }
    }
}
/*
    將此Middleware加入到Kernel的routeMiddleware中，主要用來直接呼叫使用.
    'admin' => \App\Http\Middleware\AdminAuthenticate::class,

    將Middleware套用到需要判斷的地方，像是Post和PostType控制器
*/
/*
    PostsController.php
*/
class PostsController extends Controller
{
    /*
        新增一個建構式在class中, 主要是進入此控制器時，優先走這邊,
        進入到 middleware 中, 除了 index 與 show 不需要做驗證.
        意思就是說 非會員也可以看文章, 其餘的功能通通都要驗證.
    */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [
                'index', 'show'
            ]
        ]);
        //新增 admin 的 middleware 套用到 edit, update, destroy
        $this->middleware(['admin'],[
            'only' => [
                'edit','update','destroy'
            ]
        ])
    }
}
/*
    PostTypeController.php
    將 admin 套用到目前的 middleware 中
*/
class PostTypesController extends Controller
{
    //只要跟 post_types 資料表有關都須經過檢查 除了show() 以外
    public function __construct()
    {
        $this->middleware(['auth','admin'], [
            'except' => [
                'show'
            ]
        ]);
    }
}
/*
    除此之外顯示方面也需要驗證，但只需要透過UserEloquent的isAdmin方法即可
    只要在前端視圖使用 Auth::isAdmin() 增加一個是否為管理者條件來讓按鈕顯示受限即可.
*/
