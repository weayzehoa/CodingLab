@extends('layouts.master')

@section('title', '首頁')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">CodingLab 程式設計測試站台</h3>
                            <i class="fas fa-info text-primary"></i> 此網站主要是用來做 Laravel 程式設計練習及測試用，平常大部分功能都可以正常運作，但也有可能我在做其他試驗時會莫名其妙壞掉。<br>
                            <i class="fas fa-info text-danger"></i> <span class="text-danger">此網站內容來源僅供測試研究用，並非真實完整資料或資訊，請勿以此網站內容當作依據參考，網站內容若有不妥請來信告知移除。</span><br>
                            <i class="fas fa-info text-purple"></i> 版面設計不是我強項，可能有些地方不是很美觀或存在錯版問題，請見諒。<br>
                            <i class="fas fa-info text-info"></i> 前台測試帳號 user@mail.com (可管理所有文章) 密碼 user 或 guest@mail.com (一般訪客) 密碼 guest 使用第三方帳號登入測試 (可能隨時會被清除)<br>
                            <i class="fas fa-info text-info"></i> 後台管理帳號 admin@mail.com 密碼 admin (可任意管理所有資料)
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
                                        <h5><i class="fas fa-info"></i> 程式: Javascript & JQuery</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-info"></i> 後端: PHP & MySQL & Apache</h5>
                                        <h5><i class="fas fa-info"></i> 框架: Laravel Framwork</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h6 class="text-center"><i class="fas fa-info text-primary mr-2"></i>前端 JS 套件</h6>
                                            <ul>
                                                <li>ckeditor</li>
                                                <li>datatables</li>
                                                <li>fontawesome</li>
                                                <li>icheck-bootstrap</li>
                                                <li>jquery-mousewheel</li>
                                                <li>jquery-Timepicker</li>
                                                <li>jquery-ui</li>
                                                <li>overlayScrollbars</li>
                                                <li>particles.js</li>
                                                <li>select2</li>
                                                <li>ekko-lightbox</li>
                                                <li>WoW.js</li>
                                                <li>animate.css</li>
                                                <li>Leaflet.js for OpenStreetMap</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h6 class="text-center"><i class="fas fa-info text-danger mr-2"></i> Laravel 後端套件</h6>
                                            <ul>
                                                <li>ARCANEDEV/noCAPTCHA - Google 驗證器</li>
                                                <li>mews/captcha - 圖形驗證</li>
                                                <li>gregwar/captcha - 圖形驗證</li>
                                                <li>barryvdh/laravel-debugbar - 除錯 Bar</li>
                                                <li>proengsoft/laravel-jsvalidation - 共用驗證</li>
                                                <li>laravel-activitylog - 紀錄用戶行為</li>
                                                <li>laravel/socialite - 第三方登入</li>
                                                <li>ixudra/curl - Curl 套件</li>
                                                <li>simplesoftwareio/simple-qrcode - QrCode 套件</li>
                                                <li>laravel/excel - 匯入匯出 試算表 套件</li>
                                                <li>bmatovu/laravel-xml (v1.0 for Laravel6)- 匯入匯出 XML 套件</li>
                                                <li>ottaviano/faker-gravatar - 隨機 Gravatar 套件</li>
                                            </ul>
                                        </div>
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
                                    <b><span id="showtime"></span></b>
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
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">我的筆記</h3>
                            <hr>
                            <div class="text-center">
                                {!! QrCode::size(100)->color(255, 0, 0)->generate('https://roger.rvt.idv.tw'); !!}
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">本站 QrCode</h3>
                            <hr>
                            <div class="text-center">
                                {{ $qrCode }}
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
@endsection

@section('script')
@endsection

@section('CustomScript')
<script>
    ShowTime();
    //顯示今日日期及時間
    function ShowTime() {
        var NowDate = new Date();
        var d = NowDate.getDay();
        var NowTime = new Date();
        var NowHour = NowTime.getHours();
        var NowMin = NowTime.getMinutes();
        var NowSec = NowTime.getSeconds();
        MyTime = ('0' + NowDate.getHours()).slice(-2) + ':' + ('0' + NowDate.getMinutes()).slice(-2) + ':' + ('0' + NowDate.getSeconds()).slice(-2);
        // var NowNow = NowDate.toLocaleString();
        var NowNow = '現在時間: ' + MyTime;
        var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
        document.getElementById('showtime').innerHTML = NowNow + '（' + dayNames[d] + '）';
        setTimeout('ShowTime()', 1000);
    }
</script>
@endsection
