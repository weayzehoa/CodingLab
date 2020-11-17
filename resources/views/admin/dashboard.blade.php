@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
            {{-- alert訊息 --}}
            @include('admin.layouts.alert_message')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>Dashboard</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/news') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                {{-- <h3 class="card-title">Title</h3> --}}
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <h2>目前已完成會員管理、會員文章、維護紀錄功能。</h2>
                <h3>2020/11/01 前台購物車功能完成。</h3>
                <h3>2020/11/03 前台訂單功能完成。</h3>
                <h3>2020/11/05 前台綠界第三方串接測試完成。</h3>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
</div>
@endsection
