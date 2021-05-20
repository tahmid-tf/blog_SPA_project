<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">

    <div id="app">
        <router-view></router-view>
    </div>
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</html>
