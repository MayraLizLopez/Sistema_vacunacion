@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Voluntarios</h1>
<p class="mb-4">La siguiente tabla muestra todos los voluntarios registrados activos</p>

<div id="toolbar">
    <div class="form-inline" role="form">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Voluntario" id="inSearchByVoluntary">
        </div>
        <div class="form-group ml-1">
            <select class="custom-select" id="inSearchByTown">
                <option value="" selected disabled hidden>Elija un municipio</option>
            </select>           
        </div>
        @if ($LoggedUserInfo['rol'] == 'Administrador General')
            <div class="form-group ml-1">
                <select class="custom-select" id="inSearchByInstitution">
                    <option value="" selected disabled hidden>Elija una institución</option>
                </select>           
            </div>
        @endif
        <div class="form-group">
            <button type="button" class="btn btn-success btn-table ml-1" id="cleanFilters">
            <img class="mx-2" src="{{ asset('assets/images/borrador.svg')}}" style="width: 20px;"/>
                <span class="item-label">Limpiar Filtros</span>
            </button>      
        </div>
        <div class="form-group ml-1">
            <button type="button" class="btn btn-primary btn-table">
                <a style="color:white;" href="{{route('crearVoluntario')}}">
                    <img class="mx-2" src="{{ asset('assets/images/agregar.svg')}}" style="width: 20px;"/>
                    <span class="item-label">Registrar Voluntario</span>                 
                </a>
            </button>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">           
            <table id="voluntariesTable" class="table table-striped table-bordered"
            data-locale="es-MX"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true"
            data-search="true"
            data-search="true"
            data-page-size="5"
            data-page-list="[5, 10, 15, 50, 100, 200, 500, 1000]"
            data-sort-name="nombre"
            data-sort-order="desc"
            data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_voluntario">ID</th>
                    <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                    <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                    <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                    <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script src="{{ url("../resources/js/bootstrap-table-es-MX.js") }}"></script>
    <script>
        let $table = $('#voluntariesTable');

        $(document).ready(()=>{
            getAllVolunataries();
            startEvents();
            getAllTowns();
            getAllInstitutions()
        });

        function startEvents(){
            //Evento de busqueda por nombre de voluntario.
            $('#inSearchByVoluntary').on('keypress', (event) => {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    if($('#inSearchByVoluntary').val().length <= 0){
                    } else {
                        searchByVoluntaryName($('#inSearchByVoluntary').val());
                    }                   
                }               
            });

            $('#inSearchByTown').on('change', () => {
                if($('#inSearchByTown').children('option:selected').val().length <= 0){
                } else {
                    searchByTown($('#inSearchByTown').children('option:selected').val());
                }                               
            });

            $('#inSearchByInstitution').on('change', () => {
                if($('#inSearchByInstitution').children('option:selected').val().length <= 0){
                } else {
                    searchByInstitution($('#inSearchByInstitution').children('option:selected').val());
                }                               
            });

            $('#cleanFilters').on('click', () => {
                location.reload();
            });
        }

        function getAllTowns(){
            $.ajax({
                url: "voluntario/getAllTowns",
                type: "GET",
                success: function (response) {
                    for(let i in response.data){
                        $('#inSearchByTown').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_municipio, 'disabled': false, 'selected': false, 'hidden': false }));
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllInstitutions(){
            $.ajax({
                url: "voluntario/getAllInstitutions",
                type: "GET",
                success: function (response) {
                    for(let i in response.data){
                        $('#inSearchByInstitution').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_insti, 'disabled': false, 'selected': false, 'hidden': false }));
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllVolunataries(){      
            let voluntarios = @json($voluntarios);
            console.log(voluntarios);       
            $table.bootstrapTable({data: voluntarios});            
        }

        function searchByVoluntaryName(id){
            $.ajax({
                url: "voluntario/searchByVoluntaryName/" + id,
                type: "GET",
                success: function (response) {
                    $table.bootstrapTable('destroy');
                    $table.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function searchByTown(id){
            $.ajax({
                url: "voluntario/searchByTown/" + id,
                type: "GET",
                success: function (response) {
                    $table.bootstrapTable('destroy');
                    $table.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function searchByInstitution(id){
            $.ajax({
                url: "voluntario/searchByInstitution/" + id,
                type: "GET",
                success: function (response) {
                    $table.bootstrapTable('destroy');
                    $table.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function deleteVoluntary(id){
            $.ajax({
                url: "voluntario/destroy/" + id,
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
            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    title: 'Advertencia',
                    text: "¿Está seguro que desea eliminar este voluntario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteVoluntary(row.id_voluntario);
                    }
                    });
            }
        }
    </script>
@endsection