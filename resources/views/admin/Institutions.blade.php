@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading --> 
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Instituciones</h1>
<p class="mb-4">La siguiente tabla contiene todas las instituciones registradas.</p>

<div id="toolbar">
    <div class="form-inline">
        <button type="button" class="btn btn-primary"><a style="color:white;" href="{{route('createInstitucion')}}"><img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/> Registrar Institución</a></button>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive"> 
            <table id="institutionsTable" class="table table-striped table-bordered"
            data-locale="es-MX"
            data-pagination="true" 
            data-single-select="true" 
            data-click-to-select="true"
            data-search="true"
            data-page-size="5"
            data-page-list="[5, 10, 15, 50, 100, 200, 500, 1000]"
            data-sort-name="nombre"
            data-sort-order="desc"
            data-toolbar="#toolbar"> 
                <thead>
                    <tr>
                        <th class="d-none" data-radio="true"></th>
                        <th class="d-none" data-field="id_insti">ID</th>
                        <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                        <th data-field="domicilio" data-sortable="true" data-halign="center" data-align="center">Domicilio</th>
                        <th data-field="nombre_enlace" data-sortable="true" data-halign="center" data-align="center">Nombre Enlace</th>
                        <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                        <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                        <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                        <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script>
        let $table = $('#institutionsTable');

        $(document).ready(()=>{
            getAllInstitutions();
        });

        //Start table actions & operations
        function getAllInstitutions(){      
            let instituciones = @json($instituciones);       
            $table.bootstrapTable({data: instituciones});           
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="like mr-3" href="institutions/edit/' + row.id_insti + '"' + 'title="Edit">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    title: 'Advertencia',
                    text: "¿Está seguro que desea eliminar esta institución?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteInstitution(row.id_insti);
                    }
                    });
            }
        }

        function deleteInstitution(id){
            $.ajax({
                url: "institutions/destroy/" + id,
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.isOk == true){
                        Swal.fire({
                        title: 'Hecho',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showCancelButton: true
                        });
                    } 
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }
        //End table actions & operations
    </script>
@endsection