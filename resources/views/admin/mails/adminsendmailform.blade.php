@extends('admin.layouts.master')

@section('title', '發送信件')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        {{-- alert訊息 --}}
        @include('admin.layouts.alert_message')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>發送信件</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/mails') }}">信件管理</a></li>
                        <li class="breadcrumb-item active">發送信件</li>
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
                            <h3 class="card-title">發送信件</h3>
                        </div>
                        <form id="myform" action="{{ route('admin.sendmail') }}" method="POST" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">To</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="" placeholder="輸入Email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">主旨</label>
                                    <input type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subject" name="subject" value="" placeholder="輸入主旨">
                                    @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">標題</label>
                                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value="" placeholder="輸入標題">
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }} " rows="3" id="content" name="content" placeholder="Enter ..."></textarea>
                                    @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">發送</button>
                            </div>
                        </form>
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
