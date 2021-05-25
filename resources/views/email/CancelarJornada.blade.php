<!DOCTYPE html>
<html land="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> ¡Gracias por ser voluntario(a)! </title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/sweetalert2.min.css') }}">    
    <link href="{{ asset('public/css/all.min.css') }}" rel="stylesheet">  
    <style>
        body{
            text-align: center;
        }
        .cancel-button {
            background-color: gray;
            color: #F5F5F5;
        }

        .accept-button{
            color: #F5F5F5;
            background-color: #5BC0DE;
        }

    </style>
    <body>
        <center>
            <img src="http://voluntariado.jalisco.gob.mx/public/assets/images/correo1.png" style="max-width:30%;" />
            <h1 style="color: #00326C; font-size:40px; font-weight: bold;">¡{{ $nombre }} JORNADA CANCELADA!</h1>
        </center>

        <h2 style="color: #67737A; font-size:30px; font-weight: bold;">Mensaje: </h2>
        <h2 style="color: #67737A; font-size:30px; font-weight: bold;"> Le informamos que la jornada de {{ $fecha_inicio }} al {{ $fecha_fin }} en la(s) sede(s)
            @foreach($sedes as $sede){{ $sede->nombre }}, @endforeach()   
            ha sido cancelada. Le invitamos a estar atendo a proximas convocatorias.  
        </h2>

    </body>
    <script src="{{ asset('public/js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('public/js/Chart.min.js') }}"></script>

    <script src="{{ asset('public/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('public/js/all.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('public/js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/js/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('public/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('public/js/sweetalert2.min.js') }}"></script>
    <script>
        
    </script>
</head>
</html>