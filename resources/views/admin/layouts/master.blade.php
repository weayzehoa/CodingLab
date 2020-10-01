<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
{{-- 使用 @yied() 方式，有需要再載入，節省資料傳輸加快速度 --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CodingLab管理系統 - @yield('title')</title>
    @include('admin.layouts.css')
    @yield('css')

    @include('admin.layouts.js')
    @yield('script')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('admin.layouts.topbar')

        @include('admin.layouts.sidebar')

        @section('content')
        @show

        @include('admin.layouts.footer')
    </div>

    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- 頁面上有需要使用 JsValidator 時才載入 --}}
    @yield('JsValidator')
    @yield('CustomScript')

</body>

</html>
