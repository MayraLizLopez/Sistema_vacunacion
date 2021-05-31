@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/assets/css/miEstilo.css') }}" rel="stylesheet" type="text/css">
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
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Agregar sede de vacunación</h1>
<p class="mb-4"> </p>

<!-- DataTales Example -->
<form action= "{{route('storeSede')}}"  method="POST">
{{ csrf_field() }}
@if(Session::get('success'))
@section('scripts')
    <script>    
        Swal.fire({
            title: '¡Registro completado!',
            text: '¡La sede fue registrado correctamente!',
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
            text: 'Al registrar la sede',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
    </script>
@endsection
@endif 
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos de la sede</h5>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre de la sede</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" required="required" maxlength="255"/>
                            <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Domicilio de la institución</label>
                            <input type="text" class="form-control" id="paternalSurnameVoluntary" name="direccion" placeholder="Domicilio" required="required" maxlength="255"/>
                            <span class="text-danger">@error('direccion'){{ 'Ingrese el domicilio' }} @enderror </span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Cruce de calles</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="cruce_calles" placeholder="Entre A y B" maxlength="255"/>
                            <span class="text-danger">@error('cruce_calles'){{ 'Ingrese el cruce de calles' }} @enderror </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nameVoluntary">Colonia</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="colonia" placeholder="colonia" maxlength="255" />
                            <span class="text-danger">@error('colonia'){{ 'Ingrese la colonia' }} @enderror </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Código postal</label>
                            <input type="number" class="form-control" id="paternalSurnameVoluntary" name="cp" placeholder="código postal" min="11111" max="99999"/>
                            <span class="text-danger">@error('cp'){{ 'Ingrese el código postal' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternalSurnameVoluntary">Número de voluntarios necesarios</label>
                            <input type="number" class="form-control" id="paternalSurnameVoluntary" name="cupo" placeholder="Max. 50" min="1" max="50" required="required"/>
                            <span class="text-danger">@error('cupo'){{ 'Ingrese el número de voluntarios' }} @enderror </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Nombre del encargado</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="nombre_encargado" placeholder="Nombre" maxlength="255"/>
                            <span class="text-danger">@error('nombre_encargado'){{ 'Ingrese el nombre del encargado' }} @enderror </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Telefóno del encargado</label>
<<<<<<< HEAD
                            <input type="text" class="form-control" id="nameVoluntary" data-mask="000 000 0000" name="tel_encargado" placeholder="Teléfono"/>
=======
                            <input type="text" class="form-control" id="nameVoluntary" name="tel_encargado" data-mask="000 000 0000" placeholder="Teléfono"/>
>>>>>>> origin/master
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nameVoluntary">Correo del encargado</label>
                            <input type="text" class="form-control" id="nameVoluntary" name="email_encargado" placeholder="Correo"/>
                        </div>
                    </div>
                </div>
            </div>
            <button id="botonEnviar" class="btn btn-success" type="submit" onclick="buscar()">Guardar</button>
            <a class="btn btn-secondary" id="boton" style="color:white;" href="{{route('tabla_sedes')}}">Cancelar</a>
            
        </div>
    </div>
</form>
@endsection
@section('scripts')
@endsection