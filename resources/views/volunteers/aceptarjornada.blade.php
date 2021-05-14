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
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">¡Gracias por aceptar la jornada!</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                {{ $voluntario->nombre}} aceptaste trabajar en la jornada
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Mensaje importante</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <div class="row">
                                            <h4>{{ $mensaje_jornada->mensaje}}</h4>
                                            <h4>Seleccionaste participar en la sede: </h4>
                                            <div style="color:#54A583; font-weight: bold; font-size: 24px; margin-top: 15px;">{{ $sede->nombre }}</div>
                                            <p class="card-text" style="color: #7B868C; font-size: 24px;">{{ $sede->direccion }} 
                                            @if(!($sede->colonia == null))
                                                colonia {{ $sede->colonia }}
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
    </form>
</div>


@endsection