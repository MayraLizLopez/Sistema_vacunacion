@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Editar Institución</h1>
<p class="mb-4"> </p>


<form action= "{{route('updateInstitucion', $institucion->id_insti)}}"  method="POST">
    @method('PATCH')
    @csrf
    @if(Session::get('success'))
    @section('scripts')
        <script>    
            Swal.fire({
                title: '¡Registro actualizado!',
                text: '¡La institución y el enlace fueron actualizados correctamente!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "{{route('tabla_insti')}}";
                    }
                });
        </script>
    @endsection
    @endif
    @if(Session::get('fail'))
    @section('scripts')
        <script>    
            Swal.fire({
                title: '¡Error!',
                text: 'Al actualizar la institución y/o al enlace',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
                });
        </script>
    @endsection
    @endif 

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos de la Institución</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre de la institución</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" value="{{ $institucion->nombre}}"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio de la institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="domicilio" value="{{ $institucion->domicilio}}"/>
                            <span class="text-danger">@error('domicilio'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailVoluntary">Municipio</label>
                            <select class="form-control" id="townVoluntary" name="id_municipio">
                            <option value="{{$institucion->id_municipio}}">{{$municipio_select}}</option>
                            @foreach ($municipios as $municipio)
                            @if ($municipio_select != $municipio->nombre)
                            <option value="{{$municipio->id_municipio}}">{{$municipio->nombre}} </option>
                            @endif
                            @endforeach
                            </select>
                            <span class="text-danger">@error('id_municipio'){{ 'Seleccione un municipio' }} @enderror </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos del Enlace</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="maternalSurnameVoluntary">Nombre del enlace</label>
                            <input type="text" class="form-control" id="maternalSurnameVoluntary" name="nombre_enlace" value="{{ $usuario->nombre }}"/>
                            <span class="text-danger">@error('nombre_enlace'){{ 'Ingrese el nombre del enlace' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phoneVoluntary">Apellido paterno</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="ape_pat" value="{{ $usuario->ape_pat }}"/>
                            <span class="text-danger">@error('ape_pat'){{ 'Ingrese apellido paterno' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="phoneVoluntary">Apellido Materno</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="ape_mat" value="{{ $usuario->ape_mat }}" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneVoluntary">Cargo del enlace</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="cargo_enlace" value="{{ $usuario->cargo }}" />
                            <span class="text-danger">@error('cargo_enlace'){{ 'Ingrese el cargo del enlace' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="townVoluntary">Teléfono del enlace</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ $usuario->tel}}" data-mask="000 000 0000"/>
                            <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instututionVoluntary">Correo del enlace</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email}}"/>
                            <span class="text-danger">@error('email'){{ 'Ingrese un correo electrónico valido.' }} @enderror </span>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" ><a style="color:white;" href="{{route('tabla_insti')}}">Cancelar</a></button>
            
        </div>
    </div>
</form>

@endsection
@section('scripts')
@endsection