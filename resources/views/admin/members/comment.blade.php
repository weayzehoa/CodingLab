@extends('admin.layouts.master')

@section('title', '會員管理')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            {{-- alert訊息 --}}
            @include('admin.layouts.alert_message')
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>{{ $user ?? '' ? '修改會員資料' : '新增會員資料' }}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/members') }}">會員管理</a></li>
                        <li class="breadcrumb-item active">修改會員資料</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">會員資料</h3>
                        </div>
                        <div class="card-body row">
                            <div class="card card-primary card-outline col-4">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ $user->avatar ? asset($user->avatar) : asset('img/noavatar.png') }}" alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                    <p class="text-muted text-center">Software Engineer</p>
                                </div>
                            </div>
                            <div class="card card-primary card-outline col-8">
                                <div class="card-body box-profile">
                                    <h2 class="lead mb-4"><b>{{ $user->name }}</b></h2>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="mb-2"><span class="fa-li"><i class="fas fa-venus-mars"></i></span>{{ $user->gender == 1 ? '男' : '女' }}
                                        </li>
                                        <li class="mb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span>{{ $user->email }}</li>
                                        <li class="mb-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>{{ $user->tel }}</li>
                                        <li class="mb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>{{ $user->address }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card card-primary card-outline col-12">
                                {{-- update 必須使用 隱藏 _method 欄位 value="PATCH" --}}
                                <form id="myform" action="{{ route('admin.members.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PATCH">
                                    @csrf
                                    <div class="card-body box-profile">
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="exampleInputEmail1">姓名</label>
                                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="title" name="name" value="{{ $user->name }}" placeholder="輸入姓名" required>
                                                @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleInputEmail1">性別</label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline mr-2">
                                                        <input type="radio" id="gender1" name="gender" value="1" {{ $user->gender == 1 ? 'checked' : '' }}>
                                                        <label for="gender1">男</label>
                                                    </div>
                                                    <div class="icheck-danger d-inline mr-2">
                                                        <input type="radio" id="gender2" name="gender" value="2" {{ $user->gender == 2 ? 'checked' : '' }}>
                                                        <label for="gender2">女</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="tel">電話</label>
                                                <input type="text" class="form-control {{ $errors->has('tel') ? ' is-invalid' : '' }}" id="tel" name="tel" value="{{ $user->tel }}" placeholder="輸入電話" required>
                                                @if ($errors->has('tel'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tel') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-8">
                                                <label for="address">地址</label>
                                                <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" name="address" value="{{ $user->address }}" placeholder="輸入地址">
                                                @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4 bg-secondary">
                                                <label for="active">啟用狀態</label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-green d-inline mr-2">
                                                        <input type="radio" id="active_pass" name="active" value="1" {{ $user->active == 1 ? 'checked' : '' }}>
                                                        <label for="active_pass">啟用</label>
                                                    </div>
                                                    <div class="icheck-danger d-inline mr-2">
                                                        <input type="radio" id="active_denie" name="active" value="0" {{ $user->active == 0 ? 'checked' : '' }}>
                                                        <label for="active_denie">停權</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-8">
                                                <label for="avatar">修改頭像</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="avatar" name="avatar" class="custom-file-input {{ $errors->has('avatar') ? ' is-invalid' : '' }}" accept="image/*">
                                                        <label class="custom-file-label" for="avatar">瀏覽選擇新圖片</label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('avatar'))
                                                <div>
                                                    <span class="text-danger">
                                                        <strong>{{ $errors->first('avatar') }}</strong>
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-4 bg-secondary">
                                                <label for="emailverify">Email驗證狀態</label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-green d-inline mr-2">
                                                        <input type="radio" id="emailverify1" value="1" {{ $user->email_verified_at ? 'checked' : '' }} disabled>
                                                        <label for="emailverify1">已驗證</label>
                                                    </div>
                                                    <div class="icheck-danger d-inline mr-2">
                                                        <input type="radio" id="emailverify2" value="0" {{ !$user->email_verified_at ? 'checked' : '' }} disabled>
                                                        <label for="emailverify2">尚未驗證</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="emailverify">註冊日期</label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-green d-inline mr-2">
                                                        <label>{{ $user->created_at }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="emailverify">第三方帳號綁定</label>
                                                <div class="form-group clearfix">
                                                    <div class="icheck-green d-inline mr-2">
                                                        @if($user->socialuser)
                                                        @if($user->socialuser->provider == 'facebook')
                                                        <i class="fab fa-facebook-square  text-primary"></i></span>
                                                        @elseif($user->socialuser->provider == 'google')
                                                        <i class="fab fa-google-plus text-danger"></i></span>
                                                        @elseif($user->socialuser->provider == 'github')
                                                        <i class="fab fa-github-square text-secondary"></i> {{ $user->socialuser->provider }}</span>
                                                        @endif
                                                        @else
                                                        <span class="right"><i class="fas fa-registered text-info"></i></span> 無</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">修改</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">文章資料</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="card-body">
                                {{-- 文字不斷行 table中加上 class="text-nowrap" --}}
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-left" width="40">標題</th>
                                            <th class="text-left" width="20%">類別</th>
                                            <th class="text-center" width="20%">發佈日期</th>
                                            <th class="text-center" width="10%">刪除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td class="text-left align-middle">
                                                <a href="{{ route('admin.mbposts.edit', $post->id) }}"><b>{{ $post->title }}</b></a>
                                            </td>
                                            <td class="text-center align-middle">{{ $post->postType->name }}</td>
                                            <td class="text-center align-middle">{{ $post->created_at }}</td>
                                            <td class="text-center align-middle">
                                                <form action="{{ route('admin.mbposts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="float-right">
                                    @isset($posts)
                                    {{ $posts->render() }}
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">所有留言</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="card-body">
                                {{-- 文字不斷行 table中加上 class="text-nowrap" --}}
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-left" width="40">留言內容</th>
                                            <th class="text-left" width="40">文章標題</th>
                                            <th class="text-center" width="10%">發佈日期</th>
                                            <th class="text-center" width="10%">刪除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        <tr>
                                            <td class="text-left align-middle">{{ $comment->content }}</td>
                                            <td class="text-left align-middle">
                                                <a href="{{ route('admin.mbposts.edit', $comment->post->id) }}"><b>{{ $comment->post->title }}</b></a>
                                            </td>
                                            <td class="text-center align-middle">{{ $comment->created_at }}</td>
                                            <td class="text-center align-middle">
                                                <form action="{{ route('admin.comments.destroy', $comment->id ) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
@endsection

@section('script')
{{-- Jquery Validation Plugin --}}
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
@endsection

@section('JsValidator')
{!! JsValidator::formRequest('App\Http\Requests\PostRequest', '#myform'); !!}
@endsection

@section('CustomScript')
@endsection
