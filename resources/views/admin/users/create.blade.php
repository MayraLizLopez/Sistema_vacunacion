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
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Agregar usuario</h1>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<form action= "{{route('storeUser')}}"  method="POST">
{{ csrf_field() }}
@if(Session::get('success'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Registro completado!',
            text: '¡El usuario fue registrado correctamente!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "{{route('indexUsers')}}";
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
            text: 'Al registrar el usuario',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos usuario</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameUser">Nombre</label>
                            <input type="text" class="form-control" id="nameUser" name="nombre" placeholder="Nombre"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameUser">Apellido Paterno</label>
                            <input type="text" class="form-control" id="paternalSurnameUser" name="ape_pat" placeholder="Apellido Paterno"/>
                            <span class="text-danger">@error('direccion'){{ 'Ingrese el apellido paterno' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternalSurnameUser">Apellido Materno</label>
                            <input type="text" class="form-control" id="maternalSurnameUser" name="ape_mat" placeholder="Apellido Materno"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameUser">Email</label>
                            <input type="email" class="form-control" id="emailUser" name="email" placeholder="Email"/>
                            <span class="text-danger">@error('email'){{ 'Ingrese el email' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneUser">Teléfono / Celular</label>
                            <input type="text" class="form-control" id="phoneUser" name="tel" placeholder="Número celular o fijo" data-mask="000 000 0000">
                            <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="townUser">Institución</label>
                            <select class="form-control" id="townUser" name="id_insti">
                                <option value="" disabled selected hidden>Elija una institución</option>
                                @foreach ($instituciones as $institucion)
                                    <option value="{{$institucion->id_insti}}">{{$institucion->nombre}} </option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cargoUser">Cargo</label>
                            <input type="text" class="form-control" id="cargoUser" name="cargo" placeholder="Cargo"/>
                            <span class="text-danger">@error('cargo'){{ 'Ingrese un cargo' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rolUser">Rol</label>
                            <select class="form-control" id="rolUser" name="rol">
                                <option value="" disabled selected hidden>Elija un rol</option>
                                <option value="Administrador General">Administrador General</option>
                                <option value="Enlace de institución">Enlace de institución</option>
                            </select>
                            <span class="text-danger">@error('rol'){{ 'Seleccione un rol' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="passwordUser">Contraseña</label>
                        <input type="password" class="form-control" id="passwordUser" name="password" placeholder="Contraseña"/>
                        <span class="text-danger">@error('email'){{ 'Ingrese una contraseña' }} @enderror </span>
                    </div>
                </div>
            </div>
            <button id="botonEnviar" class="btn btn-success" type="submit">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" ><a style="color:white;" href="{{route('indexUsers')}}">Cancelar</a></button>            
        </div>
    </div>
</form>
@endsection
@section('scripts')
@endsection