@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Editar Institución</h1>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Instituciones</h6>
    </div>
    <div class="card-body">
        <form>
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{$institucion->nombre}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="domicilio" placeholder="Domicilio" value="{{$institucion->domicilio}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternalSurnameVoluntary">Nombre Enlace</label>
                            <input type="text" class="form-control" id="maternalSurnameVoluntary" name="nombre_enlace" placeholder="Nombre Enlace" value="{{$institucion->nombre_enlace}}">
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phoneVoluntary">Cargo</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="cargo" placeholder="Cargo" value="{{$institucion->cargo_enlace}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="townVoluntary">Teléfono</label>
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono" value="{{$institucion->tel}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instututionVoluntary">Correo</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Correo" value="{{$institucion->email}}">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
    </div>
  </div>
@endsection
@section('scripts')
@endsection