@extends('admin.layout')
@section('content')
    <div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1 style="margin-top: 30px;">Edición de voluntarios</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form action= "{{route('updateVoluntarios', $voluntarioEdit->id_voluntario)}}"  method="POST">
                @method('PATCH')
                @csrf
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
                    <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre (s)" value="{{ $voluntarioEdit->nombre }}">
                    <span class="text-danger">@error('nombre'){{ 'Ingrese el nombre o nombres' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                    <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno" value="{{ $voluntarioEdit->ape_pat }}">
                    <span class="text-danger">@error('ape_pat'){{ 'Ingrese el apellido paterno' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="maternalSurnameVoluntary">Apellido Materno</label>
                    <input type="text" class="form-control" id="maternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno" value="{{ $voluntarioEdit->ape_mat }}">
                </div>
                <div class="form-group">
                    <label for="townVoluntary">Institución</label>
                    <select class="form-control" id="townVoluntary" name="id_municipio">
                    <option value="{{$voluntarioEdit->id_insti}}">{{$institucion_select}}</option>
                     @foreach ($instituciones as $institucion)
                      @if ($institucion_select != $institucion->nombre)
                     <option value="{{$institucion->id_insti}}">{{$institucion->nombre}} </option>
                     @endif
                     @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="emailVoluntary">Correo electrónico</label>
                    <input type="text" class="form-control" id="emailVoluntary" name="email" placeholder="Correo electrónico" value="{{ $voluntarioEdit->email }}">
                    <span class="text-danger">@error('email'){{ 'Ingrese un email invalido o ya registrado' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="phoneVoluntary">Teléfono / Celular</label>
                    <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo" value="{{ $voluntarioEdit->tel }}">
                    <span class="text-danger">@error('tel'){{ 'Ingrese un número telefónico' }} @enderror </span>
                </div>
                <div class="form-group">
                    <label for="townVoluntary">Municipio</label>
                    <select class="form-control" id="townVoluntary" name="id_municipio">
                    <option value="{{$voluntarioEdit->id_municipio}}">{{$municipio_select}}</option>
                     @foreach ($municipios as $municipio)
                      @if ($municipio_select != $municipio->nombre)
                     <option value="{{$municipio->id_municipio}}">{{$municipio->nombre}} </option>
                     @endif
                     @endforeach
                    </select>
                </div>
                <span class="text-danger">@error('id_municipio'){{ 'Seleccione un municipio' }} @enderror </span>
                <button class="btn btn-primary" type="submit">Save changes</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script>
        $(document).ready(()=>{
            let voluntarios = @json($voluntarioEdit);
            let municipios = @json($municipios);
            let instituciones = @json($instituciones);

            console.log(voluntarios);
        });  
    </script>
@endsection