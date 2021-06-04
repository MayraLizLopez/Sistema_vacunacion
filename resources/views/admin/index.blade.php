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
            <!-- Voluntarios enlaces-->
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

            <!-- jornadas enlaces -->
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
      <!-- Botón aviso de privacidad -->  
    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <a class="btn btn-success" href="{{route('aviso')}}" target="_blank" rel="noopener noreferrer">Aviso de Privacidad</a>
        </div>
    </div>
        <!-- Logo jalisco -->  
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
<!-- FIN Modal Aviso provacidad horas a voluntarios-->
@endsection
<!-- /.container-fluid -->
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script>
        if({!! json_encode($LoggedUserInfo['aviso']) !!} == 0){
            $('#modalAviso').modal({ show: true });    
        }

        /**
        * Método para mostrar aviso de privasidad en caso no haber aceptado el aviso
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