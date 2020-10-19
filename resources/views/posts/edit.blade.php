@extends('layouts.master')

@section('title', '編輯文章')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員編輯文章頁面</h3>
                    <i class="fas fa-info text-danger"></i>
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="card card-blue card-outline">
                    <div class="card card-primary card-outline">
                        <div class="card-header">編輯：{{ $post->title }}</div>
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
