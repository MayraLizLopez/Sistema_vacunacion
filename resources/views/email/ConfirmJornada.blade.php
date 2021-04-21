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
        <h2>Para continuar el proceso por favor da click en el botón "Aceptar" para confirmar tu participación en la sede de tu preferencia. Si no puedes participar por favor da click en "Rechazar". </h2>
        @foreach($sedes as $sede)
        <div class="card border-secondary mb-3" style="max-width: 18rem; border: 3px solid #2756B1; border-radius: 5px;">
            <div class="card-header">{{ $sede->nombre }}</div>
            <hr style="color:#2756B1">
            <div class="card-body text-secondary">
                <!-- <h5 class="card-title">Secondary card title</h5> -->
                <p class="card-text">{{ $sede->direccion }}</p>
                <div class="mb-3">
                    <a style="color: #ffffff; background-color: #54A583; margin-top: 25px; font-size: 20px; border: 2px solid #54A583; border-radius: 5px;" href="http://localhost:8080/sistema_vacunacion/public/emailAceptar/{{$sede->uuid}}">Aceptar</a>        
                </div>
            </div>
        </div>
        <div class="mb-3" style="margin-top: 35px;"></div>
        <p></p>
        @endforeach()


        <!-- <a style="color: #F5F5F5; background-color: #5BC0DE; margin-top: 25px; font-size: 20px; border: 2px solid #5BC0DE; border-radius: 5px;" href="http://localhost:8080/sistema_vacunacion/public/emailAceptar/{{$uuid}}">Aceptar</a> -->
        <div class="mb-3" style="margin-top: 35px;"></div>
        <p></p>
        <a style="color: #ffffff; background-color: gray; margin-top: 25px; font-size: 20px; border: 2px solid #6A7379; border-radius: 5px;" href="http://localhost:8080ñ/sistema_vacunacion/public/emailRechazar/{{$uuid}}">Rechazar</a>
        
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