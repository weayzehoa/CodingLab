<!-- 主樣板 -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodingLab管理系統 - @yield('title')</title>
    @include('admin.layouts.css')
    @include('admin.layouts.js')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('admin.layouts.topbar')

        @include('admin.layouts.sidebar')

        @section('content')
        @show

        @include('admin.layouts.footer')
    </div>
    <script src="{{ url('dist/js/custom.js') }}"></script>
</body>

</html>
