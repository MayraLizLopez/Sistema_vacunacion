@extends('layout_gray')
@section('title', 'Inicio')
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

    @font-face {
        font-family: montserrat-bold;
        src: url("{{ asset('public/assets/fonts/Montserrat-Regular.ttf')}}");
        font-weight: bold;
    }
    a{
        font-family: montserrat;
        font-weight: bold;
    }
</style>
<div class="container" style="padding-top:30px;">
    <div class="card shadow mb-4">                        
        <div class="card-body">
            <div class="content" >
                <div class="row justify-content-center" style="padding-bottom:10px;">
                    <h1 class="font-weight-bold text-primary" style="font-size: 50px;" >Banco de voluntarios</h1>
                </div>

                <div class="row mt-3 justify-content-center">
                    <div class="col-sm-5">
                        <img src="{{ asset('public/assets/images/isologo_jalisco_v.svg')}}" style="padding-bottom:40px;"
                                    alt="jalisco"
                                    class="img-fluid">
                    </div>
                </div>

                <div class="row justify-content-center" style="padding-bottom: 45px;">
                    <a href="{{ url("voluntario/index") }}" class="btn btn-success" style="font-size:25px;">¡¡Registrarse como voluntario!!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection