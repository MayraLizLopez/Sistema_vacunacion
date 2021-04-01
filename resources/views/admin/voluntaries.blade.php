@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Voluntarios</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">           
            <table id="datatable" class="table table-striped table-bordered"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_voluntario">ID</th>
                    <th data-field="nombre" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="ape_pat" data-halign="center" data-align="center">Apellido Paterno</th>
                    <th data-field="ape_mat" data-halign="center" data-align="center">Apellido Materno</th>
                    <th data-field="email" data-halign="center" data-align="center">Email</th>
                    <th data-field="id_municipio" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="id_insti" data-halign="center" data-align="center">Institución</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($voluntarios as $item)
                    <tr>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->ape_pat}}}</td>
                        <td>{{$item->ape_mat}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->tel}}</td>
                        @foreach ($municipios as $municipio)
                        @if ($item->id_municipio == $municipio->id_municipio)
                            <td>{{$municipio->nombre}}</td>
                        @endif
                        @endforeach
                        @foreach ($instituciones as $institucion)
                        @if ($item->id_insti == $institucion->id_insti)
                            <td>{{$institucion->nombre}}</td>
                        @endif
                        @endforeach
                        <td>  
                            <a class="like mr-3" href="{{route('editarVoluntarios', $item->id_voluntario)}}" title="Edit" type="reset"><i class="fas fa-edit"></i></a>
                            <a class="remove" href="javascript:void(0)" title="Remove"><i class="fa fa-trash"></i></a>
                        </td>
            
                    </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {{-- <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
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
            '<a class="like mr-3" href="voluntario/edit/' + row.id_voluntario + '"' + 'title="Edit">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .like': function (e, value, row, index) {

                //alert('You click like action, row: ' + JSON.stringify(row))
            },

            'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                    field: 'id_voluntario',
                    values: [row.id_voluntario]
                })
            }
        }
        //End table actions & operations
    </script> --}}
@endsection