    @extends('admin.layout')
    @section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 font-weight-bold text-gray-800">Inicio</h1>
    </div>

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
      
        button{
            width: 184px;
            font-family: montserrat;
            font-weight: bold;
        }

        #boton{
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

        h1{
            font-family: nutmeg-bold;
        }

        h5{
            font-family: nutmeg-bold;
        }
        
        label{
            font-family: montserrat;
        }
        
        input{
            font-family: montserrat;
        }

        a{
            font-family: montserrat;
        }
        
    </style>

    @if ($LoggedUserInfo['rol'] == 'Administrador General')
    <div class="row">
        <!-- Voluntarios -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;" >
                                Voluntarios</div>
                            <div class="h5 mb-0 font-weight-bold" style="color:#6A7379;">{{ $voluntarios }}</div>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('public/assets/images/voluntarios.svg')}}" style="width: 75px;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instituciones -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;">
                                Instituciones</div>
                            <div class="h5 mb-0 font-weight-bold" style="color:#6A7379;">{{ $instituciones }}</div>
                        </div>
                        <div class="col-auto">
                        <img src="{{ asset('public/assets/images/instituciones.svg')}}" style="width: 75px;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jornadas -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;"> Jornadas
                            </div>
                            <div class="h5 mb-0 font-weight-bold" style="color:#6A7379">{{ $jornadas }}</div>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('public/assets/images/jornada.svg')}}" style="width: 75px;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <div class="row">
        <!-- Centros -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;" >
                                Sedes</div>
                            <div class="h5 mb-0 font-weight-bold" style="color:#6A7379">{{ $centros }}</div>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('public/assets/images/centros_tarjeta.svg')}}" style="width: 75px;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;">
                                Usuarios</div>
                            <div class="h5 mb-0 font-weight-bold" style="color:#6A7379">{{ $usuarios }}</div>
                        </div>
                        <div class="col-auto">
                        <img src="{{ asset('public/assets/images/usuarios_tarjeta.svg')}}" style="width: 75px;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Pending Requests Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    @else
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;" >
                                    Voluntarios</div>
                                <div class="h5 mb-0 font-weight-bold" style="color:#6A7379">{{ $voluntarios }}</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('public/assets/images/voluntarios.svg')}}" style="width: 75px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style=" border-left: 8px solid #54A583;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-mb font-weight-bold" style="color:#54A583; font-family: nutmeg-bold; font-size: 18px;"> Jornadas
                                </div>
                                <div class="h5 mb-0 font-weight-bold" style="color:#6A7379">{{ $jornadas }}</div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('public/assets/images/jornada.svg')}}" style="width: 75px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
    @endif
        
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="btn btn-success" href="{{route('aviso')}}" target="_blank" rel="noopener noreferrer">Aviso de Privacidad</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <img src="{{ asset('public/assets/images/isologo_jalisco_v.svg')}}"
                    alt="jalisco"
                    class="img-fluid">
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
        </div>
    </div>




    <!-- Modal Aviso provacidad horas a voluntarios-->
<div id="modalAviso" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Aviso de privacidad</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
            </button> -->
            <a href="{{ route('logout')}}"><img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row align-items-center">
                            Se informa que el enlace que se tenga a bien designar por parte de su institución, deberá guardad la debida confidencialidad de la información y/o documentación a la cual se tenga acceso con motivo de la ejecución de su designación, la cual deberá ser utilizada única y exclusivamente para los fines de la misma, comprometiéndose a hacerse responsables de su resguardo y buen uso.
                            Asimismo, se obligan a cumplir con la legislación vigente en materia de protección de datos personales, por lo que garantizaran que aplicarán la confidencialidad debida de los datos personales a los cuales se tenga acceso.
                            </div>
                        </div>
                    </div> 
                </div>  
            </div>
            <div class="modal-footer mr-auto">
                <button id="aceptarAviso" class="btn btn-success botonEnviar" type="submit">Aceptar</button>
                <a class="btn btn-secondary" id="boton" style="color:white;" href="{{ route('logout')}}">Cancelar</a>
                
            </div>
        </div>
    </div>
</div>


    <!-- Content Row -->

    <!-- <div class="row"> -->

        <!-- Area Chart -->
        <!-- <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4"> -->
                <!-- Card Header - Dropdown -->
                <!-- <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> -->
                <!-- Card Body -->
                <!-- <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Pie Chart -->
        <!-- <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4"> -->
                <!-- Card Header - Dropdown -->
                <!-- <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div> -->
                <!-- Card Body -->
                <!-- <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Content Row -->
    <!-- <div class="row"> -->

        <!-- Content Column -->
        <!-- <div class="col-lg-6 mb-4"> -->

            <!-- Project Card Example -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span
                            class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span
                            class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span
                            class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span
                            class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span
                            class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div> -->

            <!-- Color System -->
            <!-- <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Light
                            <div class="text-black-50 small">#f8f9fc</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            Dark
                            <div class="text-white-50 small">#5a5c69</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4"> -->

            <!-- Illustrations -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="img/undraw_posting_photo.svg" alt="">
                    </div>
                    <p>Add some quality, svg illustrations to your project courtesy of <a
                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                        constantly updated collection of beautiful svg images that you can use
                        completely free and without attribution!</p>
                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                        unDraw &rarr;</a>
                </div>
            </div> -->

            <!-- Approach -->
            <!-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                        CSS bloat and poor page performance. Custom CSS classes are used to create
                        custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with the
                        Bootstrap framework, especially the utility classes.</p>
                </div>
            </div>

        </div>
    </div> -->
    @endsection
<!-- /.container-fluid -->
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script>
        if({!! json_encode($LoggedUserInfo['aviso']) !!} == 0){
            $('#modalAviso').modal({ show: true });    
        }

         /**
        * Método para guardar las horas del voluntario
        */
        $('#aceptarAviso').on('click', () => {
            $.ajax({
                url: "aceptarAviso/" + {!! json_encode($LoggedUserInfo['id_user']) !!},
                type: "GET",
                success: function (response) {
                    //console.log(response);
                    $('#modalAviso').modal('hide');
                    if(response.isOk == true){
                        Swal.fire({
                        title: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
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
                
            
        });
        
    </script>
@endsection