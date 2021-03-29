<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('tittle')</title>
        <link rel="stylesheet" href="{{ url("../resources/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ url("../resources/css/site.css") }}">
    </head>
    <body>
        @yield('content')
        <script src="{{ url("../resources/js/jquery.slim.min.js") }}"></script>
        <script src="{{ url("../resources/js/bootstrap.min.js") }}"></script>
    </body>
</html>