<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostTypeRequest;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use View;
use Redirect;

class PostTypesController extends Controller
{
    //只要跟 post_types 資料表有關都須經過檢查 除了show() 以外
    public function __construct(){
        $this->middleware(['auth','admin'], [
            'except' => [
                'show'
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
        //由於已經在PostController.php代入，這裡不需要寫
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('posts.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostTypeRequest $request)
    {
        //只需輸入類型名稱回傳給store建立新的類型後跳轉回首頁
        PostTypeEloquent::create($request->only('name'));
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
        //找出分類的id 並將屬於此id的文章回傳出去給 posts.index
        $type = PostTypeEloquent::findOrFail($id);
        $posts = PostEloquent::where('type', $id)->orderBy('created_at', 'DESC')->paginate(5);
        return View::make('posts.index', compact('posts', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_type = PostTypeEloquent::findOrFail($id);
        return View::make('posts.types.edit', compact('post_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostTypeRequest $request, $id)
    {
        //更新post_types資料
        $post_type = PostTypeEloquent::findOrFail($id);
        $post_type->fill($request->only('name'));
        $post_type->save();
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
        //找出post_types的id 並刪除相關的文章後刪除該筆類型後轉回 posts.index
        $post_type = PostTypeEloquent::findOrFail($id);
        $post_type->posts()->delete();
        $post_type->delete();
        return Redirect::route('posts.index');
    }
}
