@extends('admin.layouts.master')

@section('title', '會員文章')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><b>會員文章</b></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">後台管理系統</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('admin/posts') }}">會員文章</a></li>
                            <li class="breadcrumb-item active">清單</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools float-left">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>新增</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-tools">
                                    <div class="input-group">
                                        <input type="text" name="posts_search" class="form-control float-right"
                                            placeholder="搜尋標題或會員">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">ID</th>
                                            <th class="text-left" width="25%">標題</th>
                                            <th class="text-left" width="10%">類別</th>
                                            <th class="text-left" width="15%">會員</th>
                                            <th class="text-center" width="5%">審核狀態</th>
                                            <th class="text-center" width="10%">上線日期</th>
                                            <th class="text-center" width="10%">下線日期</th>
                                            <th class="text-center" width="5%">上線</th>
                                            <th class="text-center" width="5%">置頂</th>
                                            <th class="text-center" width="5%">排序</th>
                                            <th class="text-center" width="5%">刪除</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-middle">ID</td>
                                            <td class="text-left align-middle">
                                                <a href="#"><b>I am title and link.</b></a>
                                            </td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-center align-middle">
                                                <span class="center badge badge-primary text-sm">Approved</span>
                                            </td>
                                            <td class="text-center align-middle">2020-09-19</td>
                                            <td class="text-center align-middle">2021-09-18</td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" id="isShow1" checked>
                                                    <label class="custom-control-label" for="isShow1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-primary">
                                                    <input type="checkbox" class="custom-control-input" id="isTop1" checked>
                                                    <label class="custom-control-label" for="isTop1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-up text-lg"></i></a>　
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-down text-lg"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center align-middle">ID</td>
                                            <td class="text-left align-middle">
                                                <a href="#"><b>I am title and link.</b></a>
                                            </td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-center align-middle">
                                                <span class="center badge badge-danger text-sm">Denied</span>
                                            </td>
                                            <td class="text-center align-middle">2020-09-19</td>
                                            <td class="text-center align-middle">2021-09-18</td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" id="isShow1" checked>
                                                    <label class="custom-control-label" for="isShow1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-primary">
                                                    <input type="checkbox" class="custom-control-input" id="isTop1" checked>
                                                    <label class="custom-control-label" for="isTop1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-up text-lg"></i></a>　
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-down text-lg"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center align-middle">ID</td>
                                            <td class="text-left align-middle">
                                                <a href="#"><b>I am title and link.</b></a>
                                            </td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-center align-middle">
                                                <span class="center badge badge-primary text-sm">Approved</span>
                                            </td>
                                            <td class="text-center align-middle">2020-09-19</td>
                                            <td class="text-center align-middle">2021-09-18</td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" id="isShow1" checked>
                                                    <label class="custom-control-label" for="isShow1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-primary">
                                                    <input type="checkbox" class="custom-control-input" id="isTop1" checked>
                                                    <label class="custom-control-label" for="isTop1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-up text-lg"></i></a>　
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-down text-lg"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center align-middle">ID</td>
                                            <td class="text-left align-middle">
                                                <a href="#"><b>I am title and link.</b></a>
                                            </td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-left align-middle">John Doe</td>
                                            <td class="text-center align-middle">
                                                <span class="center badge badge-secondary text-sm">Pendding</span>
                                            </td>
                                            <td class="text-center align-middle">2020-09-19</td>
                                            <td class="text-center align-middle">2021-09-18</td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-success">
                                                    <input type="checkbox" class="custom-control-input" id="isShow1" checked>
                                                    <label class="custom-control-label" for="isShow1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-switch custom-switch-on-primary">
                                                    <input type="checkbox" class="custom-control-input" id="isTop1" checked>
                                                    <label class="custom-control-label" for="isTop1"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-up text-lg"></i></a>　
                                                <a href="javascript:void(0)" class="text-navy"><i class="fas fa-arrow-alt-circle-down text-lg"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white ">
                                <ul class="pagination m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <div class="input-group">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="新增文章類別">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-info"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-left" width="85%">名稱</th>
                                            <th class="text-center" width="15%">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($post_types)
                                        @foreach($post_types as $post_type)
                                        <tr>
                                            <td class="text-left align-middle"> {{ $post_type->name }} </td>
                                            <td class="text-center align-middle">
                                                <a href="#" type="button" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                                <a href="#" type="button" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
