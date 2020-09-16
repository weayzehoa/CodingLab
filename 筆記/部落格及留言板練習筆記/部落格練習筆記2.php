<?php
/*
    5. 建立視圖相關樣板
*/
/*
    5-1. 主樣板
        a. 在resource\views 目錄下建立 layouts 目錄並新增 master.blade.php
        b. 在resource\views 目錄下建立 partials 目錄並新增 head.blade.php 與 nav.blade.php 共用樣板, 統一設定及匯入主樣板中
           @include('partials.head');
           @include('partials.nav');

*/
?>

<!-- 主樣板 -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MyBlog - @yield('title')</title>
	@include('partials.head')
    <style>
        body{
            font-family: '微軟正黑體';
        }
        .navbar-shadow{
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.09);
        }
    </style>
</head>
<body>
	@include('partials.nav')
	<main style="margin-top: 70px;">
        <div class="container">
            @section('content')
            @show
        </div>
	</main>
</body>
</html>
<?php
/*
    共用樣板 heade.blade.php
    這裡採用 bower 套件管理 安裝的 Jquery 與 bootstrap
*/
?>

<!-- 共用樣板 head.blade.php -->
<link rel="stylesheet" type="text/css" href="{{ asset('bower/bootstrap/dist/css/bootstrap.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('bower/font-awesome/css/all.min.css') }}" />
<script type="text/javascript" src="{{ asset('bower/jquery/dist/jquery.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<?php
/*
    共用樣板 nav.blade.php 選單樣板
    大部分網站的選單基本上都是使用相同的樣式故歸類在共用樣板中
    Laravel 在前端若要將資料或變數傳遞出來都是使用 {{  }} 相當於 PHP 的 <?= ?>
    其餘參考 view與樣板引擎筆記
*/
?>
<!-- 選單樣板 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar-shadow">
	<div class="container">
        <!-- 路由 index 到首頁 -->
	    <a href="{{ route('index') }}" class="navbar-brand">HelloBlog</a>
        <!-- 路由 search 搜尋表單 -->
	    <form action="{{ route('search') }}" method="GET" class="form-inline" role="search">
	        <input type="search" class="form-control form-control-sm mr-sm-2" name="keyword" placeholder="搜尋文章" aria-label="Search">
	        <button type="submit" class="btn btn-sm btn-outline-info my-2 my-sm-0">
	            <i class="fas fa-search"></i>
	            搜尋
	        </button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- 驗證使用是否登入 在使用者未登入前 只會看到登入兩個字 登入後就會切換到 另一個下拉表單 -->
                @auth
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- 登出按鈕 下方表單被CSS隱藏, 當按下按鈕後 利用onclick將表單送出到 路由 logout 執行 -->
                        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); $('#logout-form').submit();">登出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            <!-- CSRF 權杖, Laravel 表單預設一定要使用此功能 否則表單將無法被正確執行 -->
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">登入</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<?php
/*
    身分驗證功能
    Laravel 本身內建身分驗證功能, 可以透過 Auth Facades 來進行有無登入的驗證及取得登入資料
    開啟 app\Controllers\Auth 目錄下就可以看到相關的控制器所以只需要在命令列上輸入
    php artisan make:auth 來產生相關的樣板
    注意，以上方法僅限於 Laravel 5.x版, 或者自己建立
    若使用上述方法，在routes\web.php記得註解掉Auth相關的路由
    另外, 自動建立的 HomeController.php 必須將 $this->middleware('auth'); 註解掉
    否則此控制器會套用 auth 中介層，必須要登入才能觀看文章
*/
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Redirect::action('PostsController@index');
    }

    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $posts = PostEloquent::where('title', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(5);
        return View::make('posts.index', compact('posts', 'keyword'));
    }
}
?>
