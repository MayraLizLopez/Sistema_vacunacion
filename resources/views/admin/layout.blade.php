<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Panel de control - Vacunación</title>

        <!-- Custom fonts for this template-->
        <link href="{{ asset('public/assets/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/assets/css/all.min.css') }}" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/sb-admin-2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/site.css') }}">
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

            @font-face {
                font-family: montserrat-bold;
                src: url("{{ asset('public/assets/fonts/Montserrat-Regular.ttf')}}");
                font-weight: bold;
            }

            /* #menu:hover {
                color: #2756B1;
                border: 2px solid #2756B1;
                border-radius: 50px;
            }
            #menu:focus {
                color: #2756B1;
                border: 3px solid #2756B1;
                border-radius: 50px;
            } */
            #menu {
                color: #0B55B8;     
            }  
        </style>
        @yield('css')    
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/admin/panel/index')}}">
                    <div class="col-auto">
                        <img src="{{ asset('public/assets/images/jeringa.svg')}}" style="width: 35px;"/>
                    </div>
                    <div class="sidebar-brand-text font-weight-bold" style="color:#54A583; font-size: 45px; font-family:nutmeg-bold; " >SVG</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a id="menu" class="nav-link" id="inicio" href="{{url('/admin/panel/index')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/index.svg')}}" style="width: 23px;"/>
                        <span style="font-family: nutmeg-bold; font-size:18px;">Inicio</span></a>
                        
                </li>

                
                @if ($LoggedUserInfo['rol'] == 'Administrador General')
                    <!-- Voluntarios -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('/admin/panel/show')}}">                           
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_voluntarios.svg')}}" style="width: 25px;"/>
                        <span  style="font-family: nutmeg-bold; font-size:18px;">Voluntarios</span></a>
                    </li>

                    <!-- Instituciones -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('/admin/panel/institutions')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_instituciones.svg')}}" style="width: 20px;"/>
                        <span  style="font-family: nutmeg-bold; font-size:18px;">Instituciones</span></a>
                    </li>

                    <!-- Jornadas -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('/admin/panel/vaccinationDay')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_jornadas.svg')}}" style="width: 20px;"/>
                        <span  style="font-family: nutmeg-bold; font-size:18px;">Jornadas</span></a>
                    </li>

                    <!-- Divider -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('admin/panel/users/index')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_usuarios.svg')}}" style="width: 20px;"/>
                        <span style="font-family: nutmeg-bold; font-size:20px;">Usuarios</span></a>
                    </li>

                    <!-- Sedes -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('admin/panel/sedes/index')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_centros.svg')}}" style="width: 20px;"/>
                        <span  style="font-family: nutmeg-bold; font-size:18px;">Centros</span></a>
                    </li>
                @else
                    <!-- Divider -->
                    {{-- <hr class="sidebar-divider my-0"> --}}
                    <li class="nav-item active">
                        <a id="menu" class="nav-link" href="{{url('/admin/panel/show')}}">
                        <img class="mx-2" src="{{ asset('public/assets/images/menu_voluntarios.svg')}}" style="width: 25px;"/>
                        <span   style="font-family: nutmeg-bold; font-size:18px;">Voluntarios</span></a>
                    </li>                 
                @endif

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"> </button>   
                </div>

            </ul>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a> -->
                                <!-- Dropdown - Messages -->
                                <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div> -->
                            <!-- </li> -->

                            <!-- Nav Item - Alerts -->
                            <!-- <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i> -->
                                    <!-- Counter - Alerts -->
                                    <!-- <span class="badge badge-danger badge-counter">3+</span>
                                </a> -->
                                <!-- Dropdown - Alerts -->
                                <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </li> -->

                            <!-- Nav Item - Messages -->
                            <!-- <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i> -->
                                    <!-- Counter - Messages -->
                                    <!-- <span class="badge badge-danger badge-counter">7</span>
                                </a> -->
                                <!-- Dropdown - Messages -->
                                <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                                alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                                problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                                alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how
                                                would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                                alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                                the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                                told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div> -->

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline small" style="color:#707070; font-family:montserrat">{{ $LoggedUserInfo['nombre']. ' ' . $LoggedUserInfo['ape_pat']}} </span>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x" style="color: #F5F5F5; background-color: #6a7379; border: 2px solid #6a7379; border-radius: 5px; padding: 3px;"></i>
                                    </div>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil')}}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a>
                                    <!-- <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a> -->
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout')}}" class="dropdown-item" id="btnLogout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                <div class="container-fluid">                   
                    @yield('content')
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                {{-- <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer> --}}
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        {{-- <div class="modal fade" tabindex="-1" id="logoutModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cerrar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Seleciona "Aceptar" para cerrar la sesión actual.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" href="{{ route('logout')}}"> <a style="color:white;" href="{{ route('logout')}}">Aceptar</a></button>
                </div>
                </div>
            </div>
        </div> --}}
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/custom.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('public/assets/js/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('public/assets/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        {{-- <script src="{{ asset('public/assets/js/Chart.min.js') }}"></script> --}}

        <script src="{{ asset('public/assets/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/all.min.js') }}"></script>

        <!-- Page level custom scripts -->
        {{-- <script src="{{ asset('public/assets/js/chart-area-demo.js') }}"></script>
        <script src="{{ asset('public/assets/js/chart-pie-demo.js') }}"></script> --}}
        <script src="{{ asset('public/assets/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.mask.min.js') }}"></script>     

        <!-- validator -->
        <script src="{{ asset('public/assets/vendors/validator/validator.js') }}"></script>
        @yield('scripts')
    </body>
</html>
