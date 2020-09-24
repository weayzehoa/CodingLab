<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//將需要使用到的 Request、Eloquent、套件及Facade寫入
use App\Http\Requests\PostRequest;
use App\Post as PostEloquent; //posts資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use App\Comment as CommentEloquent; //comments資料表
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use View;   //視圖
use Redirect; //轉向

class MemberPostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
        // \Debugbar::Disable();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostEloquent::orderBy('istop','DESC')->orderBy('approved', 'ASC')->orderBy('created_at', 'DESC')->paginate(8);
        // \Debugbar::addMessage($posts);
        return View::make('admin.mbposts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return View::make('admin.mbposts.edit', compact('post', 'post_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function isshow(Request $request)
    {
        // \Debugbar::info($request);
        // \Debugbar::addMessage($request->isshow);
        // \Debugbar::addMessage($request->id);
        $id = $request->id;
        $request->isshow == 'on' ? $isshow = 1 : $isshow = 0;
        $post = PostEloquent::findOrFail($id);
        $post->fill(['isshow' => $isshow]);
        $post->save();
        // \Debugbar::addMessage($post);
        // $posts = PostEloquent::orderBy('istop','DESC')->orderBy('approved', 'ASC')->orderBy('created_at', 'DESC')->paginate(8);
        // \Debugbar::addMessage($posts);
        // return View::make('admin.mbposts.index', compact('posts'));
        // return redirect()->action('Admin\MemberPostsController@index');
        return redirect()->back();
    }
    public function istop(Request $request)
    {
        $id = $request->id;
        $request->istop == 'on' ? $istop = 1 : $istop = 0;
        $post = PostEloquent::findOrFail($id);
        $post->fill(['istop' => $istop]);
        $post->save();
        return redirect()->back();
    }
}
