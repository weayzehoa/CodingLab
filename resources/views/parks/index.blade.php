@extends('layouts.master')

@section('title', '台北公園資訊')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">台北公園資訊資料</h3>
                    <i class="fas fa-info text-danger"></i> 這邊直接讀取站內 Parks 資料表所有資料。並且使用 DataTable 套件來呈現部分資料。<br>
                    <i class="fas fa-info text-primary"></i> 使用 Laravel 本身提供的 Response to JSON 及 FileSystem 將資料轉換成 JSON 並提供下載。<br>
                    <i class="fas fa-info text-primary"></i> 使用 laravel/excel - 匯入匯出 試算表 套件，將資料轉換成 CSV、XLS、XLSX、ODS 並提供下載。<br>
                    <i class="fas fa-info text-primary"></i> 使用 bmatovu/laravel-xml (v1.0 for Laravel6) - 匯入匯出 XML 套件，將資料轉換成 XML 並提供下載。<br>
                    <i class="fas fa-info text-primary"></i> 使用 barryvdh/laravel-dompdf - 匯出 PDF 套件，將資料轉換成 PDF 並提供下載。(由於資料太多，只取50筆作為範例)
                </div>
            </div>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">台北公園資訊資料轉換下載</h3><br>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('parks.index') }}" class="btn btn-warning">DataTable 模式</a>
                        <a href="{{ route('parks.showJson') }}" class="btn btn-primary">JSON (顯示於下方)</a>
                        <a href="{{ route('parks.openJson') }}" class="btn btn-primary" target="_blank">JSON (另開視窗)</a>
                    </div>
                    <div class="mb-3"><span>檔案下載</span>
                        <a href="{{ route('parks.downJson') }}" class="btn btn-primary">JSON</a>
                        <a href="{{ route('parks.csv') }}" class="btn btn-success">CSV</a>
                        <a href="{{ route('parks.xls') }}" class="btn btn-success">XLS</a>
                        <a href="{{ route('parks.xlsx') }}" class="btn btn-success">XLSX</a>
                        <a href="{{ route('parks.ods') }}" class="btn btn-secondary">ODS</a>
                        <a href="{{ route('parks.xml') }}" class="btn btn-warning">XML</a>
                        <a href="{{ route('parks.pdf') }}" class="btn btn-danger">PDF(50筆)</a>
                    </div>
                    <form action="{{ route('parks.search') }}" method="GET" class="form-inline" role="search">
                        <div><span>資料搜尋</span>
                            <input type="search" class="form-control form-control-sm mr-sm-2  ml-2" name="keyword" value="{{ $keyword ?? '' }}" placeholder="輸入關鍵字" aria-label="Search">
                            <button type="submit" class="btn btn-sm btn-outline-info my-2 my-sm-0">
                                <i class="fas fa-search"></i>
                                搜尋
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if($jsonData ?? '')
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">JSON 資料</h3>
                </div>
                <div class="card-body">
                    {{ $jsonData ?? '' }}
                </div>
            </div>
            @endif
            @if($parks ?? '')
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">台北公園資訊 (跨資料庫撈取)</h3>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped text-xs">
                        <thead>
                            <tr>
                                <th width="18%">公園名稱</th>
                                <th width="18%">英文名稱</th>
                                <th width="7%">類型</th>
                                <th width="7%">行政區</th>
                                <th width="25%">位置</th>
                                <th width="15%">管理單位</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $parks ?? '' as $park )
                            <tr>
                                <td><a href="{{ route('parks.show', $park->id) }}">{{ $park->name }}</a></td>
                                <td>{{ $park->engname }}</td>
                                <td>{{ $park->type }}</td>
                                <td>{{ $park->dist }}</td>
                                <td>{{ $park->location }}</td>
                                <td>{{ $park->unit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

@endsection

@section('css')
{{-- DataTables CSS --}}
<link rel="stylesheet" href="{{ asset('vendor/datatables/media/css/jquery.dataTables.min.css') }}">
@endsection

@section('script')
{{-- DataTables 套件 --}}
<script src="{{ asset('vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
@endsection

@section('CustomScript')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            order: [
                [3, "desc"]
            ],
            pageLength: 15,
            lengthMenu: [
                [15, 30, 50, -1],
                [15, 30, 50, "All"]
            ],
            language: {
                lengthMenu: "每頁顯示 _MENU_ 筆資料",
                zeroRecords: "抱歉，查無資料",
                info: "",
                infoEmpty: "",
                infoFiltered: "(filtered from _MAX_ total records)",
                paginate: {
                    first: "首頁",
                    previous: "前一頁",
                    next: "後一頁",
                    last: "尾頁",
                },
                searchPlaceholder: "輸入關鍵字",
                search: "搜尋表內資料:",
            },
            pagingType: "full_numbers",
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'pdf',
            //         text: '匯出PDF',
            //     },
            //     {
            //         extend: 'csv',
            //         text: '匯出CSV',
            //         bom : true,
            //     },
            // ],
        });
    });
</script>
@endsection
