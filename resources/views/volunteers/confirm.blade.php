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
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">¡Gracias por confirmar tu correo!</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                 '¡Tu correo a sido confirmado correctamente!'
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h5 class="m-0 font-weight-bold text-primary">Mensaje importante</h5>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <div class="row">
                                            <h4>El equipo de voluntariado te asignara a una jornada dentro de poco, por favor este al pendiente de su correo eléctronico</h4>
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