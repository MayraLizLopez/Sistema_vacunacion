@extends('layout_gray')
@section('css')
    <link href="{{ asset('public/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('title', 'Registro de Voluntarios')
@section('content')
    

<div class="container" style="width: 100%;">
    <div class="card shadow mb-4"  style="margin-top: 30px;">
        <div class="card-body">
            <div class="content">
                <div class="col-sm-12">
                    <div class="row row justify-content-center">
                        <div class="col-sm-12">
                        <center></center>
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">¡Ya casi perteneces a la jornada!</h1>
                        </center>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <!-- <div class="alert alert-success">
                                {{ $voluntario->nombre}} aceptaste trabajar en la jornada
                            </div> -->

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Información sobre la jornada</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <h3>Hola {{ $voluntario->nombre }}. Por favor selecciona el turno que deseas para esta jornada. Una vez que selecciones el turno, da clic en el botón "Guardar".</h3>
                                                    <!-- <h4>{{ $mensaje_jornada->mensaje}}</h4> -->
                                                    <h4>Seleccionaste participar en la sede: </h3>
                                                    <h4 class="card-text" style="color:#54A583; font-weight: bold; font-size: 24px;">{{ $sede->nombre }}</h4>
                                                    <p class="card-text" style="color: #7B868C; font-size: 24px;">Dirección: {{ $sede->direccion }} 
                                                    @if(!($sede->colonia == null))
                                                        colonia {{ $sede->colonia }}
                                                    @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="emailVoluntary">Seleciona tu horario de preferencia para esta jornada:</label>
                                                            <select class="form-control" id="turno" name="nombre_enlace">
                                                            <option value="Completo">Completo (7:00 - 15:30 hrs.)</option>
                                                            <option value="Matutino">Matutino (7:00 - 11:30 hrs.)</option>
                                                            <option value="Vespertino">Vespertino (11:00 - 15:30 hrs.)</option>
                                                        </select>
                                                        <span class="text-danger">@error('Turno'){{ 'Seleccione un turno' }} @enderror </span>
                                                        <div class="form-group">
                                                            <center>
                                                                <button style="margin-right: 16px; width: 184px; font-family: montserrat; font-weight: bold; margin-top: 10px;" class="btn btn-success" id="botonEnviar" type="submit">Guardar</button>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
@section('scripts')
<script>

    $('#botonEnviar').on('click', () => {
        guardarTurno();
    });


    function guardarTurno(){
        $.ajax({
            url: "guardar/" + {!! json_encode($uuid) !!} + "/" + document.getElementById("turno").value,
            type: "GET",
            success: function (response) {
                if(response.isOk == true){
                    Swal.fire({
                    title: '¡Gracias por aceptar la jornada!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        showCancelButton: true
                    });
                } 
            },
            error: function (error, resp, text) {
                console.error(error);
            }
        });
     }
</script>
@endsection