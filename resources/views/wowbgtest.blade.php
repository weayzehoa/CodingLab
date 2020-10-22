@extends('layouts.master')

@section('title', '空白頁面')

@section('content')
<div class="fog">
    <div class="fixedbg"></div>
    <div class="fog_container">
    <div id="particles-js"></div>
        <div class="fog_img"></div>
    </div>
    <div class="mountain"></div>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
{{-- Animate CSS --}}
<link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.min.css') }}">
<style>
    .fixedbg {
        height: 101%;
        width: 101%;
        background:url(./img/bg.jpg);
        background-position: 50%;
        background-repeat: no-repeat;
        background-size: 102%;
        overflow: hidden;
        position: fixed;
        top: 0;
        left: -20px;
    }

     /* Fog */
    .fog {
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
    }

    .fog_container {
        position: fixed;
        height: 100%;
        width: 100%;
        overflow: hidden;
      }

    .fog_img {
        height: 100vh;
        width: 300vw;
        background: url(./img/fog.png) repeat-x;
        background-size: contain;
        background-position: center;
        animation: marquee 60s linear infinite;
        z-index: -100;
    }

    /* Mountain */
    .mountain{
        width:102%;
        height:102%;
        background:url(./img/mountain2.png) bottom center;
        background-size:102%;
        position:fixed;
        background-repeat: no-repeat;
    }

     /* Marquee */
    @keyframes marquee {
        0% { transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-100vw, 0, 0); }
    }

    </style>
@endsection

@section('script')
    {{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
    {{-- WOW.js animate --}}
    <script src="{{ asset('vendor/wow/dist/wow.min.js') }}"></script>
@endsection

@section('CustomScript')
    {{-- 這邊放置 Script 程式用 (在頁面下方) --}}
    <script>
        (function($){

            // new WOW().init(); 使用預設值 或 使用下方參數方式 來啟動 WOW.JS
            wow = new WOW({
                boxClass:     'wow',      // default
                animateClass: 'animated', // default
                offset:       0,          // default
                mobile:       false,       // default is true
                live:         true,       // default
            })
            wow.init();

            $("body").on("mousemove",function(e){
                var offsetX=e.clientX/100;
                var offsetY=e.clientY/100;
                $(".fixedbg").css({"transform":"translate("+offsetX+"px,"+offsetY+"px)"});
                $(".mountain").css({"transform":"translate(-"+offsetX+"px,-"+offsetY+"px)"});
            });

        })($)
    </script>
@endsection