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
                        <li class="breadcrumb-item active"><a href="{{ url('admin/mbposts') }}">會員管理</a></li>
                        <li class="breadcrumb-item active">{{ $user ?? '' ? '修改會員資料' : '新增會員資料' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


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
