@extends('admin.layout')
@section('css')
<link href="{{ asset('public/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1 style="margin-top: 30px;">Editar voluntario</h1>
        </div>
    </div>

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

        .botonEnviar{
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

    <p class="mb-4"> </p>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form action= "{{route('updateVoluntarios', $voluntarioEdit->id_voluntario)}}"  method="POST">
                @method('PATCH')
                @csrf
                @if(Session::get('success'))
                @section('scripts')
                    <script>    
                        Swal.fire({
                            title: '¡Registro completado!',
                            text: '¡Los datos del voluntario fueron actualizados correctamente!',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = '{{url("/admin/panel/show")}}';
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
                            text: 'Al actualizar los datos del voluntario',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                            });
                    </script>
                @endsection
                @endif 


                {{ csrf_field() }}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Datos personales</h5>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nameVoluntary">Nombre(s)</label>
                                        <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" value="{{ $voluntarioEdit->nombre }}" required="required"/>
                                        <span class="text-danger">@error('nombre'){{ 'Ingrese su nombre o nombres' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno" value="{{ $voluntarioEdit->ape_pat }}" required="required"/>
                                        <span class="text-danger">@error('ape_pat'){{ 'Ingrese su apellido paterno' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Apellido Materno</label>
                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno" value="{{ $voluntarioEdit->ape_mat }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nameVoluntary">Correo electrónico</label>
                                        <input type="text" class="form-control" id="nameVoluntary" name="email" placeholder="Correo" value="{{ $voluntarioEdit->email }}" required="required"/>
                                        <span class="text-danger">@error('email'){{ 'Ingrese un email correcto o no registrado en la plataforma' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Teléfono / Celular</label>
                                        <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo" data-mask="000 000 0000" value="{{ $voluntarioEdit->tel }}" required="required">
                                        <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curpVoluntary">CURP</label>
                                        <input type="text" class="form-control" id="curpVoluntary" name="curp" placeholder="CURP" data-mask="SSSS000000SSSSSSA0" value="{{ $voluntarioEdit->curp }}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha_nacimiento" placeholder="Ejem. 15/12/1993" value="{{ $voluntarioEdit->fecha_nacimiento }}" required="required">
                                        <span class="text-danger">@error('fecha_nacimiento'){{ 'Ingrese su fecha de nacimiento' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="townVoluntary">Municipio</label>
                                        <select class="form-control" id="townVoluntary" name="id_municipio">
                                            <option value="{{$voluntarioEdit->id_municipio}}">{{$municipio_select}}</option>
                                            @foreach ($municipios as $municipio)
                                                @if ($municipio_select != $municipio->nombre)
                                                    <option value="{{$municipio->id_municipio}}">{{$municipio->nombre}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-primary">Datos de la institución</h5>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="townVoluntary">Institución</label>
                                        @if ($LoggedUserInfo['rol'] == 'Administrador General')
                                            <select class="form-control" id="instututionVoluntary" name="id_insti">
                                                <option value="{{$voluntarioEdit->id_insti}}">{{$institucion_select}}</option>
                                                @foreach ($instituciones as $institucion)
                                                    @if ($institucion_select != $institucion->nombre)
                                                    <option value="{{$institucion->id_insti}}">{{$institucion->nombre}} </option>
                                                    @endif
                                                @endforeach
                                                <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                                            </select>
                                        @else
                                            @foreach ($instituciones as $institucion)
                                                @if( $LoggedUserInfo['id_insti'] == $institucion->id_insti)
                                                    <select class="form-control" id="instututionVoluntary" name="id_insti" >
                                                        <option value="{{$institucion->id_insti}}"> {{$institucion->nombre}} </option>
                                                        <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                                                    </select>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success botonEnviar" id="sendFormVoluntaries">Guardar</button>
                        <a class="btn btn-secondary" id="boton" style="color:white;" href="{{route('tabla_volu')}}">Cancelar</a>
                        
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <p class="mb-4"> </p>
@endsection
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script>
        $(document).ready(()=>{
            let voluntarios = @json($voluntarioEdit);
            let municipios = @json($municipios);
            let instituciones = @json($instituciones);

            console.log(voluntarios);
        });  

        let date = new Date();
        let day = date.getDate()
        let month = date.getMonth() + 1
        let year = date.getFullYear()
        var hoy;

        if(month < 10){
            hoy=`${year}-0${month}-${day}`;
        }else{
            hoy=`${year}-${month}-${day}`;
        }
        document.getElementById("fecha").max = hoy;

    </script>
@endsection