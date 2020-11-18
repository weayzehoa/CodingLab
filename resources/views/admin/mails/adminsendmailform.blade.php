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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">發送通知</h3>
                        </div>
                        <form id="sendnoteform" action="{{ route('admin.sendnote') }}" method="POST" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>To</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" placeholder="輸入Email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>主旨</label>
                                    <input type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" value="發送通知測試主旨" placeholder="輸入主旨">
                                    @if ($errors->has('subject'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">標題</label>
                                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="發送通知測試標題" placeholder="輸入標題">
                                    @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }} " rows="3" id="sendnote" name="content" placeholder="Enter ...">發送通知測試內容!!發送通知測試內容!!</textarea>
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
@endsection

@section('script')
{{-- Jquery Validation Plugin --}}
<script src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{{-- Ckeditor 4.x --}}
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('JsValidator')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminSendMailRequest', '#myform'); !!}
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminSendNoteRequest', '#sendnoteform'); !!}
@endsection

@section('CustomScript')
{{-- 程式碼太長時可以將所有程式碼集中到一個.js檔案後再引進 --}}
<script>
    (function($) {
        "use strict";
        var editor = CKEDITOR.replace( 'content');
        editor.on( 'required', function( evt ) {
            editor.showNotification( '請輸入資料再按儲存.', 'warning' );
            evt.cancel();
        } );
        var sendNoteEditor = CKEDITOR.replace( 'sendnote');
        sendNoteEditor.on( 'required', function( sendNoteEvt ) {
            sendNoteEditor.showNotification( '請輸入資料再按儲存.', 'warning' );
            sendNoteEvt.cancel();
        } );
    })(jQuery);
</script>
@endsection
