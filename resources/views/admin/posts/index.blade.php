@extends('admin.layouts.master')

@section('title', '會員文章')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>會員文章</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/posts') }}">會員文章</a></li>
                            <li class="breadcrumb-item active">清單</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <div class="card-tools float-left">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>新增</a>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="card-tools float-left">
                                    <div class="input-group">
                                        <label>分類：</label>
                                        <select class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary">
                                            <option selected="selected">全部分類</option>
                                            @foreach ($post_types as $post_type)
                                                <option
                                                    {{ isset($type) ? ($type->id == $post_type->id ? 'selected' : '') : '' }}>
                                                    {{ $post_type->name }} ( {{ $post_type->posts->count() }} )
                                                    </span>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group">
                                        <input type="text" name="posts_search" class="form-control float-right"
                                            placeholder="搜尋標題或會員">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                {{-- 文字不斷行 table中加上 class="text-nowrap" --}}
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-left" width="25">標題</th>
                                            <th class="text-left" width="10%">類別</th>
                                            <th class="text-left" width="15%">會員</th>
                                            <th class="text-center" width="8%">審核狀態</th>
                                            <th class="text-center" width="10%">上線日期</th>
                                            <th class="text-center" width="10%">下線日期</th>
                                            <th class="text-center" width="5%">上線</th>
                                            <th class="text-center" width="5%">置頂</th>
                                            <th class="text-center" width="7%">排序</th>
                                            <th class="text-center" width="10%">刪除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td class="text-left align-middle">
                                                    <a href="#"><b>{{ $post->title }}</b></a>
                                                </td>
                                                <td class="text-left align-middle">{{ $post->postType->name }}</td>
                                                <td class="text-left align-middle">{{ $post->User->name }}</td>
                                                <td class="text-center align-middle">
                                                    @if ($post->approved == 0)
                                                        <span class="center badge badge-secondary text-sm">Pendding</span>
                                                    @elseif($post->approved == 1)
                                                        <span class="center badge badge-primary text-sm">Approved</span>
                                                    @else
                                                        <span class="center badge badge-danger text-sm">Denied</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">{{ $post->onlinedate }}</td>
                                                <td class="text-center align-middle">{{ $post->offlinedate }}</td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-control custom-switch custom-switch-on-success">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="isShow{{ $post->id }}"
                                                            {{ $post->isshow == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="isShow{{ $post->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="custom-control custom-switch custom-switch-on-primary">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="isTop{{ $post->id }}"
                                                            {{ $post->istop == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="isTop{{ $post->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="javascript:void(0)" class="text-navy">
                                                        <i class="fas fa-arrow-alt-circle-up text-lg"></i>
                                                    </a>　
                                                    <a href="javascript:void(0)" class="text-navy">
                                                        <i class="fas fa-arrow-alt-circle-down text-lg"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="float-right">
                                    {{-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼
                                    --}}
                                    @isset($keyword)
                                        {{ $posts->appends(['keyword' => $keyword])->render() }}
                                    @else
                                        {{ $posts->render() }}
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
