@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Editar Institución</h1>
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

        #botonEnviar{
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

<form action= "{{route('updateInstitucion', $institucion->id_insti)}}"  method="POST">
    @method('PATCH')
    @csrf
    <!-- SweetAlert institución editar correctamente -->
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
    <!-- SweetAlert error al editar la institución -->
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
<!-- formulario editar institución -->
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
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" value="{{ $institucion->nombre}}" required="required"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio de la institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="domicilio" value="{{ $institucion->domicilio}}" required="required"/>
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
                            <label for="emailVoluntary">Nombre completo del enlace</label>
                            @foreach ($usuarios as $user)
                            @if($i == 0)
                                <select class="form-control" id="nombre_usuario" name="nombre_enlace" onchange="cambiarDatos()">
                                <option value="{{$usuario->id_user}}">{{$usuario->nombre.' '.$usuario->ape_pat.' '.$usuario->ape_mat }}</option>
                                <?php $i++; ?>
                            @endif
                            @if ($usuario->nombre.' '.$usuario->ape_pat.' '.$usuario->ape_mat != $user->nombre.' '.$user->ape_pat.' '.$user->ape_mat)
                                <option value="{{$user->id_user}}">{{ $user->nombre.' '.$user->ape_pat.' '.$user->ape_mat }} </option>
                            @endif
                            @endforeach
                            </select>
                            <span class="text-danger">@error('nombre_enlace'){{ 'Seleccione un municipio' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneVoluntary">Cargo del enlace</label>
                            <input type="text" class="form-control" id="cargo_enlace" name="cargo_enlace" value="{{ $usuario->cargo }}" required="required"/>
                            <span class="text-danger">@error('cargo_enlace'){{ 'Ingrese el cargo del enlace' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="townVoluntary">Teléfono del enlace</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ $usuario->tel}}" data-mask="000 000 0000" required="required"/>
                            <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instututionVoluntary">Correo del enlace</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email}}" required="required"/>
                            <input hidden name="email2" id="email2" value="{{ $usuario->email}}"/>
                            <span class="text-danger">@error('email2'){{ 'Ingrese un correo electrónico valido.' }} @enderror </span>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success" id="botonEnviar" type="submit">Guardar</button>
            <a class="btn btn-secondary" id="boton" style="color:white;" href="{{route('tabla_insti')}}">Cancelar</a></button>
            
        </div>
    </div>
</form>
<!-- FIN formulario editar institución -->
@endsection
@section('scripts')
<script>
    const user = {!! json_encode($usuarios) !!};
    document.getElementById("cargo_enlace").disabled = true;
    document.getElementById("tel").disabled = true;
    document.getElementById("email").disabled = true;
    function cambiarDatos(){
        var id = document.getElementById("nombre_usuario").value; 
        for(var i=0; i < user.length; i++){
            if(user[i].id_user === parseInt(id)){
                document.getElementById("cargo_enlace").value = user[i].cargo;
                document.getElementById("tel").value = user[i].tel;
                document.getElementById("email").value = user[i].email;
                document.getElementById("email2").value = user[i].email;
                console.log(user[i].email);
                break;
            }
        }
    }
</script>
@endsection
