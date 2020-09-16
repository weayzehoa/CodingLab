<!-- 主樣板 -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodingLab管理系統 - @yield('title')</title>
    @include('admin.layouts.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        @include('admin.layouts.nav')

        @include('admin.layouts.sidebar')

        @section('content')
        @show

        @include('admin.layouts.footer')
    </div>
    <!-- ./wrapper -->

    @include('admin.layouts.js')
</body>

</html>
