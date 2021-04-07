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
        .accept-button {
            background-color: #5BC0DE;
            font-family: 'Neo Sans Pro Bold', sans-serif;
            margin-top: 25px;
            font-size: 43px;
            width: 450px;
            height: 95px;
            color: #F5F5F5;
            border: 2px solid #5BC0DE;
            border-radius: 18px; }
            .accept-button:active {
                background-color: #707070;
                box-shadow: none; 
        }

        a{
            font-family: 'Neo Sans Pro Bold', sans-serif;
            color: #F5F5F5;
            font-size: 43px;
        }

    </style>
    <body>
        <h1>¡{{ $nombre }} Gracias por registrarte como Voluntario(a)!</h1>
        <h2>¡Confirma tu correo electrónico!</h2>
        <h3>Para continuar el proceso por favor da click en el botón para confirmar tu dirección de email. </h3>
        <button id="accept-button" type="button" class="btn btn-primary" data-dismiss="modal" ><a href="http://localhost:8080/sistema_vacunacion/public/emailVoluntario/{{$id}}">Confirmar email</a></button>
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