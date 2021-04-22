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
        .accept-button {
            background-color: #5BC0DE;
        }

        a{
            color: #F5F5F5;
        }

    </style>
    <body>
        <h1>¡{{ $nombre }} Gracias por registrarte como Voluntario(a)!</h1>
        <h2>¡Confirma tu correo electrónico!</h2>
        <h3>Para continuar el proceso por favor da click en el botón para confirmar tu dirección de email. </h3>
        <button id="accept-button" type="button" class="btn btn-primary" data-dismiss="modal" ><a href="http://localhost/:8080/sistema_vacunacion/public/emailVoluntario/{{$id}}">Confirmar email</a></button>
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
</head>
</html>