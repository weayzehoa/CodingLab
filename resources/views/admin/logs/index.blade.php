@extends('admin.layouts.master')

@section('title', '維護紀錄')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                {{-- alert訊息 --}}
                @include('admin.layouts.alert_message')
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>維護紀錄</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/logs') }}">維護紀錄</a></li>
                            <li class="breadcrumb-item active">清單</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="GET" class="form-inline" role="search">
                                        <span>類別：</span>
                                        <select class="form-control form-control-sm mr-2" data-dropdown-css-class="select2-primary" name="action">
                                        <option value="">全部</option>
                                        <option value="created" {{ !empty($action) && $action == 'created' ? 'selected' : '' }}>新增</option>
                                        <option value="updated" {{ !empty($action) && $action == 'updated' ? 'selected' : '' }}>修改</option>
                                        <option value="deleted" {{ !empty($action) && $action == 'deleted' ? 'selected' : '' }}>刪除</option>
                                        <option value="other" {{ !empty($action) && $action == 'other' ? 'selected' : '' }}>其他</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm mr-sm-2" name="keyword"
                                            value="{{ isset($keyword) ? $keyword : '' }}" placeholder="選擇類別及輸入關鍵字"
                                            aria-label="Search">
                                        <button type="submit" class="btn btn-sm btn-info my-2 my-sm-0">
                                            <i class="fas fa-search"></i>
                                            搜尋
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                {{-- 文字不斷行 table中加上 class="text-nowrap" --}}
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">編號</th>
                                            <th class="text-center" width="10%">名字</th>
                                            <th class="text-center" width="10%">帳號</th>
                                            <th class="text-center" width="10%">單元</th>
                                            <th class="text-center" width="15%">動作</th>
                                            <th class="text-center" width="20%">標題/名稱</th>
                                            <th class="text-center" width="10%">來源IP</th>
                                            <th class="text-center" width="15%">日期時間</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($logs)
                                        @foreach ($logs as $log)
                                            <tr>
                                                <td class="text-center align-middle">{{ $log->id }}</td>
                                                <td class="text-left align-middle">{{ $log->name }}</td>
                                                <td class="text-left align-middle">{{ $log->email }}</td>
                                                <td class="text-left align-middle">{{ $log->log_name }}</td>
                                                <td class="text-left align-middle">
                                                    @if($log->description == '新增' || $log->description == '修改' || $log->description == '刪除')
                                                    <a href="{{ $log->url }}"><b>{{ $log->description }}</b></a>
                                                    @else
                                                    {{ $log->description }}
                                                    @endif
                                                </td>
                                                <td class="text-left align-middle">{{ $log->title ?? '' }}</td>
                                                <td class="text-center align-middle">{{ $log->ip }}</td>
                                                <td class="text-center align-middle">{{ $log->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="float-right">
                                    @isset($search)
                                        {{ $logs->appends($search)->render() }}
                                    @else
                                        {{ $logs->render() }}
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
