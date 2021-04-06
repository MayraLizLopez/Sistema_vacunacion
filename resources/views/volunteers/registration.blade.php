@extends('layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('title', 'Registro de Voluntarios')
@section('content')
<div class="container">
    <div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1 style="margin-top: 30px;">Registro de voluntarios</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form method="POST" action="{{url("/voluntario/store")}}">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif 

                {{ csrf_field() }}
                <div class="form-group" style="margin-top: 30px;">
                    <label for="nameVoluntary">Nombre (s)</label>
                    <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre (s)">
                    <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre o nombres' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno">
                    <span class="text-danger">@error('ape_pat'){{ 'Ingrese el apellido paterno' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="maternalSurnameVoluntary">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno">
                </div>
                <div class="form-group">
                    <label for="instututionVoluntary">Institución</label>
                    <select class="form-control" id="instututionVoluntary" name="id_insti">
                    <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                    </select>
                </div>
                <div class="form-group">
                    <label for="emailVoluntary">Correo electrónico</label>
                    <input type="text" class="form-control" id="emailVoluntary" name="email" placeholder="Correo electrónico">
                    <span class="text-danger">@error('email'){{ 'Ingrese un email invalido o ya registrado' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="phoneVoluntary">Teléfono / Celular</label>
                    <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo">
                    <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="townVoluntary">Municipio</label>
                    <select class="form-control" id="townVoluntary" name="id_municipio">
                    </select>
                    <span class="text-danger">@error('id_municipio'){{ 'Seleccione un municipio' }} @enderror </span>
                </div>
                <button type="submit" class="btn btn-primary" id="sendFormVoluntaries">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let municipios = @json($municipios);
        let institutos = @json($instituciones);

        console.log(municipios);

        $(document).ready(()=>{
            startEvents();
        });

        function startEvents(){
            getAllTowns(municipios);
            getAllInstitutes(institutos);
        }

        function getAllInstitutes(institutos){
            for(let instituto in institutos){
                $('#instututionVoluntary').append( "<option value=" + institutos[instituto].id_insti + ">" + institutos[instituto].nombre + "</option>");
            }           
        }

        function getAllTowns(municipios){
            for(let municipio in municipios){
                $('#townVoluntary').append( "<option value=" + municipios[municipio].id_municipio + ">" + municipios[municipio].nombre + "</option>");
            }           
        }
    </script>
@endsection