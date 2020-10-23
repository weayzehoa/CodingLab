@extends('layouts.master')

@section('title', '驗證Email')

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
            @if (session('resent'))
            <div class="row justify-content-center">
                <div class="alert-float alert alert-success alert-dismissible fade show col-6" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="text-center"><strong>已將新的驗證信件寄至你註冊的 Email 信箱中。</strong></div>
                </div>
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            驗證你的 Email
                        </div>
                        <div class="card-body">
                            在使用本站所有完整功能之前，必須驗證你的Email。請到你註冊的 Email 信箱中檢查是否有本站驗證信件。
                            請在信件中點擊 [Verify Email Address] 按鈕或連結來作驗證。
                            若未收到本站驗證信件，請點擊下方按鈕，重新寄出新的驗證信件。<br>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('verification.resend') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">重新寄送驗證信</button>
                            </form>
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
