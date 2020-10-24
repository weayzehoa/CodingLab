@extends('layouts.master')

@section('title', 'Google Map')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="container bg-white">
                <div class="card card-danger card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">Google Map</h3>
                        <i class="fas fa-info text-danger"></i>使用 Google API 及 Google Map 相關工具產生地圖資訊。<br>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        {{-- 這邊開始放置 內容頁面 --}}
                        <div class="row">
                            <div id="map" class="col-6 mb-3"></div>
                            <div id="map2" class="col-6">
                                <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLEMAP_API_KEY') }}&q=Space+Needle,Seattle+WA" allowfullscreen></iframe>
                            </div>
                            <div id="map3" class="col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
<style>
    #map {
        height: 300px;
    }
    #map2 {
        height: 300px;
    }
    #map3 {
        height: 300px;
    }
</style>
@endsection

@section('script')
    {{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLEMAP_API_KEY') }}&callback=initMap&libraries=&v=weekly" defer></script>
@endsection

@section('CustomScript')
    {{-- 這邊放置 Script 程式用 (在頁面下方) --}}
    <script>
        let map;
        let map2;
        let map3;
        let map4;
        function initMap() {
            const tpzoo = { lat: 24.999735, lng: 121.581389 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: tpzoo,
            });
            const marker = new google.maps.Marker({
                position: tpzoo,
                map: map,
            });
            const map3 = new google.maps.Map(document.getElementById("map3"), {
                center: { lat: 25.033845, lng: 121.564530 },
                zoom: 18,
                mapTypeId: "satellite",
                heading: 90,
                tilt: 45,
            });
        }
        function rotate90() {
            const heading = map3.getHeading() || 0;
            map3.setHeading(heading + 90);
            }

            function autoRotate() {
            // Determine if we're showing aerial imagery.
            if (map3.getTilt() !== 0) {
                window.setInterval(rotate90, 3000);
            }
        }
    </script>
@endsection
