@extends('admin.layouts.master')

@section('title', '發送簡訊')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        {{-- alert訊息 --}}
        @include('admin.layouts.alert_message')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>發送簡訊</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/sms') }}">簡訊管理</a></li>
                        <li class="breadcrumb-item active">發送簡訊</li>
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
                            <h3 class="card-title">透過AWS SNS發送簡訊</h3>
                        </div>
                        <form id="myform" action="{{ route('admin.awssms') }}" method="POST" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span><span class="input-group-text">+886</span>
                                        </div>
                                        {{-- <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" id="phone" name="phone" pattern="[+]{1}[0-9]{11,14}" placeholder="輸入行動電話號碼，包含國碼及+號" required> --}}
                                        {{-- <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" id="phone" name="phone" pattern="[0-9]{9,11}" placeholder="輸入行動電話號碼" required> --}}
                                        <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="number" id="phone" name="phone" pattern="[0-9]" placeholder="輸入行動電話號碼">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }} " rows="3" id="content" name="content" placeholder="輸入訊息內容"></textarea>
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
                            <h3 class="card-title">透過 Nexmo 發送簡訊</h3>
                        </div>
                        <form id="nexmosms" action="{{ route('admin.nexmosms') }}" method="POST" role="form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">To</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-phone"></i></span><span class="input-group-text">+886</span>
                                        </div>
                                        <input class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="number" name="phone" pattern="[0-9]" placeholder="輸入行動電話號碼">
                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label>內容</label>
                                    <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }} " rows="3" name="content" placeholder="輸入訊息內容"></textarea>
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
@endsection

@section('JsValidator')
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminSendSMSRequest', '#myform'); !!}
{!! JsValidator::formRequest('App\Http\Requests\Admin\AdminSendNexmosmsRequest', '#nexmosms'); !!}
@endsection

@section('CustomScript')
@endsection
