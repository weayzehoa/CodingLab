@extends('layouts.master')

@section('title', '新增文章')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員新增文章頁面</h3>
                    <i class="fas fa-info text-danger"></i>
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="card card-blue card-outline">
                    <div class="card card-primary card-outline">
                        <div class="card-header">新增文章</div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <form action="{{ route('posts.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-2 col-form-label-sm text-md-right">標題</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-sm {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title">
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
