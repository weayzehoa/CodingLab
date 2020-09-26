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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/mbposts') }}">會員文章</a></li>
                            <li class="breadcrumb-item active">{{ $post ? '修改' : '新增' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">文章資料</h3>
                            </div>
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">標題</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $post->title }}" placeholder="輸入標題" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">分類</label>
                                        <select class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" name="type">
                                            <option value="" selected="selected">全部分類</option>
                                            @foreach ($post_types as $post_type)
                                                <option value="{{ $post_type->id }}"
                                                    {{ $post->type == $post_type->id ? 'selected' : '' }}>
                                                    {{ $post_type->name }}
                                                    </span>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>內容</label>
                                        <textarea class="form-control" rows="3" id="content" name="content"
                                            placeholder="Enter ...">{{ $post->content }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="onlinedate">上線日期時間</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="onlinedate" name="onlinedate"
                                                    value="{{ $post ? $post->onlinedate : '' }}" placeholder="上線日期時間"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="offlinedate">下線日期時間</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="offlinedate" name="offlinedate"
                                                    value="{{ $post ? $post->offlinedate : '' }}" placeholder="下線日期時間">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6" style="background-color:#f0f0f0">
                                            <label for="onlinedate">審核</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-secondary d-inline mr-2">
                                                    <input type="radio" id="approved_wait" name="approved"
                                                        {{ $post->approved == 0 ? 'checked' : '' }}>
                                                    <label for="approved_wait">等待中</label>
                                                </div>
                                                <div class="icheck-green d-inline mr-2">
                                                    <input type="radio" id="approved_pass" name="approved"
                                                        {{ $post->approved == 1 ? 'checked' : '' }}>
                                                    <label for="approved_pass">通過</label>
                                                </div>
                                                <div class="icheck-danger d-inline mr-2">
                                                    <input type="radio" id="approved_denie" name="approved"
                                                        {{ $post->approved == 2 ? 'checked' : '' }}>
                                                    <label for="approved_denie">拒絕</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="offlinedate">上線狀態</label>
                                            <div class="input-group">
                                                <input type="checkbox" name="isshow" data-bootstrap-switch
                                                    data-off-color="secondary" data-on-color="success"
                                                    {{ $post->isshow == 1 ?? 'checked' }}>
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label for="offlinedate">置頂狀態</label>
                                            <div class="input-group">
                                                <input type="checkbox" name="istop" checked data-bootstrap-switch
                                                    data-off-color="secondary" data-on-color="primary"
                                                    {{ $post->istop == 1 ?? 'checked' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">{{ $post ? '修改' : '新增' }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">會員資料</h3>
                            </div>
                            <div class="card-body row">
                                <div class="card card-primary card-outline col-4">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ ($post->user->avatar ? url($post->user->avatar) : $post->user->gender == 1) ? url('dist/img/avatar5.png') : url('dist/img/avatar2.png') }}"
                                                alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center">{{ $post->user->name }}</h3>
                                        <p class="text-muted text-center">Software Engineer</p>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline col-4">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ ($post->user->avatar ? url($post->user->avatar) : $post->user->gender == 1) ? url('dist/img/user2-160x160.jpg') : url('dist/img/user3-128x128.jpg') }}"
                                                alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center">{{ $post->user->name }}</h3>
                                        <p class="text-muted text-center">Hardware Engineer</p>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline col-4">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ ($post->user->avatar ? url($post->user->avatar) : $post->user->gender == 1) ? url('dist/img/user2-160x160.jpg') : url('dist/img/user3-128x128.jpg') }}"
                                                alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center">{{ $post->user->name }}</h3>
                                        <p class="text-muted text-center">Database Engineer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">相關留言</h3>
                                <span class="right badge badge-danger">{{ $comments_total }}</span>
                            </div>
                            <div class="card-body">
                                @foreach($comments as $comment)
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ ($comment->user->avatar ? url($comment->user->avatar) : $comment->user->gender == 1) ? url('dist/img/avatar5.png') : url('dist/img/avatar2.png') }}" alt="User Image">
                                        <span class="username">
                                            <a href="#">{{ $comment->user->name }}</a>
                                        </span>
                                        <a href="#" class="float-right btn-tool text-danger"><i
                                                class="fas fa-trash"></i></a>
                                        <span class="description">{{ $comment->created_at }} 留言</span>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                </div>
                                @endforeach
                                <div class="post clearfix float-right">
                                @isset($comments)
                                {{ $comments->render() }}
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
