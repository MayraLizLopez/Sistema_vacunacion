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
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">¡{{ $voluntario->nombre}} Ya aceptaste la jornada!</h1>
                        </center>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12"> 

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Información sobre la jornada</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <h4>{{ $mensaje_jornada->mensaje}}</h4>
                                                    <h4>Seleccionaste participar en la sede: </h3>
                                                    <h4 class="card-text" style="color:#54A583; font-weight: bold; font-size: 24px;">{{ $sede->nombre }}</h4>
                                                    <p class="card-text" style="color: #7B868C; font-size: 24px;">Dirección: {{ $sede->direccion }} 
                                                    @if(!($sede->colonia == null))
                                                        colonia {{ $sede->colonia }}
                                                    @endif
                                                    </p>
                                                    <p class="card-text" style="color: #7B868C; font-size: 24px;">Elegiste el turno:
                                                    @if($turno  == 'Completo')
                                                        {{ $turno }} (7:00 - 15:30 hrs.)
                                                    @endif
                                                    @if($turno  == 'Matutino')
                                                        {{ $turno }} (7:00 - 11:30 hrs.)
                                                    @endif
                                                    @if($turno  == 'Vespertino')
                                                        {{ $turno }} (11:00 - 15:30 hrs.)
                                                    @endif
                                                      </p>
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
</script>
@endsection