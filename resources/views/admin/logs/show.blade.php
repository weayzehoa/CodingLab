@extends('admin.layouts.master')

@section('title', '維護紀錄')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                            <li class="breadcrumb-item active"><a href="{{ url('admin/mails') }}">維護紀錄</a></li>
                            <li class="breadcrumb-item active">瀏覽</li>
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
                                <h3 class="card-title">一般方式($log->id)</h3>
                            </div>
                            <div class="card-body">
                                {{ $log->id }}<br>
                                {{ $log->log_name }}<br>
                                {{ $log->subject_type }}<br>
                                {{ $log->subject_id }}<br>
                                {{ $log->causer_type }}<br>
                                {{ $log->causer_id }}<br>
                                {{ $log->causer_name }}<br>
                                {{ $log->causer_email }}<br>
                                {{ $log->description }}<br>
                                {{ $log->ip }}<br>
                                {{ $log->created_at }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">轉成陣列方式($logArray['id'])</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                {{ $logArray['id'] }}<br>
                                {{ $logArray['log_name'] }}<br>
                                {{ $logArray['subject_type'] }}<br>
                                {{ $logArray['subject_id'] }}<br>
                                {{ $logArray['causer_type'] }}<br>
                                {{ $logArray['causer_id'] }}<br>
                                {{ $logArray['causer_name'] }}<br>
                                {{ $logArray['causer_email'] }}<br>
                                {{ $logArray['description'] }}<br>
                                {{ $logArray['ip'] }}<br>
                                {{ $logArray['created_at'] }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">一般方式讀取 properties($log->properties)</h3>
                            </div>
                            <div class="card-body">
                                {{ $log->properties }}<br>
                            </div>
                            <div class="card-footer text-center">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">轉成陣列方式讀取 properties(['attributes'] 與 ['old'] )(可以用foreach拿到key值)</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                @foreach ($logArray['properties']['attributes'] as $key => $val)
                                {{ $key." => ".$val }}<br>
                                @endforeach
                                @if(!empty($logArray['properties']['old']))
                                @foreach ($logArray['properties']['old'] as $key => $val)
                                {{ $key." => ".$val }}<br>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($oldAttributes)
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">(舊資料)轉成陣列方式讀取$oldAttributes</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                @foreach ($oldAttributes as $okey => $oval)
                                {{ $okey." => ".$oval }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">(新資料)轉成陣列方式讀取$attributes</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                @foreach ($attributes as $key => $val)
                                {{ $key." => ".$val }}<br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($oldAttributes)
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">從JavaScript拋過來oldAttributes</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                <div id="data2"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">從JavaScript拋過來attributes</h3>
                                <span class="right badge badge-danger"></span>
                            </div>
                            <div class="card-body">
                                <div id="data"></div>
                            </div>
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

@section('JsValidator')
@endsection

@section('CustomScript')
    <script>
        // 將陣列轉json丟給js
        var data = @json($attributes);
        var old = @json($oldAttributes);
        console.log(data);

        //將原本就是josn資料丟給js
        var data2 = {!! $log->properties !!};
        //將原本就是josn資料轉陣列在轉json丟給js, 與上一個方式一樣
        var data3 = {!! json_encode($log->properties->toarray()) !!};
        console.log(data2);
        console.log(data3);
        data4 = data2['attributes'];
        console.log(data4);

        var fruits = [["id1","apple"],["id2" ,"orange"], ["id3","cherry"]];
        console.log(fruits);
        // data3.forEach(myFunction);

        var data5 = data;
        var data5arr = Object.keys(data5).map(function(_) { return data5[_]; });
        console.log(data5arr)

        var oldarr = Object.keys(old).map(function(_) { return old[_]; });
        console.log(oldarr)

        data5arr.forEach(myFunction);
        function myFunction(item, index) {
            document.getElementById("data").innerHTML += index + ":" + item + "<br>";
        }
        oldarr.forEach(myFunction2);
        function myFunction2(item, index) {
            document.getElementById("data2").innerHTML += index + ":" + item + "<br>";
        }

    </script>
@endsection
