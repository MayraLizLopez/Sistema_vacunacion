@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1 style="margin-top: 30px;">Editar Institución</h1>
        </div>
    </div>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Instituciones</h6>
    </div>
    <div class="card-body">
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
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{$institucion->nombre}}">
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="domicilio" placeholder="Domicilio" value="{{$institucion->domicilio}}">
                            <span class="text-danger">@error('domicilio'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternalSurnameVoluntary">Nombre Enlace</label>
                            <input type="text" class="form-control" id="maternalSurnameVoluntary" name="nombre_enlace" placeholder="Nombre Enlace" value="{{$institucion->nombre_enlace}}">
                            <span class="text-danger">@error('nombre_enlace'){{ 'Ingrese el nombre del enlace' }} @enderror </span>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phoneVoluntary">Cargo</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="cargo_enlace" placeholder="Cargo" value="{{$institucion->cargo_enlace}}"/>
                            <span class="text-danger">@error('cargo_enlace'){{ 'Ingrese el cargo del enlace' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="townVoluntary">Teléfono</label>
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono" value="{{$institucion->tel}}">
                            <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instututionVoluntary">Correo</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo" value="{{$institucion->email}}">
                            <span class="text-danger">@error('email'){{ 'Ingrese un correo electrónico valido.' }} @enderror </span>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" ><a style="color:white;" href="{{route('tabla_insti')}}">Cancelar</a></button>
        </form>
    </div>
  </div>
@endsection
@section('scripts')
@endsection