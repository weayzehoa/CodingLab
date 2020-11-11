<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post as PostEloquent; //posts資料表
use App\PostType as PostTypeEloquent; //post_types資料表
use App\Comment as CommentEloquent; //comments資料表
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use Validator; //使用驗證器

class PostController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //除了 index,show 其餘 function 都要經過 api 的 middleware 檢查
        $this->middleware('api', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostEloquent::orderBy('created_at','DESC')->paginate(10);
        return response()->json($posts,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //檢驗授權是否存在
        $user = auth('api')->user();
        if(!$user){
            return response()->json("授權不存在", 401);
        }

        //驗證資料
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|max:100',
            'type'=>'required|integer|exists:post_types,id',
            'content'=>'required|string|max:5000',
            'onlinedate' => 'date_format:Y-m-d H:i:s',
            'offlinedate' => 'date_format:Y-m-d H:i:s',
        ]);

        //驗證失敗返回訊息
        if ($validator->fails()) {
            return response()->json(['error' => '資料錯誤'], 400);
        }

        //將所有資料收集並儲存，返回儲存的資料及狀態碼
        $post = new PostEloquent($request->all());
        //透過驗證使用者並取得id
        $post->user_id = $user->id;
        //儲存
        $post->save();
        return response()->json($post,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = PostEloquent::find($id);

        //檢驗該筆資料是否存在
        if (!$post) {
            return response()->json('資料不存在', 404);
        }

        //將資料拋出並提供200狀態碼
        $comments = CommentEloquent::where('post_id',$post->id)->orderBy('created_at','DESC')->paginate(5);
        return response()->json(['post' => $post , 'comments' => $comments], 200);
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
        //檢驗授權是否存在
        $user = auth('api')->user();
        if(!$user){
            return response()->json("授權不存在", 401);
        }

        //資料驗證
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|max:100',
            'type'=>'required|integer|exists:post_types,id',
            'content'=>'required|string|max:5000',
            'onlinedate' => 'date_format:Y-m-d H:i:s',
            'offlinedate' => 'date_format:Y-m-d H:i:s',
        ]);

        //資料驗證失敗返回訊息
        if ($validator->fails()) {
            return response()->json(['error' => '資料檢驗失敗'], 400);
        }

        //檢驗該筆資料是否存在
        $post = PostEloquent::find($id);
        if (!$post) {
            return response()->json(['message' => '資料不存在'], 404);
        }

        //將進來的資料填寫到資料庫後返回修改成功訊息
        $post = PostEloquent::find($id);
        $post->fill($request->all());
        $post->save();
        return response()->json(['message' => '修改成功', 'post' => $post], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //檢驗授權是否存在
        $user = auth('api')->user();
        if(!$user){
            return response()->json("授權不存在", 401);
        }

        //檢驗該筆資料是否存在
        $post = PostEloquent::find($id);
        if (!$post) {
            return response()->json(['message' => '資料不存在'], 404);
        }

        //刪除所有與該筆post相關的資料並返回刪除成功訊息
        $post = PostEloquent::find($id)->delete();
        $comments = CommentEloquent::where('post_id', $id)->delete();
        return response()->json(['message' => '刪除成功'], 200);
    }
}
