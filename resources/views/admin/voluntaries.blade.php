@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
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
</style>  
<!-- Page Heading -->
<div class="row">
    <div class="col-md-6">
        <h1 class="h3 mb-2 font-weight-bold text-gray-800">Voluntarios</h1>
        <p class="mb-4">La siguiente tabla muestra todos los voluntarios registrados activos</p>
    </div>
    <div class="col-md-6">
        <button id="btnExportToExcel" 
        class="btn btn-success float-right" 
        style="background-color: #6EDE9E; 
              border: #6EDE9E; 
              font-family: 
              nutmeg-bold; 
              src: url('{{ asset('public/assets/fonts/Nutmeg-Bold.ttf')}}');
              font-weight: bold;
              ">
                <img class="mx-1" src="{{ asset('public/assets/images/borrador.svg')}}" style="width: 40px;"/>
                <span class="h2">Generar reporte</span>
        </button>
    </div>
</div>

<div id="toolbar">
    <div class="form-inline" role="form">

        <div class="form-group main-form">
            <input type="text" class="form-control" placeholder="Voluntario" id="inSearchByVoluntary">
        </div>

        <div class="form-group main-form ml-1">
            <input type="text" class="form-control" placeholder="CURP" id="inSearchByCURP">
        </div>

        <div class="form-group main-form ml-1">
            <select class="custom-select" id="inSearchByTown">
                <option value="" selected disabled hidden>Elija un municipio</option>
            </select>           
        </div>

        @if ($LoggedUserInfo['rol'] == 'Administrador General')
            <div class="form-group main-form ml-1">
                <select class="custom-select" id="inSearchByInstitution">
                    <option value="" selected disabled hidden>Elija una institución</option>
                </select>           
            </div>
        @endif

        <div class="form-group second-form">
            <input type="date" class="form-control" placeholder="Fecha Inicio" id="inSearchByBeginDate">
        </div>

        <div class="form-group second-form ml-1">
            <input type="date" class="form-control" placeholder="Fecha Fin" id="inSearchByEndDate">
        </div>

        <div class="form-group second-form ml-1">
            <input type="text" class="form-control" placeholder="Nombre del Enlace" id="inLinkName">
        </div>

        <div class="form-group second-form ml-1">
            <select class="custom-select" id="inSearchBySede">
                <option value="" selected disabled hidden>Nombre de la Sede</option>
            </select>  
        </div>

        <div class="form-group second-form ml-1">
            <input type="number" class="form-control" placeholder="Horas del voluntario" id="inSearchByHours">
        </div>

        <div class="form-group ml-1">
            <input type="text" class="form-control" placeholder="Busqueda general" id="inSearchCustom">
        </div>

        <div class="form-group ml-1">
            <button type="button" class="btn btn-info btn-table" id="showMoreFilters" 
            data-toggle="collapse" data-target="#moreFilters" aria-expanded="false" aria-controls="moreFilters"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Mostar mas filtros">
                <i class="fas fa-chevron-circle-down"></i>
            </button>      
        </div>

        <div class="form-group ml-1">
            <button type="button" class="btn btn-success btn-table" id="cleanFilters" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpiar Filtros">
            <img class="mx-2" src="{{ asset('public/assets/images/borrador.svg')}}" style="width: 20px;"/>
                <span class="item-label">Limpiar Filtros</span>
            </button>      
        </div>

        <div class="form-group ml-1">
            <button type="button" class="btn btn-primary btn-table" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar voluntario">
                <a style="color:white;" href="{{route('crearVoluntario')}}">
                    <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
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
            data-search-selector="#inSearchCustom"
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
                    <th data-field="curp" data-sortable="true" data-halign="center" data-align="center">CURP</th>
                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-halign="center" data-align="center" data-events="operateEvents"></th>
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
    <script src="{{ asset('public/assets/js/tableExport.min.js') }}"></script>
    <script>
        let $table = $('#voluntariesTable');

        $(document).ready(()=>{
            getAllVolunataries();
            startEvents();
            getAllTowns();
            getAllSedes();
            getAllInstitutions();
            defaultValues();
        });

        function defaultValues(){
            $('.main-form').attr('hidden', false);
            $('.second-form').attr('hidden', true);
        }

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

            $('#inSearchByCURP').on('keypress', (event) => {
                let keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    if($('#inSearchByCURP').val().length <= 0){
                    } else {
                        searchByCURP($('#inSearchByCURP').val());
                    }                   
                }               
            });

            $('#inSearchByHours').on('keypress', (event) => {
                let keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    if($('#inSearchByHours').val().length <= 0){
                    } else {
                        searchByHours($('#inSearchByHours').val());
                    }                   
                }               
            });

            $('#inSearchByEndDate').on('change', () => {
                if($('#inSearchByBeginDate').val().length > 0 &&
                    $('#inSearchByEndDate').val().length > 0)
                {
                    searchByDates($('#inSearchByBeginDate').val(), $('#inSearchByEndDate').val());
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

            $('#inSearchBySede').on('change', () => {
                if($('#inSearchBySede').children('option:selected').val().length <= 0){
                } else {
                    searchBySedes($('#inSearchBySede').children('option:selected').val());
                }                               
            });

            $('#cleanFilters').on('click', () => {
                location.reload();
            });

            $('#showMoreFilters').on('click', () => {
                console.log( $('.main-form').is(':hidden') + ' - ' + $('.second-form').is(':hidden'));

                if(!$('.main-form').is(':hidden') && $('.second-form').is(':hidden')){
                    $('.main-form').attr('hidden', true);
                    $('.second-form').attr('hidden', false);
                }
                else if($('.main-form').is(':hidden') && !$('.second-form').is(':hidden')){
                    $('.main-form').attr('hidden', false);
                    $('.second-form').attr('hidden', true);
                }
            });

            $('#btnExportToExcel').on('click', () => {
                let today = new Date();
                $table.tableExport({
                    fileName: 'reporte voluntarios_' 
                    + today.getDay() 
                    + '-' + (today.getMonth() + 1) 
                    + '-' +today.getFullYear()
                    + ' ' +today.getHours()
                    + '.' +today.getMinutes()
                    + '.' +today.getSeconds(),
                    type: 'excel',
                    escape: false,
                    exportDataType: 'all',
                    refreshOptions: {
                        exportDataType: 'all'
                    }
                });
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

        function getAllSedes(){
            $.ajax({
                url: "voluntario/getAllSedes",
                type: "GET",
                success: function (response) {
                    for(let i in response.data){
                        $('#inSearchBySede').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_sede, 'disabled': false, 'selected': false, 'hidden': false }));
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
            $table.bootstrapTable({data: voluntarios});            
        }

        //#region Seach
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

        function searchByCURP(id){
            $.ajax({
                url: "voluntario/searchByCURP/" + id,
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

        function searchByDates(fecha_inicio, fecha_fin){
            $.ajax({
                url: "voluntario/searchByDates/" + fecha_inicio + "/" + fecha_fin,
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

        function searchBySedes(id){
            $.ajax({
                url: "voluntario/searchBySedes/" + id,
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

        function searchByHours(horas){
            $.ajax({
                url: "voluntario/searchByHours/" + horas,
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
        //#endregion

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