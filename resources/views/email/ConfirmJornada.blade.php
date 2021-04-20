<!DOCTYPE html>
<html land="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> ¡Gracias por ser voluntario(a)! </title>
    <link rel="stylesheet" href="{{ url("../resources/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ url("../resources/css/site.css") }}">
    <link rel="stylesheet" href="{{ url("../resources/css/sb-admin-2.min.css") }}">
    <link rel="stylesheet" href="{{ url("../resources/css/sweetalert2.min.css") }}">    
    <link href="{{ url("../resources/css/all.min.css") }}" rel="stylesheet">  
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
        <h1>¡{{ $nombre }} Felicidades has sido seleccionado(a) como voluntario(a) para una jornada!</h1>
        <h2>Mensaje: {{ $mensaje }} </h2>
        <h2>Para continuar el proceso por favor da click en el botón "Aceptar" para confirmar tu participación. Si no puedes participar por favor da click en "Rechazar". </h2>
        <!-- <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: #5BC0DE;"><a style="color: #F5F5F5;" href="http://192.168.0.20/sistema_vacunacion/public/emailAceptar/{{$uuid}}">Aceptar</a></button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: gray;"><a style="color: #F5F5F5;" href="http://192.168.0.20/sistema_vacunacion/public/emailRechazar/{{$uuid}}">Rechazar</a></button> -->

        <a style="color: #F5F5F5; background-color: #5BC0DE; margin-top: 25px; font-size: 20px; border: 2px solid #5BC0DE; border-radius: 18px;" href="http://localhost:8080/sistema_vacunacion/public/emailAceptar/{{$uuid}}">Aceptar</a>

        <a style="color: #F5F5F5; background-color: gray; margin-top: 25px; font-size: 20px; border: 2px solid #5BC0DE; border-radius: 18px;" href="http://localhost:8080/sistema_vacunacion/public/emailRechazar/{{$uuid}}">Rechazar</a>
        
    </body>
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
</head>
</html>