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

<body class="background-login">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{ asset('public/assets/images/isologo_jalisco_v.svg')}}"
                                alt="jalisco"
                                class="img-fluid mt-1 mb-3 ml-5">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>
                                    <form class="user"  method="POST" action="{{url("/security/authenticate")}}">
                                        @if(Session::get('fail'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('fail') }}
                                            </div>
                                        @endif
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="InputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address...">
                                                <span class="text-danger">@error('email'){{ $message }} @enderror </span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="InputPassword" name="password" placeholder="Password">
                                                <span class="text-danger">@error('password'){{ $message }} @enderror </span>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
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