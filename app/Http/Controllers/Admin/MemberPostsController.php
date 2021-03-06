<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//將需要使用到的 Request、Eloquent、套件及Facade寫入
use App\Http\Requests\PostRequest;
use App\Post as PostEloquent; //posts資料表
use App\User as UserEloquent; //users資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use App\Comment as CommentEloquent; //comments資料表
use App\Admin as AdminEloquent; //admins資料表
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use View;   //視圖
use Redirect; //轉向
use Spatie\Activitylog\Models\Activity; //使用Activity資料表

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
        $posts = PostEloquent::orderBy('sort','asc')->paginate(8);
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
        //用不到直接返回，避免出現錯誤
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //用不到直接返回，避免出現錯誤
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //用不到直接返回，避免出現錯誤
        return redirect()->back();
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
        $user = UserEloquent::where('id',$post->user_id)->get();
        $users = UserEloquent::all();
        $comments = CommentEloquent::where('post_id',$post->id)->orderBy('created_at','DESC')->paginate(4);
        $comments_total = CommentEloquent::where('post_id',$post->id)->count();
        // \Debugbar::addMessage($user);
        // \Debugbar::addMessage($post);
        // \Debugbar::addMessage($comments);
        // \Debugbar::addMessage($post_types);

        return View::make('admin.mbposts.edit', compact('user', 'post', 'post_types', 'users', 'comments', 'comments_total'));
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

        //紀錄
        // $adminuser = AdminEloquent::find(Auth::guard('admin')->id());
        // activity()
        // ->causedBy($adminuser)
        // ->performedOn($post)
        // ->withProperties($request)
        // ->tap(function(Activity $activity) { $activity->ip = request()->ip();})
        // ->log('編輯');
        // //activity placehloder 描述欄位裡面可以直接放入被修改的欄位資料或者其他資料
        // ->log('編輯,標題 :subject.title, 管理者 :causer.name');

        return Redirect::route('admin.mbposts.index');
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
        $post = PostEloquent::find($id)->delete();
        $comments = CommentEloquent::where('post_id', $id)->delete();
        return Redirect::back();
    }
    /*
        上線按鈕開關
    */
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
    /*
        置頂按鈕開關
    */
    public function istop(Request $request)
    {
        $id = $request->id;
        $request->istop == 'on' ? $istop = 1 : $istop = 0;
        $post = PostEloquent::findOrFail($id);
        $post->fill(['istop' => $istop]);
        $post->save();
        return redirect()->back();
    }
    /*
        向上排序
        此方法似乎不太理想，需要改關聯方式
    */
    public function sortup(Request $request)
    {
        $id = $request->id;
        $post = PostEloquent::findOrFail($id);
        $up = ($post->sort) - 1.5;
        $post->fill(['sort' => $up]);
        $post->save();

        $posts = PostEloquent::orderBy('sort','ASC')->get();
        $i = 1;
        foreach ($posts as $po) {
            $id = $po->id;
            PostEloquent::where('id', '=', $id)->update(['sort' => $i]);
            $i++;
        }
        return redirect()->back();
    }
    /*
        向下排序
        此方法似乎不太理想，需要改關聯方式
    */
    public function sortdown(Request $request)
    {
        $id = $request->id;
        $post = PostEloquent::findOrFail($id);
        $up = ($post->sort) + 1.5;
        $post->fill(['sort' => $up]);
        $post->save();

        $posts = PostEloquent::orderBy('sort','ASC')->get();
        $i = 1;
        foreach ($posts as $po) {
            $id = $po->id;
            PostEloquent::where('id', '=', $id)->update(['sort' => $i]);
            $i++;
        }
        return redirect()->back();
    }
    /*
        搜尋標題
    */
    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $posts = PostEloquent::where('title', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(8);
        return View::make('admin.mbposts.index', compact('posts', 'keyword'));
    }
    /*
        搜尋分類
    */
    public function selectType(Request $request){
        $type = $request->type;
        if(!$type){
            return Redirect::route('admin.mbposts.index');
        }
        $posts = PostEloquent::where('type', '=', $type)->orderBy('created_at', 'DESC')->paginate(8);
        return View::make('admin.mbposts.index', compact('posts', 'type'));
    }
}
