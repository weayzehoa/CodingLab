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
                    <h1 class="m-0 text-dark"><b>會員管理</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('admin/members') }}">會員管理</a></li>
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
                            <div class="float-left">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        {{-- <a href="{{ route('admin.members.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-1"></i>新增</a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class=" float-right">
                                <div class="form-group row">
                                    <form action="{{ url('/admin/members/search') }}" method="GET" class="form-inline" role="search">
                                        @csrf
                                        <input type="search" class="form-control form-control-sm mr-sm-2" name="keyword"
                                            value="{{ isset($keyword) ? $keyword : '' }}" placeholder="搜尋姓名或帳號"
                                            aria-label="Search">
                                        <button type="submit" class="btn btn-sm btn-info my-2 my-sm-0">
                                            <i class="fas fa-search"></i>
                                            搜尋
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            {{-- 文字不斷行 table中加上 class="text-nowrap" --}}
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">編號</th>
                                        <th class="text-center" width="15%">姓名</th>
                                        <th class="text-center" width="15%">帳號</th>
                                        <th class="text-center" width="8%">身分類型</th>
                                        <th class="text-center" width="12%">Email驗證</th>
                                        <th class="text-center" width="12%">註冊日期</th>
                                        <th class="text-center" width="7%">文章數量</th>
                                        <th class="text-center" width="7%">留言數量</th>
                                        <th class="text-center" width="7%">啟用狀態</th>
                                        <th class="text-center" width="7%">刪除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $user->id }}</td>
                                        <td class="text-left align-middle">
                                            <div class="user-panel d-flex">
                                                <div class="image">
                                                    <img src="{{ $user->avatar ? asset($user->avatar) : asset('img/noavatar.png') }}" class="img-circle elevation-2" alt="User Image">
                                                </div>
                                                <div class="info">
                                                    <span class="username"><a href="{{ route('admin.members.edit', $user->id ) }}">{{ $user->name }}</a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">
                                            {{ $user->type == 1 ? '一般' : '訪客' }}
                                            @if($user->socialuser)
                                            @foreach($user->socialuser as $socialuser)
                                                @if($socialuser['provider'] == 'facebook')
                                                <span class="right"><i class="fab fa-facebook-square  text-primary"></i></span>
                                                @elseif($socialuser['provider'] == 'google')
                                                <span class="right"><i class="fab fa-google-plus text-danger"></i></span>
                                                @elseif(($socialuser['provider'] == 'github'))
                                                <span class="right"><i class="fab fa-github-square text-secondary"></i></span>
                                                @endif
                                            @endforeach
                                            @else
                                            <span class="right"><i class="fas fa-registered text-info"></i></span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $user->email_verified_at ?? '尚未驗證'  }}</td>
                                        <td class="text-center align-middle">{{ $user->created_at }}</td>
                                        <td class="text-center align-middle">
                                            <a href="javascript:" class="btn btn-sm btn-primary">{{ $user->postsTotal ?? 0 }}</a>
                                        </td>
                                        <td class="text-center align-middle"><a href="javascript:" class="btn btn-sm btn-info">{{ $user->commentsTotal ?? 0 }}</a></td>
                                        <td class="text-center align-middle">
                                            <div class="custom-control custom-switch custom-switch-on-success">
                                                <form action="{{ url('admin/members/active/' . $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="checkbox" name="active" class="custom-control-input" id="active{{ $user->id }}"
                                                        onclick="submit(this)" {{ $user->active == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="active{{ $user->id }}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('admin.members.destroy', $user->id) }}" method="POST">
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
                                @isset($keyword)
                                {{ $users->appends(['keyword' => $keyword])->render() }}
                                @else
                                {{ $users->render() }}
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
{{-- iCheck for checkboxes and radio inputs --}}
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
{{-- Select2 --}}
<link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
{{-- Bootstrap Switch --}}
<script src="{{ asset('vendor/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
@endsection

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

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
@endsection
