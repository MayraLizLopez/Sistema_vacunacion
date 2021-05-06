@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/miEstilo.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mi Perfil</h1>
<p class="mb-4"> </p>
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

        .botonCambiarPass{
            margin-right: 16px;
            width: 250px;
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

<!-- DataTales Example -->
<form>
@if(Session::get('success'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Registro completado!',
            text: '¡Tu contraseña se actualizó correctamente!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif
@if(Session::get('fail'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Error!',
            text: 'No se pudo actualizar tu contraseña',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Mis datos</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{ $user->nombre }}" disabled/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="" value="{{ $user->ape_pat }}" disabled/>
                            <span class="text-danger">@error('domicilio'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Apellido Materno</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_Mat" placeholder="" value="{{ $user->ape_pat }}" disabled/>
                        </div>
                    </div>
                </div>

                <div class="row">
                
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $institucion->nombre }}" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Cargo</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_Mat" placeholder="" value="{{ $user->cargo }}" disabled/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Teléfono</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $user->tel }}" disabled/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Correo</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $user->email }}" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success botonCambiarPass" onclick="modal()">Cambiar contraseña</button>
</form>

<!-- password Modal-->
{{-- <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('savePassword')}}">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paternalSurnameVoluntary">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="paternalSurnameVoluntary" name="password" placeholder="Ingrese la nueva contraseña" required="required"/>
                                <span class="text-danger">@error('password'){{ 'Ingrese una contraseña' }} @enderror </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mr-auto">
                    <button  type="submit" class="btn btn-success botonEnviar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="button-largo">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
@endsection
@section('scripts')
<script>
async function modal(){
    const { value: password } = await Swal.fire({
        title: 'Cambiar contraseña',
        text: "Nueva contraseña",
        input: 'text',
        showCancelButton: true,
        confirmButtonColor: '#54A583',
        cancelButtonColor: '#6A7379',
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Calcelar',
        inputValidator: (value) => {
            if (!value) {
            return 'Debe ingresar la contraseña!'
            }
        }
        });

        if (password) {
            cambiarPass(password);
        }
}


function cambiarPass(pass){
            $.ajax({
                url: "profile/savePassword/" + pass,
                type: "GET",
                success: function (response) {
                    if(response.isOk == true){
                        Swal.fire({
                        title: 'Hecho',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showCancelButton: true
                        });
                    } 
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }
</script>
@endsection