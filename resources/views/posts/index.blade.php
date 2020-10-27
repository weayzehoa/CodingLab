@extends('layouts.master')

@section('title', '會員文章')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員文章清單</h3>
                    <i class="fas fa-info text-danger"></i> 會員文章使用 Fake 工廠產生 文章、類別、留言及對應會員資料，一個簡易的部落格及留言系統。<br>
                    <i class="fas fa-info text-danger"></i> 後台管理系統可管理所有會員文章相關資料，包括修改會員文章、管理會員及刪除留言。<br>
                    <i class="fas fa-info text-danger"></i> 前台會員若具有管理權則可以管理所有會員文章相關資料，包括修改或刪除會員文章及留言。<br>
                    <i class="fas fa-info text-danger"></i> 使用會員文章時，帳號需經過email驗證後才能使用，包括新增、編輯或刪除。
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="row">
                        {{-- 左側文章清單建立 --}}
                        <div class="col-md-8">
                            <!-- 路由 search 搜尋表單 -->
                            <div class="row mb-3">
                                @auth
                                <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success ml-2">
                                    <i class="fas fa-plus"></i>
                                    <span class="pl-1">新增文章</span>
                                </a>
                                @endauth
                                <form action="{{ route('search') }}" method="GET" class="form-inline" role="search">
                                    <input type="search" class="form-control form-control-sm mr-sm-2  ml-2" name="keyword" value="{{ $keyword ?? '' }}" placeholder="搜尋文章" aria-label="Search">
                                    <button type="submit" class="btn btn-sm btn-outline-info my-2 my-sm-0">
                                        <i class="fas fa-search"></i>
                                        搜尋
                                    </button>
                                </form>
                            </div>
                            {{-- 如果沒有文章就顯示 沒有任何文章 字串 --}}
                            @if(count($posts) == 0)
                            <p class="text-center">
                                沒有任何文章
                            </p>
                            @endif
                            @foreach($posts as $post)
                            <div class="card card-info card-outline mb-3">
                                <div class="card-hearder">
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{ $post->user->avatar ? asset($post->user->avatar) : asset('img/noavatar.png') }}" alt="User Image">
                                                <span class="username text-primary">{{ $post->user->name }}</span>
                                                <span class="description">{{ $post->created_at }} 發表</span>
                                            </div>
                                            <div class="col-md-12">
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                @if($post->postType != null)
                                                {{-- <span class="badge badge-secondary ml-2">
                                                    {{ $post->postType->name }}
                                                </span> --}}
                                                @endif
                                            </div>
                                            <div class="col-md-4 text-right">
                                                @if($post->postType != null)
                                                <span class="badge badge-secondary ml-2">
                                                    {{ $post->postType->name }}
                                                </span>
                                                @endif
                                                {{-- {{ $post->created_at->toDateString() }} --}}
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
                            <div class="row justify-content-center">
                                <div>
                                    <!-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼 -->
                                    @isset($keyword)
                                    {{ $posts->appends(['keyword' => $keyword])->render() }}
                                    @else
                                    {{ $posts->render() }}
                                    @endisset
                                </div>
                            </div>

                        </div>

                        {{-- 右側文章類別清單建立 --}}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
@endsection

@section('script')
{{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
@endsection

@section('CustomScript')
{{-- 這邊放置 Script 程式用 (在頁面下方) --}}
@endsection
