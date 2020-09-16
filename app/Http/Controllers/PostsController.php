<?php

namespace App\Http\Controllers;

//將需要使用到的 Request、Eloquent、套件及Facade寫入
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post as PostEloquent; //posts資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use App\Comment as CommentEloquent; //comments資料表
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
        //新增 admin 的 middleware 套用到 edit, update, destroy
        $this->middleware(['admin'],[
            'only' => [
                'edit','update','destroy'
            ]
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostEloquent::orderBy('created_at', 'DESC')->paginate(5);
        return View::make('posts.index', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //將所有文章類型撈出來並拋到新增頁面
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
        return View::make('posts.create', compact('post_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //將所有資料收集
        $post = new PostEloquent($request->all());
        //透過驗證使用者並取得id
        $post->user_id = Auth::user()->id;
        //儲存
        $post->save();
        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //將id帶入並找文章顯示到視圖
        $post = PostEloquent::findOrFail($id);
        //將post id帶入comment找出留言資料
        $comments = CommentEloquent::where('post_id',$post->id)->orderBy('created_at','DESC')->paginate(5);
        return View::make('posts.show', compact('post','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //先找出要編輯的資料並拋出到編輯頁面
        $post = PostEloquent::findOrFail($id);
        $post_types = PostTypeEloquent::orderBy('name' , 'ASC')->get();
        return View::make('posts.edit', compact('post', 'post_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //透過id將進來的資料填寫到資料庫後返回index()
        $post = PostEloquent::findOrFail($id);
        $post->fill($request->all());
        $post->save();
        return Redirect::route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //透過id找到文章後在找出相關的留言刪除
        $post = PostEloquent::where('id', $id)->delete();
        $comments = CommentEloquent::where('post_id', $id)->delete();
        return Redirect::back();
    }

}
