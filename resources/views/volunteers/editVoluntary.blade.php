@extends('admin.layout')
@section('content')
    <div class="row row justify-content-center">
        <div class="col-sm-12">
            <h1 style="margin-top: 30px;">Edición de voluntarios</h1>
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
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script>
        let $table = $('#voluntariesTable');

        $(document).ready(()=>{
            getAllVolunataries();
        });

        //Start table actions & operations
        function getAllVolunataries(){           
            let voluntarios = @json($voluntarios);    
            $table.bootstrapTable({data: voluntarios});
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="like mr-3" href="javascript:void(0)" title="Edit">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .like': function (e, value, row, index) {               
                alert('You click like action, row: ' + JSON.stringify(row))
            },

            'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                    field: 'id_voluntario',
                    values: [row.id_voluntario]
                })
            }
        }
        //End table actions & operations
    </script>
@endsection