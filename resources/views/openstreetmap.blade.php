@extends('layouts.master')

@section('title', 'Open Street Map')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="container bg-white">
                <div class="card card-danger card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">Open Street Map</h3>
                        <i class="fas fa-info text-danger"></i>使用 Leaflet.js for OpenStreetMap 套件並搭配 Open Street Map 地圖<br>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
    {{-- OpenStreetMap 及 Leaflet CSS --}}
    <link rel="stylesheet" href="{{ url('vendor/Leaflet/dist/leaflet.css') }}"/>
    <link rel="stylesheet" href="{{ url('vendor/Leaflet/dist/Control.FullScreen.css') }}"/>
    <style>
        #map {
            height: 600px;
        }
    </style>
@endsection

@section('script')
    {{-- OpenStreetMap 及 Leaflet JS --}}
    <script src="{{ url('vendor/Leaflet/dist/leaflet.js') }}"></script>
    <script src="{{ url('vendor/Leaflet/dist/Control.FullScreen.js') }}"></script>

@endsection

@section('CustomScript')
    {{-- 這邊放置 Script 程式用 (在頁面下方) --}}
    <script>
        $(function() {
            //宣告OpenStreetMap
            var map;
            //載入中心點位置
            map = L.map('map', {
                //關閉滾輪放大縮小
                // scrollWheelZoom:false,
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'bottomright',
                    title: '全螢幕模式', // change the title of the button, default Full Screen
                    titleCancel: '離開全螢幕模式', // change the title of the button when fullscreen is on, default Exit Full Screen
                    // forceSeparateButton: true, // force seperate button to detach from zoom buttons, default false
                },
            }).setView([24.999735 , 121.581389], 15);
            //以該公園為中心點
            var marker = L.marker([24.999735, 121.581389]);
            marker.addTo(map).bindPopup('<span style="color:blue">台北市立動物園</span>').openPopup();
            //Leaflet與OpenStreetMap版權及Zoomin,Zoomout大小
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18, //最大Zoom
                minZoom: 12, //最小Zoom
            }).addTo(map);
            // setTimeout(function(){ map.invalidateSize()}, 500);
            // map.invalidateSize();
        });
    </script>
@endsection
