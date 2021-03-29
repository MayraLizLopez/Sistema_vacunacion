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
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
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
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection