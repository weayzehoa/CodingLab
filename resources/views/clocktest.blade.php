@extends('layouts.master')

@section('title', 'JS Clock 測試')

@section('content')

<div class="content-wrapper">
    <div class="content-wrapper">
        <section class="content">
            <div class="container">
                <div class="container bg-white">
                    <div class="card card-danger card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">JavaScript 時鐘測試</h3>
                            <i class="fas fa-info text-danger"></i> 使用 JavaScript 及 CSS 製作的時鐘。<br>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <p>
                                    說明：數位時鐘, 利用圖片切換的方式顯示時間.<br>
                                </p>
                                <div id="digitalclock">
                                    <div class="dclock">
                                        <div id="dc1" class="dc1"></div>
                                        <div id="dc2" class="dc5"></div>
                                    </div>
                                    <div id="dc7" class="dcc"></div>
                                    <div class="dclock">
                                        <div id="dc3" class="dc1"></div>
                                        <div id="dc4" class="dc5"></div>
                                    </div>
                                    <div id="dc8" class="dcc"></div>
                                    <div class="dclock">
                                        <div id="dc5" class="dc1"></div>
                                        <div id="dc6" class="dc5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                說明：數位時鐘, 直接使用文字方式顯示如下<br><br>
                                <div id="showtime"></div><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <p>
                                    說明：類比時鐘, 程式採用JavaScript方式.<br>
                                    1. 這個時鐘有一個很大的缺點, JavaScript的setTimeout秒數只能使用1秒.<br>
                                    2. 秒針顯現方式每一秒跳6度. 走的方式並不是滑順的.<br>
                                    3. 可改由如右邊的類比時鐘方式.<br>
                                </p>
                                <div class="col-12" id="circle">
                                    <div id="j1"></div>
                                    <div id="j2"></div>
                                    <div id="j3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <p>
                                    說明：類比時鐘, 程式採用PHP+CSS動畫方式. <br>
                                    1. 可以改用此方式, 先利用PHP將目前所有秒,分,時針定位.<br>
                                    2. 帶入CSS的keyframes中, 利用CSS的keyframes動畫來轉動秒,分,時針.<br>
                                    3. 這樣秒針的移動就會平滑的移動.<br>
                                </p>
                                <div class="col-12" id="circle2">
                                    <div id="clock_sec"></div>
                                    <div id="clock_min"></div>
                                    <div id="clock_hour"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
<style>
    #circle, #circle2{
        width:400px;
        height: 400px;
        background-image:url("./img/time/clock.png");
        background-size:100%;
        background-repeat: no-repeat;
        /* border-radius: 250px; 圓腳尺寸為寬及高的一半時,會呈現完整的圓型 */
    }
    #j1, #clock_sec{ /* 秒針 */
        width:10px;
        height:100%;
        background-image:url("./img/time/j1.png");
        background-repeat: no-repeat;
        position:absolute;
        left:50%;   /*定位在框內*/
        top:auto;
        margin: 0 0 0 -5px; /* 調整位置用 */
    }

    #clock_sec{ /* 秒針動畫 */
        animation:clock_sec linear 60s infinite;
    }

    #j2, #clock_min{ /* 分針 */
        width:20px;
        height:100%;
        background-image:url("./img/time/j2.png");
        background-repeat: no-repeat;
        position:absolute;
        left:50%;
        margin: 0 0 0 -10px;
    }

    #clock_min{ /* 分針動畫 */
        animation:clock_min 3600s linear infinite;
    }

    #j3, #clock_hour{ /* 時針 */
        width:30px;
        height:100%;
        background-image:url("./img/time/j3.png");
        background-repeat: no-repeat;
        left:50%;
        position:absolute;
        margin: 0 0 0 -15px;
    }

    #clock_hour{ /* 時針動畫 */
        animation:clock_hour 43200s linear infinite;
    }

    @keyframes clock_sec{
        0%{transform: rotate({{ (6 * date("s")) }}deg);}
        100%{transform: rotate({{ (6 * date("s")) + 360 }}deg);}
    }

    @keyframes clock_min{
        0%{transform: rotate({{ ((date("i")*60 + date("s")) * (360/3600)) }}deg);}
        100%{transform: rotate({{ ((date("i")*60 + date("s")) * (360/3600)) + 360 }}deg);}
    }

    @keyframes clock_hour{
        0%{transform: rotate({{ (((date("H")-12)*3600 + date("i")*60 + date("s"))*(360/43200)) }}deg);}
        100%{transform: rotate({{ (((date("H")-12)*3600 + date("i")*60 + date("s"))*(360/43200)) + 360 }}deg);}
    }

    @keyframes jj{
        0%{transform: rotate(0deg);}
        100%{transform: rotate(360deg);}
    }

    @keyframes jj1{
        0%{transform: rotate(0deg);}
        100%{transform: rotate(360deg);}
    }

    @keyframes jj2{
        0%{transform: rotate(0deg);}
        100%{transform: rotate(360deg);}
    }

    @keyframes jj3{
        0%{transform: rotate(0deg);}
        100%{transform: rotate(360deg);}
    }

    #digitalclock{
        margin:0 auto;
    }
    .dclock{
        display: inline-block;
    }

    #dc1,#dc2,#dc3,#dc4,#dc5,#dc6{
        width:50px;
        height:50px;
        display: inline-block;
        margin: 5px 5px;
    }

    #dc7,#dc8{
        width:25px;
        height:50px;
        display: inline-block;
    }

    .dc0{ background-image: url("img/time/0.png");}
    .dc1{ background-image: url("img/time/1.png");}
    .dc2{ background-image: url("img/time/2.png");}
    .dc3{ background-image: url("img/time/3.png");}
    .dc4{ background-image: url("img/time/4.png");}
    .dc5{ background-image: url("img/time/5.png");}
    .dc6{ background-image: url("img/time/6.png");}
    .dc7{ background-image: url("img/time/7.png");}
    .dc8{ background-image: url("img/time/8.png");}
    .dc9{ background-image: url("img/time/9.png");}
    .dcc{ background-image: url("img/time/00.png");}

</style>
@endsection

@section('script')
{{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
@endsection

@section('CustomScript')
{{-- 這邊放置 Script 程式用 (在頁面下方) --}}
<script>
    function re_time() {
        n_1_a = 0;
        n_2_a = 0;
        n_3_a = 0;
        n_t = new Date();
        n_3 = n_t.getHours(); //抓取小時
        n_2 = n_t.getMinutes(); //抓取分
        n_1 = n_t.getSeconds(); //抓取秒
        n_1_a = (6 * n_1); //秒針目前角度
        n_2_a = (n_2 * 60 + n_1) * (360 / 3600); //分針目前角度
        n_3_a = ((n_3 - 12) * 3600 + n_2 * 60 + n_1) * (360 / 43200) //時針目前角度
        // n_3_a = 30 * (n_3-12) + n_2 * (360 / 43200) + n_1 * (360/3600); //時針目前角度
        document.getElementById("j1").style.transform = "rotate(" + n_1_a + "deg)";
        document.getElementById("j2").style.transform = "rotate(" + n_2_a + "deg)";
        document.getElementById("j3").style.transform = "rotate(" + n_3_a + "deg)";
        setTimeout("re_time()", 100);
    }

    re_time();

    var now_time = new Date(); //設定時間物件 Date( 年,月,日,時,分,秒 ) 不設的話為當前的值
    /*
    .getFullYear() 年
    .getDay() 當週日次 0-6 週日=0
    .getMonth() 月 0 開始 1月=0
    .getDate() 日
    .getHours() 時 0開始 24小時制 0是晚上12點
    .getMinutes() 分 0開始 0-59
    .getSeconds() 秒  0開始 0-59
    .getTime() 回傳從1970年1月1日0點0分0秒至物件時間值的毫秒數
    .getTimezoneOffset() 本機與UTC時間之間差異分鐘數

    Math.floor() 無條件捨去.
    Math.ceil() 無條件進位.
    Math.round() 4捨5入.
    Math.random() 亂數.
    Math.PI 回傳PI值.
    */

    re_dtime();

    function re_dtime() {
        setTimeout("re_dtime()", 1000);
        n_t = new Date();
        n_1 = n_t.getHours(); //抓取小時
        n_2 = n_t.getMinutes(); //抓取分
        n_3 = n_t.getSeconds(); //抓取秒
        n_1_2 = n_1 % 10; //抓取小時的個位數
        n_2_2 = n_2 % 10; //抓取分的個位數
        n_3_2 = n_3 % 10; //抓取秒的個位數
        n_1_1 = Math.floor(n_1 / 10); //抓取小時的十位數
        n_2_1 = Math.floor(n_2 / 10); //抓取分的十位數
        n_3_1 = Math.floor(n_3 / 10); //抓取秒的十位數
        document.getElementById("dc1").className = "dc" + n_1_1;
        document.getElementById("dc2").className = "dc" + n_1_2;
        document.getElementById("dc3").className = "dc" + n_2_1;
        document.getElementById("dc4").className = "dc" + n_2_2;
        document.getElementById("dc5").className = "dc" + n_3_1;
        document.getElementById("dc6").className = "dc" + n_3_2;
        document.getElementById("dc7").style.opacity = 0;
        document.getElementById("dc8").style.opacity = 0;
        setTimeout(function() {
            document.getElementById("dc7").style.opacity = 1;
            document.getElementById("dc8").style.opacity = 1;
        }, 500);
    }


    function ShowTime() {
        var NowDate = new Date();
        var d = NowDate.getDay();
        var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
        document.getElementById('showtime').innerHTML = '目前時間：' + NowDate.toLocaleString() + '（' + dayNames[d] + '）';
        setTimeout('ShowTime()', 1000);
    }
    ShowTime();
</script>
@endsection
