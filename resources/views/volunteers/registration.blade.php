@extends('layout_gray')
@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection
@section('title', 'Registro de Voluntarios')
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


<div class="container" style="width: 100%;">
    <div class="card shadow mb-4"  style="margin-top: 30px;">
        <div class="card-body">
            <div class="content">
                <div class="col-sm-12">
                    <div class="row row justify-content-center">
                        <div class="col-sm-12">
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">Registro</h1>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <form method="POST" action="{{url('/voluntario/store')}}">
                                @if(Session::get('success'))
                                @section('scripts')
                                    <script>    
                                        Swal.fire({
                                            title: '¡Registro completado!',
                                            text: '¡Tus datos fueron agregados correctamente, te enviaremos un correo a tu email cuando seas elegido para una jornada!',
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
                                            text: 'Tus datos no puedieron ser agregados correctamente, por favor intentalo más tarde',
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
                                        <h5 class="m-0 text-primary">Ingrese sus datos personales</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nameVoluntary">Nombre(s)</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre" required="required"/>
                                                        <span class="text-danger">@error('nombre'){{ 'Ingrese su nombre o nombres' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="paternalSurnameVoluntary">Apellido Paterno</label><span class="text-danger">*</span>
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
                                                        <label for="nameVoluntary">Correo electrónico</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control" id="nameVoluntary" name="email" placeholder="Correo" required="required"/>
                                                        <span class="text-danger">@error('email'){{ 'Ingrese un email correcto o no registrado en la plataforma' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="paternalSurnameVoluntary">Teléfono / Celular</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo" data-mask="000 000 0000" required="required">
                                                        <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="curpVoluntary">CURP</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="curpVoluntary" name="curp" placeholder="CURP" data-mask="SSSS000000SSSSSSA0"    />
                                                        <span class="text-danger">@error('curp'){{ 'Ingrese su CURP' }} @enderror </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha de nacimiento</label><span class="text-danger">*</span>
                                                        <input type="date" class="form-control" id="fecha" name="fecha_nacimiento" placeholder="Ejem. 15/12/1993" required="required">
                                                        <span class="text-danger">@error('fecha_nacimiento'){{ 'Ingrese su fecha de nacimiento' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="townVoluntary">Municipio de residencia</label><span class="text-danger">*</span>
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
                                                        <label for="instututionVoluntary">Institución</label><span class="text-danger">*</span>
                                                        <select class="form-control" id="instututionVoluntary" name="id_insti">
                                                        {{--<option value=""> Elija una institución</option>--}}
                                                        @foreach ($instituciones as $institucion)
                                                            <option value="{{$institucion->id_insti}}">{{$institucion->nombre}} </option>
                                                        @endforeach
                                                        <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="myCheck" onclick="myFunction()">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                               <b> Acepto <a style="color:#b9134b;" href="{{ route('terminos_y_condiciones')}}" target="_blank" rel="noopener noreferrer">términos y condiciones</a>, así como el <a style="color:#b9134b;"  href="{{ asset('public/assets/archivos/aviso_privacidad.pdf')}}" target="_blank" rel="noopener noreferrer">aviso de privacidad</a></b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 py-2">
                                        <button id="botonEnviar" type="submit" class="btn btn-success" id="sendFormVoluntaries">Enviar</button>
                                        <a class="btn btn-secondary" style="color:white; width: 184px;" href="{{route('home')}}">Cancelar</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script>
        document.getElementById("botonEnviar").disabled = true;
        document.getElementById("myCheck").checked = false;
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

            function myFunction() {
                var checkBox = document.getElementById("myCheck");
                if (checkBox.checked == true){
                    document.getElementById("botonEnviar").disabled = false;
                } else {
                    document.getElementById("botonEnviar").disabled = true;
                }
            }
    </script>
@endsection