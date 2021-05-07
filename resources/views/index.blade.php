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
    #white-text{
        font-family: nutmeg-bold;
        font-weight: bold;
        font-size: 75px;
        color: white;
        margin-bottom: 0px;
        margin-top: 0px;
    }
    #white-text-big{
        font-family: nutmeg-bold;
        font-weight: bold;
        font-size: 90px;
        color: white;
        margin-bottom: 0px;
        margin-top:0px;
    }
    #green-text{
        font-family:nutmeg-bold;
        font-weight: bold;
        font-size: 75px;
        color: #6EDE9E;
        margin-top:0px;
    }

    #boton{
        font-size:70px; 
        background-color:#6EDE9E; 
        margin-top: 15vh; 
        padding-left: 40px; 
        padding-right:40px;
    }

    @media only screen and (max-width: 1000px) {
        #white-text{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 60px;
            color: white;
            margin-bottom: 0px;
            margin-top: 0px;
        }
        #white-text-big{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 70px;
            color: white;
            margin-bottom: 0px;
            margin-top:0px;
        }
        #green-text{
            font-family:nutmeg-bold;
            font-weight: bold;
            font-size: 60px;
            color: #6EDE9E;
            margin-top:0px;
        }

        #boton{
            font-size: 55px; 
            background-color:#6EDE9E; 
            margin-top: 12vh; 
            padding-left: 30px; 
            padding-right:30px;
        }  
    }

    @media only screen and (max-width: 570px) {
        #white-text{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 40px;
            color: white;
            margin-bottom: 0px;
            margin-top: 0px;
        }
        #white-text-big{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 50px;
            color: white;
            margin-bottom: 0px;
            margin-top:0px;
        }
        #green-text{
            font-family:nutmeg-bold;
            font-weight: bold;
            font-size: 40px;
            color: #6EDE9E;
            margin-top:0px;
        }

        #boton{
            font-size: 40px; 
            background-color:#6EDE9E; 
            margin-top: 10vh; 
            padding-left: 15px; 
            padding-right:15px;
        }  
    }

    @media only screen and (max-width: 380px) {
        #white-text{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 35px;
            color: white;
            margin-bottom: 0px;
            margin-top: 0px;
        }
        #white-text-big{
            font-family: nutmeg-bold;
            font-weight: bold;
            font-size: 45px;
            color: white;
            margin-bottom: 0px;
            margin-top:0px;
        }
        #green-text{
            font-family:nutmeg-bold;
            font-weight: bold;
            font-size: 35px;
            color: #6EDE9E;
            margin-top:0px;
        }

        #boton{
            font-size: 35px; 
            background-color:#6EDE9E; 
            margin-top: 10vh; 
            padding-left: 15px; 
            padding-right:15px;
        }  
    }
</style>
<div class="container" style="padding-top:30px;">

    <div class="content" >
        <center>
            <div style="display: block; margin-top: 5vh;">
                <span id="white-text">¿Quieres formar parte del</span>
            </div>
            <div>
                <span id="white-text-big">Plan Jalisco</span>
            </div>
            <span id="green-text">ante la Pandemia 2021?</span>
        </center>
        <div class="row justify-content-center" style="padding-bottom: 45px;">
            <a href="{{ url("voluntario/index") }}" class="btn btn-success" id="boton">¡Registrate ahora!</a>
        </div>
    </div>
</div>
@endsection