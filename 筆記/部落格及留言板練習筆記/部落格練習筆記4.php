<?php
/*
    6. 建立Request
    使用
    php artisan make:request PostRequest
    php artisan make:request PostTypeRequest
    建立文章的Request
*/
/*
    修改 PostRequest.php
*/

//表單驗證
use Illuminate\Foundation\Http\FormRequest;
//使用Auth驗證
use Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //必須登入才可以使用這個Request
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //欄位規則
    public function rules()
    {
        return [
            'title'=>'required|string',
            'type'=>'required|integer|exists:post_types,id',
            'content'=>'required|string'
        ];
    }
}

/*
    修改 PostController.php
    將 create() 與 store() 建立
*/
public function create()
{
    //將所有文章類型撈出來並拋到新增頁面
    $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
    return View::make('posts.create', compact('post_types'));
}
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
?>
<?
/*
    建立create.blade.php
*/
?>
@extends('layouts.master')

@section('title', '新增文章')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">新增文章</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <!-- 表單 路由到 PostController的 store() -->
                        <form action="{{ route('posts.store') }}" method="POST" class="mt-2">
                            <!-- CSRF 驗證 -->
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title">
                                    <!-- 檢驗是否有傳送title欄位資料, 沒有則出現錯誤訊息 -->
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label-sm text-md-right">分類</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" class="form-control form-control-sm {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                        <option value="0">請選擇...</option>
                                        @foreach($post_types as $post_type)
                                            <option value="{{ $post_type->id }}">
                                                {{ $post_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label-sm text-md-right">內文</label>
                                <div class="col-sm-8">
                                    <textarea name="content" id="content" rows="15" class="form-control form-control-sm {{ $errors->has('content') ? ' is-invalid' : '' }}" style="resize: vertical;"></textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-md btn-primary">儲存</button>
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
<?php
/*
    修改 PostController.php
    建立 edit() 與 update() 及 destory()
*/
public function edit($id)
{
    //先找出要編輯的資料並拋出到編輯頁面
    $post = PostEloquent::findOrFail($id);
    $post_types = PostTypeEloquent::orderBy('name' , 'ASC')->get();
    return View::make('posts.edit', compact('post', 'post_types'));
}

public function update(PostRequest $request, $id)
{
    //透過id將進來的資料填寫到資料庫後返回index()
    $post = PostEloquent::findOrFail($id);
    $post->fill($request->all());
    $post->save();
    return Redirect::route('posts.index');
}

public function destroy($id)
{
    //透過id找到文章後直接刪除
    //裡面可以寫一些後續的動作, 例如log或刪除檔案
}
?>
<?php
/*
    建立edit.blade.php
*/
?>
@extends('layouts.master')

@section('title', '文章編輯')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    編輯：{{ $post->title }}
                </div>
                <div class="card-body">
                    <div class="container-fiuld">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="title" id="title" value="{{ $post->title ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label-sm text-md-right">分類</label>
                                <div class="col-sm-8">
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0">請選擇...</option>
                                        @foreach($post_types as $post_type)
                                            <option value="{{ $post_type->id }}" {{ ($post->type == $post_type->id)?"selected":"" }}>
                                                {{ $post_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label-sm text-md-right">內文</label>
                                <div class="col-sm-8">
                                    <textarea name="content" id="content" rows="15" class="form-control form-control-sm" style="resize: vertical;">{{ $post->content ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-md btn-primary">儲存</button>
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
<?php
    /*
        注意事項
        使用create時若要導向新增的資料頁面時,必須將新增資料的id帶出
        使用update時若要導向原始頁面時必須將原始id帶回
        return Redirect::route('posts.show',$id);
    */
?>
