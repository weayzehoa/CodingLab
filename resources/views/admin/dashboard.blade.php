<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin=anonymous>
    <title>Admin Dashboard</title>
</head>

<body>
    <div>
        <div>
            <div></div>
            <div>
                <div>
                    <div>
                        <h1>Welcome To Admin Dashboard</h1>
                    </div>
                </div>
                <br><br>
                登入帳號: {{ $adminuser->email }}
                <br><br>
                <a href="/admin/logout">Logout</a>
            </div>
            <div></div>
        </div>
    </div>
</body>

</html>
