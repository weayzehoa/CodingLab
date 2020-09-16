@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-md-12 pb-2 mt-4 mb-2 border-bottom">
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
                <div class="row">
                    <div class="col-md-6">
                        @if($post->postType != null)
                            <span class="badge badge-secondary ml-2">
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
                            <div class="col-md-8">
                                {{ $comment->user->name }} 在 {{ $comment->created_at }} 說道：
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
                <div class="col-md-10 offset-md-1">
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
                        <p class="text-center">如果要發表回應，請先<a href="{{ route('login') }}">登入</a></p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@stop
