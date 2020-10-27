@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員文章頁面</h3>
                    <i class="fas fa-info text-danger"></i>沒有登入時可以瀏覽，一般會員可以留言，前台會員可修改或刪除自己的文章及留言。<br>
                    <i class="fas fa-info text-danger"></i>發表留言需登入會員。
                </div>
            </div>
            <div class="col-md-10 offset-md-1">
                <div class="card card-blue card-outline">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <h1>{{ $post->title }}</h1>
                                @auth
                                @if(Auth::user()->isAdmin() || Auth::id() == $post->user_id)
                                <div class="float-right ml-auto">
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
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
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fiuld">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <div class="row">
                                            <div class="col-md-12 pb-2 mt-4 mb-2 border-bottom">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @if($post->postType != null)
                                                        類別：<span class="badge badge-secondary ml-2">
                                                            {{ $post->postType->name }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        {{ $post->created_at }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{ $post->content }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding-top: 30px;">
                                            @foreach ($comments ?? '' as $comment)
                                            <div class="card col-md-12 mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm"
                                                                src="{{ $comment->user->avatar ? asset($comment->user->avatar) : asset('img/noavatar.png') }}"
                                                                alt="User Image">
                                                            <span class="username">
                                                                <a href="#">{{ $comment->user->name }}</a>
                                                            </span>
                                                            <span class="description">{{ $comment->created_at }} 留言</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @auth
                                                            @if(Auth::id() == $comment->user_id || Auth::user()->isAdmin())
                                                            <div class="float-right ml-auto">
                                                                <form action="{{ route('posts.comments.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-md btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                        <span class="pl-1">刪除回應</span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-top: 15px;">
                                                        <div class="col-md-12">
                                                            {{ $comment->content }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-md-12 my-3">
                                                @auth
                                                <h3>發表回應</h3>
                                                <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label-md text-md-right">名稱</label>
                                                        <div class="col-md-8">
                                                            <label class="col-form-label-md">{{ Auth::user()->name }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="content" class="col-md-2 col-form-label-md text-md-right">回應</label>
                                                        <div class="col-md-8">
                                                            <textarea name="content" id="content" rows="5" class="form-control" style="resize: vertical;"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-8 offset-md-2">
                                                            <button type="submit" class="btn btn-primary btn-block">
                                                                發表
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                @else
                                                <p class="text-center text-danger">如果要發表回應，請先<a href="{{ route('login') }}">登入</a></p>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
