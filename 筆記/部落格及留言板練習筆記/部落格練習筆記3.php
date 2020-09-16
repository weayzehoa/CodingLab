<?php
/*
    6. 建立文章的相關視圖與控制器
    使用建立 resource 方式將文章的七大控制直接建立出來
    php artisan make:controller PostsController --resource
    php artisan make:controller PostTypesController --resource
    這時候在app\Http\Controllers目錄下就可以看到 PostsController.php 與 PostTypesController.php
*/
/*
    修改 PostsController.php
*/

//將需要使用到的 Request、Eloquent、套件及Facade寫入
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post as PostEloquent; //posts資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use View;   //視圖
use Redirect; //轉向

class PostsController extends Controller
{
    /*
        新增一個建構式在class中, 主要是進入此控制器時，優先走這邊,
        進入到 middleware 中, 除了 index 與 show 不需要做驗證.
        意思就是說 非會員也可以看文章, 其餘的功能通通都要驗證.
    */
    public function __construct(){
        $this->middleware('auth', [
            'except' => [
                'index', 'show'
            ]
        ]);
    }

}
?>
<?php
/*
    新增 index()
*/
public function index()
{
    $posts = PostEloquent::orderBy('created_at', 'DESC')->paginate(5);
    $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
    $posts_total = PostEloquent::get()->count();
    return View::make('posts.index', compact('posts','post_types','posts_total'));
    return View::make('posts.index', compact('posts'));
}
?>
<?php
/*
    建構 index.blade.php
*/
?>@extends('layouts.master')

@section('title', '所有文章')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h4>
                @auth
                    <div class="float-right">
                        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success ml-2">
                            <i class="fas fa-plus"></i>
                            <span class="pl-1">新增文章</span>
                        </a>
                    </div>
                @endauth
                @isset($keyword) <!-- 判斷是否有收到 keyword 關鍵字 -->
                    搜尋：{{ $keyword }}
                @else
                    所有文章
                @endisset
            </h4>
            <hr>
            @if(count($posts) == 0) <!-- 如果沒有文章就顯示 沒有任何文章 字串 -->
                <p class="text-center">
                    沒有任何文章
                </p>
            @endif
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">{{ $post->title }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    @if($post->postType != null)
                                        <span class="badge badge-secondary ml-2">
                                            {{ $post->postType->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 text-right">
                                    {{ $post->created_at->toDateString() }}
                                </div>
                            </div>
                            <hr class="my-2 mx-0">
                            <div class="row">
                                <div class="col-md-12" style="height: 100px; overflow: hidden;">
                                    <p class="card-text">
                                        {{ $post->content }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                            <span class="pl-1">編輯文章</span>
                                        </a>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                            <span class="pl-1">刪除文章</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-md-8">
            <!-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼 -->
            @isset($keyword)
                {{ $posts->appends(['keyword' => $keyword])->render() }}
            @else
                {{ $posts->render() }}
            @endisset
        </div>
    </div>
</div>
@stop

<?php
/*
    PostsController.php
    補上 show() 顯示文章內容
*/
public function show($id)
{
    //將id帶入並找文章顯示到視圖
    $post = PostEloquent::findOrFail($id);
    return View::make('posts.show', compact('post'));
}
?>
<?php
/*
    建立 show.blade.php並且在index.blade.php加上按鈕
    <a href="{{ route('posts.show', $post->id) }}" class="float-right card-link">繼續閱讀...</a>
*/
?>
@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-sm-12 pb-2 mt-4 mb-2 border-bottom">
                <div class="row">
                    <h1>{{ $post->title }}</h1>
                    @auth
                        <div class="float-right ml-auto">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-pencil-alt"></i>
                                    <span class="pl-1">編輯文章</span>
                                </a>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                    <span class="pl-1">刪除文章</span>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        @if($post->postType != null)
                            <span class="badge badge-secondary ml-2">
                                {{ $post->postType->name }}
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6 text-right">
                        {{ $post->created_at }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{ $post->content }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
