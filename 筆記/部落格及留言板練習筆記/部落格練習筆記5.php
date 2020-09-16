<?php
/*
    7. 文章類別的應用
    分類的清單在Post的控制器建立時已經有送達,所以在PostType不必有index方法
*/
?>
<?php
/*
    修改 index.blade.php
    將文章類別區塊加入 (共兩個區塊)
*/
?>
<!-- 如果get收到參數有type顯示出文章類型名稱並秀出該類型文章在判斷有無登入，有登入把分類的編輯與刪除按鈕顯示出來 -->
@isset($type)
    分類：{{ $type->name }}
    @auth
        <div class="float-right">
            <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                <span class="ml-2">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                        <span class="pl-1">刪除分類</span>
                    </button>
                </span>
            </form>
        </div>
        <div class="float-right">
            <a href="{{ route('types.edit', $type->id) }}" class="btn btn-sm btn-primary ml-2">
                <i class="fas fa-pencil-alt"></i>
                <span class="pl-1">編輯分類</span>
            </a>
        </div>
    @endauth
@endisset

<!-- 右側文章類別清單建立 -->
<div class="col-md-4">
    <div class="list-group">
        <a href="{{ route('posts.index') }}" class=" list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ (isset($type))?'':'active' }}">
            全部分類
            <span class="badge badge-secondary badge-pill">{{ $posts_total }}</span>
        </a>
        <!-- 顯示所有文章類別, 每一項都帶有$post_types的資料表id -->
        @foreach ($post_types as $post_type)
            <a href="{{ route('types.show', $post_type->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ (isset($type))?(($type->id == $post_type->id)?'active':''):'' }}">
                {{ $post_type->name }}
                <span class="badge badge-secondary badge-pill">
                    {{ $post_type->posts->count() }}
                </span>
            </a>
        @endforeach
        <!-- 若管理員有登入則顯示 -->
        @auth
            <a href="{{ route('types.create') }}" class="list-group-item list-group-item-action">建立新分類</a>
        @endauth
    </div>
</div>
<?php
/*
    由於需要傳遞post_types資料id所以要建立Request
    使用
    php artisan make:request PostTypeRequest
    建立出 PostTypeRequest.php 後
    將規則寫入
*/
//別忘記這行，需要檢驗是否登入
use Auth;

class PostTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //返回是否驗證成功
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //檢查 name 欄位是否符合
        return [
            'name' => 'required|string'
        ];
    }
}

/*
    修改 PostTypeController.php
*/
//別忘記要使用的類別
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
        $this->middleware('auth', [
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
        $post_types = PostTypeEloquent::orderBy('name','ASC')->get();
        $posts_total = PostEloquent::where('type', $id)->get()->count();
        return View::make('posts.index', compact('posts', 'type','post_types','posts_total'));
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
?>
<?php
/*
    修改 views\posts\types\edit.blade.php
*/
?>
@extends('layouts.master')

@section('title', '編輯分類')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    編輯分類
                </div>
                <div class="card-body">
                    <div class="container-fluid p-0">
                        <form action="{{ route('types.update', $post_type->id) }}" method="POST" class="mt-2">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label-sm text-md-right">類別名稱</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ $post_type->name ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-md btn-primary">儲存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
