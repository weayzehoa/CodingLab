@extends('layouts.master')

@section('title', '台北公園資訊')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">台北公園資訊</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">CodingLab</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('parktaipei') }}">台北公園資訊</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            {{-- 這邊開始放置 內容頁面 --}}
            @if($parks)
            <div class="card">
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
                            @foreach ( $parks as $park )
                            <tr>
                                <td>{{ $park->pm_name }}</td>
                                <td>{{ $park->pm_name_eng }}</td>
                                <td>{{ $park->pm_type }}</td>
                                <td>{{ $park->pm_regions }}</td>
                                <td>{{ $park->pm_location }}</td>
                                <td>{{ $park->pm_unit }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
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
