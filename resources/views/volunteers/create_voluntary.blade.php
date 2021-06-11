@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
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
    <h1 class="h3 mb-2 font-weight-bold text-gray-800">Registo de voluntario</h1>
    <p class="mb-4"> </p>
    
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form method="POST" action="{{url('/voluntario/store')}}">
                @if(Session::get('success'))
                @section('scripts')
                    <script>    
                        Swal.fire({
                            title: '¡Registro completado!',
                            text: '¡Los datos fueron agregados correctamente!',
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
                            text: 'Los datos no puedieron ser agregados correctamente, por favor intentalo más tarde',
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
                        <h5 class="m-0 font-weight-bold text-primary">Ingrese sus datos personales</h5>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nameVoluntary">Nombre(s)</label>
                                        <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" required="required"/>
                                        <span class="text-danger">@error('nombre'){{ 'Ingrese su nombre o nombres' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno" required="required"/>
                                        <span class="text-danger">@error('ape_pat'){{ 'Ingrese su apellido paterno' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Apellido Materno</label>
                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nameVoluntary">Correo electrónico</label>
                                        <input type="email" class="form-control" id="emailVoluntary" name="email" placeholder="Correo" required="required"/>
                                        <span class="text-danger">@error('email'){{ 'Ingrese un email correcto o no registrado en la plataforma' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="paternalSurnameVoluntary">Teléfono / Celular</label>
                                        <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo" data-mask="000 000 0000" required="required">
                                        <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curpVoluntary">CURP</label>
                                        <input type="text" class="form-control" id="curpVoluntary" name="curp" placeholder="CURP" data-mask="SSSS000000SSSSSSA0"/>
                                        <span class="text-danger">@error('curp'){{ 'Ingrese su CURP' }} @enderror </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha_nacimiento" placeholder="Ejem. 15/12/1993" required="required">
                                        <span class="text-danger">@error('fecha_nacimiento'){{ 'Ingrese su fecha de nacimiento' }} @enderror </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="townVoluntary">Municipio de residencia</label>
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
                        <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos de la institución</h5>
                    </div>
                    <div class="card-body">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="instututionVoluntary">Institución</label>
                                        @if ($LoggedUserInfo['rol'] == 'Administrador General')
                                            <select class="form-control" id="instututionVoluntary" name="id_insti">
                                                @foreach ($instituciones as $institucion)
                                                    <option value="{{$institucion->id_insti}}">{{$institucion->nombre}} </option>
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

                            <button type="submit" class="btn btn-success" id="botonEnviar">Enviar</button>
                            <a class="btn btn-secondary" id="boton" style="color:white;" href="{{route('tabla_volu')}}">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script>
        let date = new Date();
        let day = date.getDate()
        let month = date.getMonth() + 1
        let year = date.getFullYear()
        let hoy;

        if(month < 10){
            hoy=`${year}-0${month}-${day}`;
        }else{
            hoy=`${year}-${month}-${day}`;
        }
        document.getElementById("fecha").max = hoy;

    </script>
@endsection