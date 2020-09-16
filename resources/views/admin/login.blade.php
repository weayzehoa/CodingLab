<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=anonymous>
    <title>Admin</title>
</head>

<body>
    <div>
        <div>
            <div></div>
            <div>
                <div>
                    <div>
                        <form id="sign_in_adm" method="POST" action="{{ route('admin.login.submit') }}">
                            {{ csrf_field() }}
                            <h1>Admin Login</h1>
                            <div>
                                <input type=email name=email placeholder="Email Address" value="{{ old('email') }}"
                                    required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                            <br>
                            <div>
                                <input type=password name=password placeholder="Password" required>
                            </div>
                            <br>
                            <div>
                                <button type=submit>SIGN IN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </div>
</body>

</html>
