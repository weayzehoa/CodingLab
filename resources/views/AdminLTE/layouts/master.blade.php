<!-- 主樣板 -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminLTE 3 | @yield('title')</title>
    @include('AdminLTE.layouts.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('AdminLTE.layouts.nav')

        @include('AdminLTE.layouts.sidebar')

        @section('content')
        @show

        @include('AdminLTE.layouts.controllsidebar')

        @include('AdminLTE.layouts.footer')
    </div>
    @include('AdminLTE.layouts.js')

    @include('AdminLTE.layouts.script')
    @include('AdminLTE.layouts.script_chartjs')
    @include('AdminLTE.layouts.script_flot')
    @include('AdminLTE.layouts.script_jsgrid')
    @include('AdminLTE.layouts.script_mailbox')
    @include('AdminLTE.layouts.script_modals')
    @include('AdminLTE.layouts.script_ribbons')
    @include('AdminLTE.layouts.script_sliders')
    @include('AdminLTE.layouts.script_validation')

</body>

</html>
