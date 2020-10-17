@extends('layouts.master')

@section('title', '會員註冊')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}"></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('register') }}"></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            @if ($errors->has('message'))
            <div class="row justify-content-center">
                <div class="alert-float alert alert-danger alert-dismissible fade show col-6" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="text-center"><strong>{{ $errors->first('message') }}</strong></div>
                </div>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="card col-5">
                    <div class="card-body register-card-body">
                        <p class="login-box-msg">會員註冊</p>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="name" type="text" placeholder="姓名或暱稱" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input id="email" type="email" placeholder="電子郵件" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input id="password" type="password" placeholder="輸入密碼" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" placeholder="確認密碼" class="form-control" name="password_confirmation" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button type="submit" class="btn btn-info btn-block float-right">註冊申請</button>
                            </div>
                        </form>
                        <div class="social-auth-links text-center">
                            <hr>
                            <a href="{{ route('redirect', ['provider' => 'facebook']) }}" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> 使用 Facebook 帳號註冊
                            </a>
                            <a href="{{ route('redirect', ['provider' => 'google']) }}" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> 使用 Google+ 帳號註冊
                            </a>
                            <a href="{{ route('redirect', ['provider' => 'github']) }}" class="btn btn-block btn-secondary">
                                <i class="fab fa-github mr-2"></i> 使用 Github 帳號註冊
                            </a>
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
