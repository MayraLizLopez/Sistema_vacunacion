@extends('layout')
@section('title', 'Inicio')
@section('content')
<div class="container">
    <div class="row mt-3 justify-content-center">
        <div class="col-sm-5">
        <img src="{{ asset('public/assets/images/isologo_jalisco_v.svg')}}"
                     alt="jalisco"
                     class="img-fluid">
          </div>
    </div>
    <div class="row justify-content-center">
            <h1>Banco de voluntarios</h1>
    </div>
    <div class="row justify-content-center">
        <a href="{{ url("voluntario/index") }}" class="btn btn-primary">Registrarse como voluntario</a>
    </div>
</div>
@endsection