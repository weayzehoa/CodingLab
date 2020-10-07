@extends('layouts.master')

@section('title', '首頁')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">首頁</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">CodingLab</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('index') }}">首頁</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">CodingLab 程式設計測試站台</h3>
                            <i class="fas fa-info text-danger"></i> 此網站是我用來做程式設計練習及測試用，平常大部分功能都可以正常運作，但也有可能我在做其他試驗時會莫名其妙壞掉，請見諒。
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card card-primary card-outline">
                        <h3 class="profile-username text-center">主要使用技術</h3>
                        <div class="card-body box-profile">
                            <div class="row">
                                <div class="col-6">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info"></i> 前端: HTML & CSS & Bootstrap</h5>
                                        <h5><i class="fas fa-info"></i> 程式: Javascript & Query</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info"></i> 後端: PHP & MySQL & Apache</h5>
                                        <h5><i class="fas fa-info"></i> 框架: Laravel Framwork</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center"><i class="fas fa-info"></i>nformation</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b><span  id="showtime" ></span></b>
                                </li>
                                <li class="list-group-item">
                                    <b>你目前的 IP 位置: </b>{{ $_SERVER['REMOTE_ADDR'] }}
                                </li>
                                <li class="list-group-item">
                                    <b>你的瀏覽器資訊: </b><br>{{ $_SERVER['HTTP_USER_AGENT'] }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('CustomScript')
<script>
    ShowTime();
    //顯示今日日期及時間
    function ShowTime()
    {
    var NowDate = new Date();
    var d = NowDate.getDay();
    var NowTime = new Date();
    var NowHour = NowTime.getHours();
    var NowMin = NowTime.getMinutes();
    var NowSec = NowTime.getSeconds();
    var NowNow = '現在時間: '+NowHour+':'+NowMin+':'+NowSec;
    // var NowNow = NowDate.toLocaleString();
    var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
    document.getElementById('showtime').innerHTML = NowNow + '（'+dayNames[d]+'）';
    setTimeout('ShowTime()', 1000);
    }
</script>
@endsection
