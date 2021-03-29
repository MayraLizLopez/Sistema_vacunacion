@extends('layout')
@section('title', 'Registro de Voluntarios')
@section('content')
<div class="container">
    <div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1>Registro de voluntarios</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form>
                <div class="form-group">
                    <label for="nameVoluntary">Nombre (s)</label>
                    <input type="text" class="form-control" id="nameVoluntary" placeholder="Nombre (s)">
                </div>
                <div class="form-group">
                    <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternalSurnameVoluntary" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                    <label for="maternalSurnameVoluntary">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternalSurnameVoluntary" placeholder="Apellido Materno">
                </div>
                <div class="form-group">
                    <label for="instututionVoluntary">Institución</label>
                    <select class="form-control" id="instututionVoluntary">
                      <option disabled>Institución</option>
                      {{-- @foreach ($instituciones as $instituto)
                        <option value="{{$instituto['id_municipio']}}">{{$instituto['nombre']}} </option>
                      @endforeach --}}
                    </select>
                </div>
                <div class="form-group">
                    <label for="emailVoluntary">Correo electrónico</label>
                    <input type="text" class="form-control" id="emailVoluntary" placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                    <label for="phoneVoluntary">Teléfono / Celular</label>
                    <input type="text" class="form-control" id="phoneVoluntary" placeholder="Número celular o fijo">
                </div>
                <div class="form-group">
                    <label for="townVoluntary">Municipio</label>
                    <select class="form-control" id="townVoluntary">
                      <option  disabled>Municipio</option>
                      {{-- @foreach ($municipios as $municipio)
                        <option value="{{$municipio['id_insti']}}">{{$instituto['nombre']}} </option>
                      @endforeach --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        console.log(@json($municipios));
    </script>
@endsection