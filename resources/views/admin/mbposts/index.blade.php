@extends('admin.layouts.master')

@section('title', '會員文章')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        {{-- alert訊息 --}}
        @include('admin.layouts.alert_message')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>會員文章</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/mbposts') }}">會員文章</a></li>
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
                            {{-- <div class="card-tools float-left">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>新增</a>
                                        </div>
                                    </div>
                                </div> --}}
                            <div class="card-tools float-left">
                                <div class="input-group">
                                    <label>分類：</label>
                                    <form id="posttype" action="{{ url('/admin/mbposts/selectType') }}" method="GET" class="form-inline" role="posttype">
                                        <select class="form-control select2bs4 select2-primary" data-dropdown-css-class="select2-primary" name="type">
                                            <option value="" selected="selected">全部分類</option>
                                            @foreach ($post_types as $post_type)
                                            <option value="{{ $post_type->id }}" {{ isset($type) ? ($type == $post_type->id ? 'selected' : '') : '' }}>
                                                {{ $post_type->name }} ( {{ $post_type->posts->count() }} )
                                                </span>
                                            </option>
                                            @endforeach
                                        </select>
                                    </form>
                                    {{-- 放在這邊主要為了靠近相關的使用，比較容易辨識該處有使用script，
                                            實際上會因為主視圖有設定@yield('CustomScript')會將其挪到下方，
                                            另外同樣也可以將所有script放到一個檔案中再引進來 --}}
                                    @section('CustomScript')
                                    <script>
                                        //Initialize Select2 Elements
                                        $('.select2').select2();

                                        //Initialize Select2 Elements
                                        $('.select2bs4').select2({
                                            theme: 'bootstrap4'
                                        });

                                        $('select[name=type]').change(function(e) {
                                            $('#posttype').submit();
                                        });
                                    </script>
                                    @endsection
                                </div>
                            </div>
                            <div class="card-tools">
                                <form action="{{ url('/admin/mbposts/search') }}" method="GET" class="form-inline" role="search">
                                    <input type="search" class="form-control form-control-sm mr-sm-2" name="keyword" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="搜尋文章" aria-label="Search">
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
                                        <th class="text-left" width="5">編號</th>
                                        <th class="text-left" width="15%">會員</th>
                                        <th class="text-left" width="25">標題</th>
                                        <th class="text-left" width="10%">類別</th>
                                        <th class="text-center" width="8%">審核狀態</th>
                                        <th class="text-center" width="10%">上線日期</th>
                                        <th class="text-center" width="10%">下線日期</th>
                                        <th class="text-center" width="5%">上線</th>
                                        <th class="text-center" width="5%">置頂</th>
                                        <th class="text-center" width="7%">排序</th>
                                        <th class="text-center" width="5%">刪除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ $post->id }}
                                        </td>
                                        <td class="text-left align-middle">
                                            <div class="user-panel d-flex">
                                                <div class="image">
                                                    <img src="{{ $post->User->avatar ? asset($post->User->avatar) : asset('img/noavatar.png') }}" class="img-circle elevation-2" alt="User Image">
                                                </div>
                                                <div class="info">
                                                    <span class="username"><a href="{{ route('admin.members.edit', $post->User->id ) }}">{{ $post->User->name }}</a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left align-middle">
                                            <a href="{{ route('admin.mbposts.edit', $post->id) }}"><b>{{ $post->title }}</b></a>
                                        </td>
                                        <td class="text-left align-middle">{{ $post->postType->name }}</td>
                                        <td class="text-center align-middle">
                                            @if ($post->approved == 0)
                                            <span class="center badge badge-secondary text-sm">Pendding</span>
                                            @elseif($post->approved == 1)
                                            <span class="center badge badge-primary text-sm">Approved</span>
                                            @else
                                            <span class="center badge badge-danger text-sm">Denied</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $post->onlinedate }}</td>
                                        <td class="text-center align-middle">{{ $post->offlinedate }}</td>
                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch custom-switch-on-success">
                                                <form action="{{ url('admin/mbposts/isshow/' . $post->id) }}" method="POST">
                                                    @csrf
                                                    <input type="checkbox" name="isshow" class="custom-control-input" id="isShow{{ $post->id }}" onclick="submit(this)" {{ $post->isshow == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="isShow{{ $post->id }}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                <form action="{{ url('admin/mbposts/istop/' . $post->id) }}" method="POST">
                                                    @csrf
                                                    <input type="checkbox" name="istop" class="custom-control-input" id="isTop{{ $post->id }}" onclick="submit(this)" {{ $post->istop == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="isTop{{ $post->id }}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ url('admin/mbposts/sortup/' . $post->id) }}" class="text-navy">
                                                <i class="fas fa-arrow-alt-circle-up text-lg"></i>
                                            </a>
                                            <a href="{{ url('admin/mbposts/sortdown/' . $post->id) }}" class="text-navy">
                                                <i class="fas fa-arrow-alt-circle-down text-lg"></i>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('admin.mbposts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="float-right">
                                {{-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼
                                    --}}
                                @isset($keyword)
                                {{ $posts->appends(['keyword' => $keyword])->render() }}
                                @else
                                {{ $posts->render() }}
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

@section('css')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
{{-- Select2 --}}
<script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
