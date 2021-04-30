@extends('layout_index')
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
        font-family: nutmeg-bold;
        font-weight: bold;
    }
</style>
<div class="container" style="padding-top:30px;">

    <div class="content" >
        <div class="row justify-content-center" style="padding-bottom: 45px;">
            <a href="{{ url("voluntario/index") }}" class="btn btn-success" style="font-size:70px; background-color:#6EDE9E; margin-top: 50vh; padding-left: 40px; padding-right:40px;">¡Registrate ahora!</a>
        </div>
    </div>
</div>
@endsection