@extends('layout_gray')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
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
                            <h1 style="margin-top: 30px; margin-bottom: 30px;">Registro de voluntarios</h1>
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

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h5 class="m-0 font-weight-bold text-primary">Ingrese sus datos personales</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="nameVoluntary">Nombre(s)</label>
                                                        <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre"/>
                                                        <span class="text-danger">@error('nombre'){{ 'Ingrese su nombre o nombres' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno"/>
                                                        <span class="text-danger">@error('ape_pat'){{ 'Ingrese su apellido paterno' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="paternalSurnameVoluntary">Apellido Materno</label>
                                                        <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nameVoluntary">Correo electrónico</label>
                                                        <input type="text" class="form-control" id="nameVoluntary" name="email" placeholder="Correo"/>
                                                        <span class="text-danger">@error('email'){{ 'Ingrese un email correcto o no registrado en la plataforma' }} @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="paternalSurnameVoluntary">Teléfono / Celular</label>
                                                        <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo">
                                                        <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h5 class="m-0 font-weight-bold text-primary">Ingrese los datos de la institución</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="instututionVoluntary">Institución</label>
                                                        <select class="form-control" id="instututionVoluntary" name="id_insti">
                                                        <span class="text-danger">@error('id_insti'){{ 'Seleccione una institución' }} @enderror </span>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="townVoluntary">Municipio</label>
                                                        <select class="form-control" id="townVoluntary" name="id_municipio">
                                                        </select>
                                                        <span class="text-danger">@error('id_municipio'){{ 'Seleccione un municipio' }} @enderror </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" id="sendFormVoluntaries">Enviar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" ><a style="color:white;" href="{{route('home')}}">Cancelar</a></button>
                            </form>
                        </div>
                    </div>
                </div>
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