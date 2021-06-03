<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/sweetalert2.min.css') }}">
</head>

<style type="text/css">
        @font-face {
            font-family: nutmeg-bold;
            src: url("{{ asset('public/assets/fonts/Nutmeg-Bold.ttf')}}");
            font-weight: bold;
        }

        @font-face {
            font-family: montserrat;
            src: url("{{ asset('public/assets/fonts/Montserrat-Regular.ttf')}}");
        }

        #button-largo{
            width: 184px;
            font-family: montserrat;
            font-weight: bold;
        }

        .botonEnviar{
            margin-right: 16px;
            width: 184px;
            font-family: montserrat;
            font-weight: bold;
            
        }

        .botonEnviar2{
            margin-right: 16px;
            font-family: montserrat;
            font-weight: bold;
            
        }

        h1{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 40px;
            margin-top: -20px;
            margin-bottom: 40px;
            color: #67737A;
        }

        h5{
            font-family: nutmeg-bold;
            color: #67737A;
        }
        
        label{
            font-family: montserrat;
            color: #67737A;
        }
        
        input{
            font-family: montserrat;
            width: 500px;
            color: #67737A;
        }

        a{
            font-family: montserrat;
        }
        #logo{
           
            width: 95%;
            padding-top:20px;
        }
</style>

<body class="background-login" style="background-image: url('{{ asset('public/assets/images/FondoLogin.png')}}');">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 15vh;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-sm" style="padding-top: 30px; background-color: #F8F9FC; width: 100%;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="form-group">
                                        <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Ingresa tu correo electrónico para buscar tu cuenta.</h5>
                                    </div>
                                    <!-- <form class="user"  method="POST" action="{{url('/security/authenticate')}}"> -->
                                        @if(Session::get('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('fail') }}
                                            </div>
                                        @endif
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                id="InputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Correo electrónico">
                                                <span class="text-danger">@error('email') Ingresa tu correo @enderror </span>
                                        </div>
                                    
                                        <center>
                                            <button type="submit" class="btn btn-success" style="font-family: montserrat; font-weight: bold; font-size: 15px; width:184px;" id="enviarCorreo">
                                                Buscar
                                            </button>
                                            <a class="btn btn-secondary" id="boton" style="color:white; font-family: montserrat; font-weight: bold; font-size: 15px; width:184px;" href="{{route('login')}}">Cancelar</a></button>
                                        </center>
                                    <!-- </form> -->
                                </div>
                            </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('public/assets/js/sb-admin-2.min.js') }}"></script>

        <script src="{{ asset('public/assets/js/all.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/fontawesome.min.js') }}"></script>
</body>

</html>

<script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
<script src="{{ asset('public/assets/js/sweetalert2.min.js') }}"></script>
<script>
    function makeid(length) {
        var result           = [];
        var characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
        }
        return result.join('');
    }

        /**
        * Método para el envio de contraseña nueva y mensaje si se envio el correo correctamente
        */
        $('#enviarCorreo').on('click', () => {

            if(document.getElementById("InputEmail").value !== null){
                enviarCorreo(); 
            }
            
        });

        /**
        * Método Método para el envio de contraseña nueva al correo
         */
        function enviarCorreo(){
            $.ajax({
                url: "sendPassword/" + document.getElementById("InputEmail").value + "/" + makeid(5),
                type: "GET",
                beforeSend: () => {
                    Swal.fire({
                        showConfirmButton: false,
                        imageUrl: "{{ asset('public/assets/images/loading.png') }}",
                        title: 'Por favor espere.',
                        text: 'enviando correo',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });  
                },
                success: function (response) {
                    //console.log(response);
                    $('#modalEditarHoras').modal('hide');
                    if(response.isOk == true){
                        Swal.fire({
                        title: '¡Contraseña recuperada!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = "{{route('login')}}";
                            }
                        });
                    }else{
                        Swal.fire({
                            title: '¡Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                            });
                    }
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }
    //console.log(makeid(5));
</script>

