@extends('admin.layouts.master')

@section('title', '會員文章')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            {{-- alert訊息 --}}
            @include('admin.layouts.alert_message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>{{ $post ? '修改' : '新增' }}會員文章</b></h1>
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
                        {{-- update 必須使用 隱藏 _method 欄位 value="PATCH" --}}
                        <form id="myform" action="{{ route('admin.mbposts.update', $post->id) }}" method="POST"
                            role="form">
                            <input type="hidden" name="_method" value="PATCH">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">標題</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                                        name="title" value="{{ $post->title }}" placeholder="輸入標題" required>
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="type">分類</label>
                                    <select
                                        class="form-control select2bs4 select2-primary {{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        data-dropdown-css-class="select2-primary" name="type" required>
                                        <option value="0" selected="selected">選擇分類</option>
                                        @foreach ($post_types as $post_type)
                                        <option value="{{ $post_type->id }}"
                                            {{ $post->type == $post_type->id ? 'selected' : '' }}>
                                            {{ $post_type->name }}
                                            </span>
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }} "
                                        rows="3" id="content" name="content" placeholder="Enter ..."
                                        required>{{ $post->content ?? '' }}</textarea>
                                    @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="onlinedate">上線日期時間</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text"
                                                class="form-control datetimepicker {{ $errors->has('onlinedate') ? ' is-invalid' : '' }}"
                                                id="onlinedate" name="onlinedate" value="{{ $post->onlinedate ?? '' }}"
                                                placeholder="上線日期時間" required>
                                            @if ($errors->has('onlinedate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('onlinedate') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="offlinedate">下線日期時間</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text"
                                                class="form-control datetimepicker {{ $errors->has('offlinedate') ? ' is-invalid' : '' }}"
                                                id="offlinedate" name="offlinedate"
                                                value="{{ $post->offlinedate ?? '' }}" placeholder="下線日期時間">
                                            @if ($errors->has('offlinedate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('offlinedate') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6" style="background-color:#f0f0f0">
                                        <label for="onlinedate">審核</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-secondary d-inline mr-2">
                                                <input type="radio" id="approved_wait" name="approved" value="0"
                                                    {{ $post->approved == 0 ? 'checked' : '' }}>
                                                <label for="approved_wait">等待中</label>
                                            </div>
                                            <div class="icheck-green d-inline mr-2">
                                                <input type="radio" id="approved_pass" name="approved" value="1"
                                                    {{ $post->approved == 1 ? 'checked' : '' }}>
                                                <label for="approved_pass">通過</label>
                                            </div>
                                            <div class="icheck-danger d-inline mr-2">
                                                <input type="radio" id="approved_denie" name="approved" value="2"
                                                    {{ $post->approved == 2 ? 'checked' : '' }}>
                                                <label for="approved_denie">拒絕</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="offlinedate">上線狀態</label>
                                        <div class="input-group">
                                            <input type="checkbox" name="isshow" value="1" data-bootstrap-switch
                                                data-off-color="secondary" data-on-color="success"
                                                {{ $post->isshow == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="offlinedate">置頂狀態</label>
                                        <div class="input-group">
                                            <input type="checkbox" name="istop" value="1" data-bootstrap-switch
                                                data-off-color="secondary" data-on-color="primary"
                                                {{ $post->istop == 1 ? 'checked' : '' }}>
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
                            <div class="card card-primary card-outline col-8">
                                <div class="card-body box-profile">
                                    <h2 class="lead mb-4"><b>{{ $post->user->name }}</b></h2>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="mb-2"><span class="fa-li"><i
                                                    class="fas fa-venus-mars"></i></span>{{ $post->user->gender == 1 ? '男' : '女' }}
                                        </li>
                                        <li class="mb-2"><span class="fa-li"><i
                                                    class="fas fa-envelope"></i></span>{{ $post->user->email }}</li>
                                        <li class="mb-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-phone"></i></span>{{ $post->user->tel }}</li>
                                        <li class="mb-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>{{ $post->user->address }}
                                        </li>
                                    </ul>
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
                                        src="{{ ($comment->user->avatar ? url($comment->user->avatar) : $comment->user->gender == 1) ? url('dist/img/avatar5.png') : url('dist/img/avatar2.png') }}"
                                        alt="User Image">
                                    <span class="username">
                                        <a href="#">{{ $comment->user->name }}</a>
                                    </span>
                                    <form action="{{ route('admin.comments.destroy', $comment->id ) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="float-right btn btn-sm text-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
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

@section('css')
    {{-- iCheck for checkboxes and radio inputs --}}
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css') }}">
    {{-- 時分秒日曆 --}}
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-Timepicker/dist/jquery-ui-timepicker-addon.min.css') }}">
@endsection

@section('script')
    {{-- Select2 --}}
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- Bootstrap Switch --}}
    <script src="{{ asset('vendor/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
    {{-- 時分秒日曆 --}}
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-Timepicker/dist/jquery-ui-timepicker-addon.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-Timepicker/dist/i18n/jquery-ui-timepicker-zh-TW.js') }}"></script>
    {{-- Jquery Validation Plugin --}}
    <script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {{-- Ckeditor 4.x --}}
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('JsValidator')
    {!! JsValidator::formRequest('App\Http\Requests\PostRequest', '#myform'); !!}
    {{-- {!! JsValidator::formRequest('App\Http\Requests\PostRequest'); !!} --}}
@endsection

@section('CustomScript')
    {{-- 程式碼太長時可以將所有程式碼集中到一個.js檔案後再引進 --}}
    <script src="{{ asset('js/admin.mbpost.edit.js')}}"></script>
@endsection
