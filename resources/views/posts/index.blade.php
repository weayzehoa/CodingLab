@extends('layouts.master')

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

                <!-- 如果get收到參數有type顯示出文章類型名稱並秀出該類型文章在判斷有無登入，有登入把分類的編輯與刪除按鈕顯示出來 -->
                @isset($type)
                    分類：{{ $type->name }}
                    @auth
                        @if (Auth::user()->isAdmin())
                            <div class="float-right">
                                <form action="{{ route('types.destroy', $type->id) }}" method="POST">
                                    <span class="ml-2">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-md btn-danger">
                                            <i class="fas fa-trash"></i>
                                            <span class="pl-1">刪除分類</span>
                                        </button>
                                    </span>
                                </form>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-md btn-primary ml-2">
                                    <i class="fas fa-pencil-alt"></i>
                                    <span class="pl-1">編輯分類</span>
                                </a>
                            </div>
                        @endif
                    @endauth
                @endisset

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
                                    @auth
                                        @if (Auth::user()->isAdmin() || Auth::id() == $post->user_id)
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                <span class="mr-1">{{ $post->comments->count() }}&nbsp;則回應</span>
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-md btn-primary">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="pl-1">編輯文章</span>
                                                </a>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-md btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="pl-1">刪除文章</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="mr-1">{{ $post->comments->count() }}&nbsp;則回應</span>
                                        @endif
                                    @else
                                        <span class="mr-1">{{ $post->comments->count() }}&nbsp;則回應</span>
                                    @endauth
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('posts.show', $post->id) }}" class="float-right card-link">繼續閱讀...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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
