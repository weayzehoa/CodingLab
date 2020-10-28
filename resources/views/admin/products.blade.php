@extends('admin.layouts.master')

@section('title', '產品管理')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                {{-- alert訊息 --}}
                @include('admin.layouts.alert_message')
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>產品管理(建構中)</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/products') }}">產品管理</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
