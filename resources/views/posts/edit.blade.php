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
