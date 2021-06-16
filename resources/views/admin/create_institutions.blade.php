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


<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Registrar institución y enlace</h1>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<form action= "{{route('storeInstitucion')}}"  method="POST">
{{ csrf_field() }}
<!-- SweetAlert la institución se agrego correctamente -->
@if(Session::get('success'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Registro completado!',
            text: '¡La institución y el enlace fueron registrados correctamente!',
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
<!-- SweetAlert error al agregar la institución -->
@if(Session::get('fail'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Error!',
            text: 'Al registrar la institución y/o al enlace',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif 
<!-- Formularios para agregar institución -->
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
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" required="required"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre de la institución' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio de la institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="domicilio" placeholder="Domicilio" required="required"/>
                            <span class="text-danger">@error('domicilio'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailVoluntary">Municipio</label>
                            <select class="form-control" id="townVoluntary" name="id_municipio">
                                @foreach ($municipios as $municipio)
                                    <option value="{{$municipio->id_municipio}}">{{$municipio->nombre}} </option>
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
                            <input type="text" class="form-control" id="maternalSurnameVoluntary" name="nombre_enlace" placeholder="Nombre Enlace" required="required"/>
                            <span class="text-danger">@error('nombre_enlace'){{ 'Ingrese el nombre del enlace' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phoneVoluntary">Apellido paterno</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="ape_pat" placeholder="Apellido paterno" required="required"/>
                            <span class="text-danger">@error('ape_pat'){{ 'Ingrese apellido paterno' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="phoneVoluntary">Apellido Materno</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="ape_mat" placeholder="Apellido materno" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phoneVoluntary">Contraseña</label>
                            <input type="password" class="form-control" id="phoneVoluntary" name="password" placeholder="Contraseña" required="required"/>
                            <span class="text-danger">@error('password'){{ 'Ingrese una contraseña' }} @enderror </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneVoluntary">Cargo del enlace</label>
                            <input type="text" class="form-control" id="phoneVoluntary" name="cargo_enlace" placeholder="Cargo" required="required"/>
                            <span class="text-danger">@error('cargo_enlace'){{ 'Ingrese el cargo del enlace' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="townVoluntary">Teléfono del enlace</label>
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="Teléfono" data-mask="000 000 0000" required="required"/>
                            <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instututionVoluntary">Correo del enlace</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required="required"/>
                            <span class="text-danger">@error('email'){{ 'Ingrese un correo electrónico valido.' }} @enderror </span>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button id="botonEnviar" class="btn btn-success" type="submit">Guardar</button>
            <a class="btn btn-secondary" id="boton" style="color:white;" href="{{route('tabla_insti')}}">Cancelar</a></button>
            
        </div>
    </div>
</form>
<!-- FIN Formularios para agregar institución -->
@endsection
@section('scripts')
@endsection