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
                        <div class="row">
                            <div class="col-lg-4 d-none d-lg-block">
                                <img id="logo" src="{{ asset('public/assets/images/isologo_jalisco_v.svg')}}"
                                alt="jalisco"
                                class="img-fluid mt-1 mb-3 ml-5">
                            </div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1>¡Bienvenido!</h1>
                                    </div>
                                    <form class="user"  method="POST" action="{{url('/security/authenticate')}}">
                                        @if(Session::get('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('fail') }}
                                            </div>
                                        @endif
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                id="InputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Email">
                                                <span class="text-danger">@error('email') Ingresa tu correo @enderror </span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                id="InputPassword" name="password" placeholder="Contraseña"> 
                                                <img class="ojo" onclick="mostrar()" src="{{ asset('public/assets/images/ojo.svg')}}" style="width: 25px; float: right; margin-left: -65px !important; margin-right: 15px; margin-top: -27px; position: relative; z-index: 2;"/>
                                                <span class="text-danger">@error('password') Ingresa una contraseña @enderror </span>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"> 
                                                <label class="custom-control-label" for="customCheck">Recordar mis datos</label>
                                            </div>
                                        </div>
                                        <center>
                                            <button type="submit" class="btn btn-success" style="font-family: montserrat; font-weight: bold; font-size: 15px; width:184px;">
                                                Entrar
                                            </button>
                                        </center>
                                    </form>
                                </div>
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
<script>
    function mostrar() {
        var checkBox = document.getElementById("InputPassword");
        if (checkBox.type == "password"){
            document.getElementById("InputPassword").type = "text";
        } else {
            document.getElementById("InputPassword").type = "password";
        }
    }
</script>
