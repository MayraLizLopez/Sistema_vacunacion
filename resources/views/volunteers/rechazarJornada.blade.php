@extends('layout_gray')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
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
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">¡Rechazaste la jornada!</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="alert alert-warning">
                                {{ $voluntario->nombre }} has rechazado la jornada.
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection