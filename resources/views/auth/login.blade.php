@extends('layouts.master')

@section('title', '會員登入')

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
                        <li class="breadcrumb-item active"><a href="{{ route('login') }}"></a></li>
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
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">會員登入</p>
                        <form action="{{ route('login') }}" method="post" aria-label="會員登入">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="email" type="email" placeholder="輸入電子郵件" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
                            <div class="row mb-3">
                                <div class="input-group col-8">
                                    <input id="captchacode" type="text" placeholder="輸入驗證碼" class="form-control {{ $errors->has('captchacode') ? ' is-invalid' : '' }}" name="captchacode" required >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('captchacode'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('captchacode') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <img src="{{ captcha_src() }}" alt="點擊刷新" onclick="this.src='{{ url('captcha/default') }}?s='+Math.random()"><br>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                {!! no_captcha()->script()->toHtml() !!}
                                {!! no_captcha()->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="text-danger" role="">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">記住我</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">登入</button>
                                </div>
                            </div>
                        </form>
                        <div class="social-auth-links text-center mb-3">
                            <hr>
                            <a href="{{ route('redirect', ['provider' => 'facebook']) }}" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> 使用 Facebook 帳號登入
                            </a>
                            <a href="{{ route('redirect', ['provider' => 'google']) }}" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> 使用 Google+ 帳號登入
                            </a>
                            <a href="{{ route('redirect', ['provider' => 'github']) }}" class="btn btn-block btn-secondary">
                                <i class="fab fa-github mr-2"></i> 使用 GitHub 帳號登入
                            </a>
                        </div>
                        <span class="float-left">
                            <a href="{{ route('password.request') }}">忘記密碼?</a>
                        </span>
                        <span class="float-right">
                            <a href="{{ route('password.request') }}" class="text-center">註冊新會員</a>
                        </span>
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
