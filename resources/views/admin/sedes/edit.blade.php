@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  

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

        #botonEnviar{
            margin-right: 16px;
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


<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Editar centro de vacunación</h1>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<form action= "{{route('updateSede', $sede->id_sede)}}"  method="POST">
@method('PATCH')
@csrf
@if(Session::get('success'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Registro completado!',
            text: '¡El centro fue registrado correctamente!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "{{route('tabla_sedes')}}";
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
            text: 'Al registrar el centro',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos del centro</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre del centro</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{ $sede->nombre }}"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio del centro</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="direccion" placeholder="Domicilio"  value="{{ $sede->direccion }}"/>
                            <span class="text-danger">@error('direccion'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailVoluntary">Municipio</label>
                            <select class="form-control" id="townVoluntary" name="id_municipio">
                            <option value="{{$sede->id_municipio}}">{{$municipio_select}}</option>
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
                            <label for="paternalSurnameVoluntary">Número de voluntarios necesarios</label>
                            <input type="number" class="form-control" id="paternalSurnameVoluntary" name="cupo" placeholder="Max. 30" min="1" max="30"  value="{{ $sede->cupo }}"/>
                            <span class="text-danger">@error('cupo'){{ 'Ingrese el número de voluntarios' }} @enderror </span>
                        </div>
                    </div>
                </div>
            </div>
            <button id="botonEnviar" class="btn btn-success" type="submit">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" ><a style="color:white;" href="{{route('tabla_sedes')}}">Cancelar</a></button>
            
        </div>
    </div>
</form>
@endsection
@section('scripts')
@endsection