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
            <h1 style="color: #00326C; font-size:40px; font-weight: bold;">¡{{ $nombre }} Felicidades has sido seleccionado(a) como voluntario(a) para una jornada!</h1>
        </center>
        <h2 style="color: #67737A; font-size:30px; font-weight: bold;">La jornada se realizará del día <a style="color: #54A583; font-size:30px; font-weight: bold;">{{ $fecha_inicio }}</a> al <a style="color: #54A583; font-size:30px; font-weight: bold;">{{ $fecha_fin }} </a>
        <h2 style="color: #67737A; font-size:30px; font-weight: bold;">Mensaje: </h2>
        <h2 style="color: #67737A; font-size:30px; font-weight: bold;">{{ $mensaje }} </h2>
        <p style="color: #67737A; font-size:24px;">Para continuar el proceso por favor da click en el botón "Aceptar" para confirmar tu participación en la sede de tu preferencia, una vez seleccionada la sede podras elegir entre participar en el turno <b>completo</b>, <b>matutino</b> o <b>vespertino</b>.  Si no puedes participar por favor da click en "Rechazar". </p>
        <p style="color: #67737A; font-size:24px;">Si por error fuiste seleccionado para una jornada que no es en tu municipio, por favor ignora este correo.</p>
        
        <center>
            @foreach($sedes as $sede)
            <div class="card border-secondary mb-3" style="border: 3px solid #54A583; border-radius: 20px; width: 800px;">
                <div class="card-header" style="color:#54A583; font-weight: bold; font-size: 24px; margin-top: 15px;">{{ $sede->nombre }}</div>
                
                <div class="card-body text-secondary" >
                    <!-- <h5 class="card-title">Secondary card title</h5> -->
                    <p class="card-text" style="color: #7B868C; font-size: 24px;">{{ $sede->direccion }} 
                    @if(!($sede->colonia == null))
                        colonia {{ $sede->colonia }}
                    @endif
                    </p>
                    <div style="padding-bottom: 20px;">
                        <!-- Servidor Jalisco -->
                        <a style="color: #ffffff; background-color: #54A583; margin-top: 25px; font-size: 24px; border: 2px solid #54A583; border-radius: 10px; text-decoration: none; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://voluntariado.jalisco.gob.mx/emailAceptar/{{$sede->uuid}}">Aceptar</a>        
                        <!-- Seridor Local -->
                        <!-- <a style="color: #ffffff; background-color: #54A583; margin-top: 25px; font-size: 24px; border: 2px solid #54A583; border-radius: 10px; text-decoration: none; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://187.188.251.138/Sistema_vacunacion/emailAceptar/{{$sede->uuid}}">Aceptar</a>      -->
                        <!-- Local  -->
                        <!-- {{-- <a style="color: #ffffff; background-color: #54A583; margin-top: 25px; font-size: 24px; border: 2px solid #54A583; border-radius: 10px; text-decoration: none; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://localhost:8888/sistema_vacunacion/emailAceptar/{{$sede->uuid}}">Aceptar</a> --}} -->

                        {{-- Local Jaime --}}
                         <!-- <a style="color: #ffffff; background-color: #54A583; margin-top: 25px; font-size: 24px; border: 2px solid #54A583; border-radius: 10px; text-decoration: none; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://localhost:8080/projects/Sistema_vacunacion/emailAceptar/{{$sede->uuid}}">Aceptar</a> -->
                    </div>
                </div>
            </div>
            <div class="mb-3" style="margin-top: 35px;"></div>
            <p></p>
            @endforeach()
            <object
            data="data:text/plain;base64,MTIzNA=="type="text/plain" width="100%" height="600px"></object>
            <!-- <a id='documento' title="Descargar"></a> -->
            <!-- <a style="color: #F5F5F5; background-color: #5BC0DE; margin-top: 25px; font-size: 20px; border: 2px solid #5BC0DE; border-radius: 5px;" href="http://localhost:8080/sistema_vacunacion/public/emailAceptar/{{$uuid}}">Aceptar</a> -->
            <div style="padding-bottom: 20px;">
                <!-- Servidor Jalisco -->
                <a style="margin-top: 50px; color: #ffffff; background-color: #7B868C; font-size: 24px; border: 2px solid #7B868C; border-radius: 10px; text-decoration: none; width: 800px; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://voluntariado.jalisco.gob.mx/emailRechazar/{{$uuid}}">Rechazar todos</a>
                <!-- Seridor Local -->
                <!-- <a style="margin-top: 50px; color: #ffffff; background-color: #7B868C; font-size: 24px; border: 2px solid #7B868C; border-radius: 10px; text-decoration: none; width: 800px; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://187.188.251.138/Sistema_vacunacion/emailRechazar/{{$uuid}}">Rechazar todos</a> -->
                <!-- Local  -->
                <!-- <a style="margin-top: 50px; color: #ffffff; background-color: #7B868C; font-size: 24px; border: 2px solid #7B868C; border-radius: 10px; text-decoration: none; width: 800px; margin-bottom:45px; padding-top: 5px; padding-bottom: 5px; padding-left: 85px; padding-right: 85px;" href="http://localhost:8888/sistema_vacunacion/emailRechazar/{{$uuid}}">Rechazar todos</a> -->
            </div>
            <br>
            <img src="http://voluntariado.jalisco.gob.mx/public/assets/images/correo2.png" style="max-width:30%; margin-top: 25px;" />
        </center>

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