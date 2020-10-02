<!-- 主樣板 -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MyBlog - @yield('title')</title>
	@include('partials.head')
    <style>
        body{
            font-family: '微軟正黑體';
        }
        .navbar-shadow{
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.09);
        }
    </style>
</head>
<body>
	@include('partials.nav')
	<main style="margin-top: 70px;">
        <div class="container">
            @section('content')
            @show
        </div>
	</main>
</body>
</html>
