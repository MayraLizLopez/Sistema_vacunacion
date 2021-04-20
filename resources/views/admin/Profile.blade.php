@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Mi Perfil</h1>
<p class="mb-4"> </p>

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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{ $user->nombre }}" disabled/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="" value="{{ $user->ape_pat }}" disabled/>
                            <span class="text-danger">@error('domicilio'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Apellido Materno</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_Mat" placeholder="" value="{{ $user->ape_pat }}" disabled/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $institucion->nombre }}" disabled/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Cargo</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_Mat" placeholder="" value="{{ $user->cargo }}" disabled/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Teléfono</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $user->tel }}" disabled/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Correo</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="institucion" placeholder="" value="{{ $user->email }}" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#passwordModal" ><a style="color:white;">Cambiar contraseña</a></button>
    </div>

</form>

<!-- password Modal-->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <input type="password" class="form-control" id="paternalSurnameVoluntary" name="password" placeholder="Ingrese la nueva contraseña" />
                                <span class="text-danger">@error('password'){{ 'Ingrese una contraseña' }} @enderror </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection