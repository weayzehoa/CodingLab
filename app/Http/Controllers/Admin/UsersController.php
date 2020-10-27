<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\Comment as CommentEloquent;
use App\SocialUser;
use View;
use Redirect;
use File;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserEloquent::orderBy('created_at', 'DESC')->paginate(10);
        foreach($users as $user){
            // 以下兩種方法等效
            // 1. 直接尋找post資料表
            // $user->posts = PostEloquent::where('user_id',$user->id)->get();
            // $user->postsTotal = count($user->posts);
            // 2. 使用關聯性取得
            $user->posts = UserEloquent::find($user->id)->posts()->get();
            // 以下三種方法等效
            $user->postsTotal = UserEloquent::find($user->id)->posts()->get()->count();
            $user->postsTotal = $user->posts->count();
            $user->postsTotal = count($user->posts);

            //Comment 屬於遠程關係，沒有在App\User中建立相關性，無法使用UserEloquent的關聯性
            //只能從CommentEloquent中取得.
            $user->comments = CommentEloquent::where('user_id',$user->id)->get();
            $user->commentsTotal = count($user->comments);

            //利用關聯性找出是否為第三方註冊並將資料轉為陣列
            $user->socialuser = UserEloquent::find($user->id)->socialuser()->limit(1)->get()->toArray();
        }
        // dd($users);
        return view('admin.members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserEloquent::findOrFail($id);
        return view('admin.members.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Redirect::back();
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
        //透過id找到該使用者並將所有欄位資料找出, 刪除順序應從 comment->post->file->user
        $user = UserEloquent::find($id);

        //以下兩種等效
        // Storage::exists($user->avatar) ? Storage::delete($usr->avatar) : '';
        File::exists($user->avatar) ? File::delete($user->avatar) : '';

        //找出該會員發布的所有文章s
        // $posts = PostEloquent::where('user_id',$id)->get();
        $posts = UserEloquent::find($user->id)->posts()->get();

        //找出所有文章的留言 (不管誰留言一律刪除)
        foreach($posts as $post){
            // $post->comments = CommentEloquent::where('post_id', $post->id)->get();
            $post->comments = PostEloquent::find($post->id)->comments()->delete();
        }

        //刪除該會員發布的所有留言s (包括在其他post中)
        $comments = CommentEloquent::where('user_id', $user->id)->delete();

        //刪除該會員發布的所有文章
        $posts = UserEloquent::find($user->id)->posts()->delete();

        //刪除該會員資料
        $user = UserEloquent::find($id)->delete();

        return Redirect::back();
    }

    /*
        啟用或禁用該帳號
     */
    public function active(Request $request)
    {
        $id = $request->id;
        $request->active == 'on' ? $active = 1 : $active = 0;
        $user = UserEloquent::findOrFail($id);
        $user->fill(['active' => $active]);
        $user->save();
        return redirect()->back();
    }
    /*
        搜尋姓名及帳號
    */
    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $users = UserEloquent::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(10);
        return View::make('admin.members.index', compact('users', 'keyword'));
    }
}
