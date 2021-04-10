<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('tittle')</title>
        <link rel="stylesheet" href="{{ url("../resources/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ url("../resources/css/site.css") }}">
        <link rel="stylesheet" href="{{ url("../resources/css/sb-admin-2.min.css") }}">
        <link rel="stylesheet" href="{{ url("../resources/css/sweetalert2.min.css") }}">    
        <link href="{{ url("../resources/css/all.min.css") }}" rel="stylesheet"> 
    </head>
    <body style="background-color: gray;">
        @yield('content')
        <script src="{{ url("../resources/js/jquery.slim.min.js") }}"></script>
        <script src="{{ url("../resources/js/bootstrap.min.js") }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ url("../resources/js/jquery.easing.min.js") }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ url("../resources/js/sb-admin-2.min.js") }}"></script>

        <!-- Page level plugins -->
        <script src="{{ url("../resources/js/Chart.min.js") }}"></script>

        <script src="{{ url("../resources/js/fontawesome.min.js") }}"></script>
        <script src="{{ url("../resources/js/all.min.js") }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ url("../resources/js/chart-area-demo.js") }}"></script>
        <script src="{{ url("../resources/js/chart-pie-demo.js") }}"></script>
        <script src="{{ url("../resources/js/fontawesome.min.js") }}"></script>
        <script src="{{ url("../resources/js/sweetalert2.min.js") }}"></script>
        <script src="{{ url("../resources/js/jquery.mask.min.js") }}"></script>   
        @yield('scripts')
    </body>
</html>