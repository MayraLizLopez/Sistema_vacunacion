<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('tittle')</title>
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/site.css') }}">
        <link rel="stylesheet" href="{{asset('public/assets/css/sb-admin-2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/sweetalert2.min.css') }}">    
        <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">  
    </head>
    <body>
        <div class="container-fluid">                   
            @yield('content')
        </div>
        <script src="{{ asset('public/assets/js/jquery.slim.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('public/assets/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('public/assets/js/Chart.min.js') }}"></script>

        <script src="{{ asset('public/assets//js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/all.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('public/assets/js/chart-area-demo.js') }}"></script>
        <script src="{{ asset('public/assets/js/chart-pie-demo.js') }}"></script>
        <script src="{{ asset('public/assets/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/sweetalert2.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>   