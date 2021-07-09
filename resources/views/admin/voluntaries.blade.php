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

    .modal-dialog {
        max-width: 800px;
        margin: 1.75rem auto;
    }

    .large{
        max-width: 1500px;
        margin: 1.75rem auto;
    }

    #boton{
            width: 184px;
            font-family: montserrat;
            font-weight: bold;
        }

    .botonEnviar{
        margin-right: 16px;
        width: 184px;
        font-family: montserrat;
        font-weight: bold;
    }
    
</style>  
<!-- Page Heading -->
<div class="row">
    <div class="col-md-6">
        <h1 class="h3 mb-2 font-weight-bold text-gray-800">Voluntarios</h1>
        <p class="mb-4">La siguiente tabla muestra los voluntarios registrados activos.</p>
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
              height: 70px;
              width: 300px;
              ">
                <img class="mx-1" src="{{ asset('public/assets/images/documento.svg')}}" style="width: 30px;"/>
                <span style="font-size: 25px;">Generar reporte</span>
        </button>
    </div> 
</div>

<div id="toolbar">
    <fieldset>
        <legend>Buscar por: </legend>
        <div class="form-inline" role="form">

            <div class="form-group main-form">
                <input type="text" class="form-control" placeholder="Voluntario" id="inSearchByVoluntary">
            </div>
    
            <div class="form-group main-form ml-1">
                <input type="text" class="form-control" placeholder="CURP" id="inSearchByCURP">
            </div>
    
            <div class="form-group main-form ml-1">
                <select class="custom-select" id="inSearchByTown">
                    <option value="" selected disabled hidden>Municipio</option>
                </select>           
            </div>
    
            @if ($LoggedUserInfo['rol'] == 'Administrador General')
                <div class="form-group main-form ml-1">
                    <select class="custom-select" id="inSearchByInstitution">
                        <option value="" selected disabled hidden>Institución</option>
                    </select>           
                </div>
                
            @endif
    
            <div class="form-group second-form">
                <input type="text" class="form-control" placeholder="Fecha Inicio" id="inSearchByBeginDate" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha inicio"
                onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
    
            <div class="form-group second-form ml-1">
                <input type="text" class="form-control" placeholder="Fecha Fin" id="inSearchByEndDate" data-bs-toggle="tooltip" data-bs-placement="top" title="Fecha fin"
                onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
    
            {{-- <div class="form-group second-form ml-1">
                <input type="text" class="form-control" placeholder="Nombre del Enlace" id="inLinkName">
            </div> --}}
    
            {{-- <div class="form-group second-form ml-1">
                <select class="custom-select" id="inSearchBySede">
                    <option value="" selected disabled hidden>Nombre de la Sede</option>
                </select>  
            </div>
    
            <div class="form-group second-form ml-1">
                <input type="number" class="form-control" placeholder="Horas del voluntario" id="inSearchByHours">
            </div> --}}
    
            <div class="form-group ml-1">
                <input type="text" class="form-control" placeholder="Búsqueda general" id="inSearchCustom">
            </div>
            
            <div class="form-group ml-1">
                {{-- <button type="button" class="btn btn-info btn-table" id="showMoreFilters" data-bs-toggle="tooltip" data-bs-placement="top" title="Mostar mas filtros"
                style="height: 39px;">
                    <i class="fas fa-chevron-circle-down" style="height: 24px; padding-top: 1px;"></i>
                      <span style="height: 24px; padding-top: 1px;">Más filtros</span> 
                </button> --}}
                
                <button type="button" class="btn btn-info btn-table" id="showMoreFilters" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpiar filtros">
                    <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
                        <span class="item-label"> Más filtros</span>
                    </button> 
            </div>
    
            <div class="form-group ml-1">
                <button type="button" class="btn btn-success btn-table" id="cleanFilters" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpiar filtros">
                <img class="mx-2" src="{{ asset('public/assets/images/borrador.svg')}}" style="width: 20px;"/>
                    <span class="item-label"> Limpiar filtros</span>
                </button>      
            </div>
    
            <!-- <div class="form-group ml-1">
                <a class="btn btn-info btn-table" id="btnLoadHours" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar horas">
                    <img class="mx-2" src="{{ asset('public/assets/images/reloj.svg')}}" style="width: 20px;"/>
                    <span class="item-label">Agregar horas</span>                 
                </a>
            </div> -->
    
            <div class="form-group ml-1">
                <a class="btn btn-primary btn-table" href="{{route('crearVoluntario')}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrar voluntarios">
                    <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
                    <span class="item-label">Registrar voluntario</span>                 
                </a>
            </div>
    
        </div>
    </fieldset>

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
            data-page-size="15"
            data-page-list="[15, 25, 50, 100]"
            data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_voluntario">ID</th>
                    <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                    <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                    <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Correo electrónico</th>
                    <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                    <th data-field="curp" data-sortable="true" data-halign="center" data-align="center">CURP</th>
                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                    <th data-field="fecha_creacion" data-sortable="true" data-halign="center" data-align="center">Fecha de registro</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-halign="center" data-align="center" data-events="operateEvents">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Agregar horas a voluntarios-->
<div id="modalLoadHours" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Agregar horas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
            </button>
            </div>
            <div class="modal-body">
                <label>Seleccione o ingrese la cantidad de horas que quiere agregar a los voluntarios seleccionados</label>
                        
                <div class="row align-items-center">
                    <div class="col-md-2">
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <img class="mx-2" src="{{ asset('public/assets/images/mas.svg')}}" style="width: 50px;" onclick="sumar()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" class="form-control mx-2" id="horas" name="institucion" placeholder="" min="0"/>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <img class="mx-2" src="{{ asset('public/assets/images/menos.svg')}}" style="width: 50px;" onclick="restar()"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mr-auto">
                <button id="agregarHorarMuti" class="btn btn-success botonEnviar" type="submit" >Guardar</button>
                <a class="btn btn-secondary" id="boton" style="color:white;" data-dismiss="modal">Cancelar</a>       
            </div>
        </div>
    </div>
</div>

<!-- Modal editar horas a voluntarios-->
<div id="modalEditarHoras" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Editar las horas del voluntario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre_completo">Nombre del voluntario</label>
                            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="emailVoluntary">Nombre de la institución</label>
                            <input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion"/>
                        </div>
                    </div> 
                </div>  
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="form-group">
                            <img class="mx-2" src="{{ asset('public/assets/images/mas.svg')}}" style="width: 50px;" onclick="sumar2()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" class="form-control mx-2" id="horas2" name="institucion" placeholder="" min="0"/>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <img class="mx-2" src="{{ asset('public/assets/images/menos.svg')}}" style="width: 50px;" onclick="restar2()"/>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="num_voluntarios">Total de horas acumuladas</label>
                            <input type="text" class="form-control" id="total_horas" name="total_horas"/>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer mr-auto">
                <button id="agregarHoras" class="btn btn-success botonEnviar" type="submit">Guardar</button>
                <a class="btn btn-secondary" id="boton" style="color:white;" data-dismiss="modal">Cancelar</a>       
            </div>
        </div>
    </div>
</div>

<div id="modalViewVoluntarioDetail" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog large" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-0 font-weight-bold text-primary">Información del voluntario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 20px;"/>
                </button>
            </div>

            <div class="modal-body">
                <div id="toolbar4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_encargado">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emailVoluntary">Apellido Paterno</label>
                                <input type="text" class="form-control" id="ape_pat" name="ape_pat"/>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="num_voluntarios">Apellido Materno</label>
                                <input type="text" class="form-control" id="ape_mat" name="ape_mat"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_encargado">Institución</label>
                                <input type="text" class="form-control" id="insti" name="insti"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailVoluntary">Municipio</label>
                                <input type="text" class="form-control" id="municipio" name="municipio"/>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_encargado">Correo electrónico</label>
                                <input type="text" class="form-control" id="email" name="email"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="emailVoluntary">Teléfono / Celular</label>
                                <input type="text" class="form-control" id="tel" name="tel"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="curp">CURP</label>
                                <input type="text" class="form-control" id="curp" name="curp"/>
                            </div>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="num_voluntarios">Número de horas</label>
                                <input type="text" class="form-control" id="num_horas" name="num_horas"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script src="{{ asset('public/assets/js/tableExport.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/xls-export.js') }}"></script>
    <script>
        var id_volun = 0;
        var bandera = false;
        var difhoras = 0;
        var total_horas = 0;
        let $table = $('#voluntariesTable');
        document.getElementById("horas").value = 0;
        let voluntariosData = [];

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

            $('#btnLoadHours').on('click', () => {
                $('#modalLoadHours').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $('#cleanFilters').on('click', () => {
                location.reload();
            });

            $('#showMoreFilters').on('click', () => {
                // console.log( $('.main-form').is(':hidden') + ' - ' + $('.second-form').is(':hidden'));

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

                const xls = new xlsExport(
                    voluntariosData, 
                    'Voluntarios'
                );

                xls.exportToXLS(
                    'reporte voluntarios_' 
                    + today.getDay() 
                    + '-' + (today.getMonth() + 1) 
                    + '-' +today.getFullYear()
                    + ' ' +today.getHours()
                    + '.' +today.getMinutes()
                    + '.' +today.getSeconds()
                    + '.xls'
                );
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
            let _voluntarios = voluntarios.map(item => {
                let data = {
                    'Nombre': item.nombre,
                    'Apellido Paterno': item.ape_pat,
                    'Apellido Materno': item. ape_mat,
                    'Email': item.email,
                    'Teléfono': item.tel,
                    'CURP': item.curp,
                    'Municipio': item.nombre_municipio,
                    'Institución': item.nombre_institucion,
                    'Fecha de registro': item.fecha_creacion
                };
                return data;
            });

            $table.bootstrapTable({data: voluntarios});

            voluntariosData = [];
            voluntariosData = _voluntarios;
        }

        //#region Seach
        function searchByVoluntaryName(id){
            $.ajax({
                url: "voluntario/searchByVoluntaryName/" + id,
                type: "GET",
                success: function (response) {
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
                    let voluntarios = response.data;
                    let _voluntarios = voluntarios.map(item => {
                        let data = {
                            'Nombre': item.nombre,
                            'Apellido Paterno': item.ape_pat,
                            'Apellido Materno': item. ape_mat,
                            'Email': item.email,
                            'Teléfono': item.tel,
                            'CURP': item.curp,
                            'Municipio': item.nombre_municipio,
                            'Institución': item.nombre_institucion,
                            'Fecha de registro': item.fecha_creacion
                        };
                        return data;
                    });

                    voluntariosData = [];
                    voluntariosData = _voluntarios;

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
            let actionButton = '';
            if({!! json_encode($LoggedUserInfo['rol']) !!} !== 'Administrador General'){
                return [
                    '<a class="detail mr-2" href="javascript:void(0)" title="Detalles">',
                    '<img src="{{ asset('public/assets/images/i1.svg')}}" style="width: 15px; padding:0px;"/>',
                    '</a>',
                    '<a class="like mr-3" href="voluntario/edit/' + row.id_voluntario + '"' + 'title="Editar">',
                    '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; padding:0px;"/>',
                    '</a>'
                ].join('')
            }else{
                if(row.activo == 1){
                    actionButton = '<a class="edit_horas mr-2" href="javascript:void(0)" title="Editar horas voluntario">'
                    +'<img src="{{ asset('public/assets/images/reloj_azul.svg')}}" style="width: 15px; padding:0px;"/>'
                    +'</a>';
                } 
                return [
                    actionButton,
                    '<a class="detail mr-2" href="javascript:void(0)" title="Detalles">',
                    '<img src="{{ asset('public/assets/images/i1.svg')}}" style="width: 15px; padding:0px;"/>',
                    '</a>',
                    '<a class="like mr-3" href="voluntario/edit/' + row.id_voluntario + '"' + 'title="Editar">',
                    '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; padding:0px;"/>',
                    '</a>',
                    '<a class="remove" href="javascript:void(0)" title="Eliminar">',
                    '<img src="{{ asset('public/assets/images/basura.svg')}}" style="width: 15px; padding:0px;"/>',
                    '</a>'
                ].join('')
            }
        }

        window.operateEvents = {
            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    title: '¿Está seguro de que desea eliminar este voluntario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6A7379',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteVoluntary(row.id_voluntario);
                    }
                });
            },

            'click .detail': function (e, value, row, index) {
                $('#modalViewVoluntarioDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getDetallevoluntario(row.id_voluntario);
            },

            'click .edit_horas': function (e, value, row, index) {
                $('#modalEditarHoras').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getHorasvoluntario(row.id_voluntario);
            }
        }
        /**
        * Método que consulta al getDetalleVoluntario de la clase de VoluntariosController
        * que consulta los datos del voluntario y permite visualizarla en los campos correspondientes de 
        * la ventana modal para ver los datos completos del voluntario
        */
        function getDetallevoluntario(id_voluntario){
            $.ajax({
                url: "voluntario/detalles/" + id_voluntario,
                type: "GET",
                success: function (response) {
                    // console.log(response);
                    if(response.bandera == false){
                        $('#nombre').val(response.data.nombre);
                        $('#nombre').prop( "disabled", true );
                        $('#ape_pat').val(response.data.ape_pat);
                        $('#ape_pat').prop( "disabled", true );
                        $('#ape_mat').val(response.data.ape_mat);
                        $('#ape_mat').prop( "disabled", true );
                        $('#municipio').val(response.data.nombre_municipio);
                        $('#municipio').prop( "disabled", true );
                        $('#insti').val(response.data.nombre_institucion);
                        $('#insti').prop( "disabled", true );
                        $('#tel').val(response.data.tel);
                        $('#tel').prop( "disabled", true );
                        $('#curp').val(response.data.curp);
                        $('#curp').prop( "disabled", true );
                        $('#email').val(response.data.email);
                        $('#email').prop( "disabled", true );
                        $('#num_horas').val(0);
                        $('#num_horas').prop( "disabled", true );
                    }
                    else{
                        $('#nombre').val(response.data[0].nombre);
                        $('#nombre').prop( "disabled", true );
                        $('#ape_pat').val(response.data[0].ape_pat);
                        $('#ape_pat').prop( "disabled", true );
                        $('#ape_mat').val(response.data[0].ape_mat);
                        $('#ape_mat').prop( "disabled", true );
                        $('#municipio').val(response.data[0].nombre_municipio);
                        $('#municipio').prop( "disabled", true );
                        $('#insti').val(response.data[0].nombre_institucion);
                        $('#insti').prop( "disabled", true );
                        $('#tel').val(response.data[0].tel);
                        $('#tel').prop( "disabled", true );
                        $('#curp').val(response.data[0].curp);
                        $('#curp').prop( "disabled", true );
                        $('#email').val(response.data[0].email);
                        $('#email').prop( "disabled", true );
                        if(response.data.length == 1){
                            $('#num_horas').val(response.data[0].horas);
                            $('#num_horas').prop( "disabled", true );
                        }else{
                            var horas = 0;
                            for(var i = 0; i < response.data.length; i++){
                                horas = horas + response.data[i].horas;
                            }
                            $('#num_horas').val(horas);
                            $('#num_horas').prop( "disabled", true );
                        }
                    } 
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }
        /**
        * Método que consulta al getDetalleVoluntario de la clase de VoluntariosController
        * que consulta los datos del voluntario y permite visualizarla en los campos correspondientes de 
        * la ventana modal para edita las horas del voluntario
        */
        function getHorasvoluntario(id_voluntario){
            $.ajax({
                url: "voluntario/detalles/" + id_voluntario,
                type: "GET",
                success: function (response) {
                     console.log(response);
                    //idVoluntario = response.data.id_voluntario;
                    if(response.bandera == false){
                        $('#nombre_completo').val(response.data.nombre + ' ' + response.data.ape_pat + ' ' + response.data.ape_mat);
                        $('#nombre_completo').prop( "disabled", true );
                        $('#municipio').val(response.data.nombre_municipio);
                        $('#municipio').prop( "disabled", true );
                        $('#nombre_institucion').val(response.data.nombre_institucion);
                        $('#nombre_institucion').prop( "disabled", true );
                    
                        $('#total_horas').val(0);
                        $('#total_horas').prop( "disabled", true );
                        $('#horas2').val(0);
                    }
                    else{
                        $('#nombre_completo').val(response.data[0].nombre + ' ' + response.data[0].ape_pat + ' ' + response.data[0].ape_mat);
                        $('#nombre_completo').prop( "disabled", true );
                        $('#municipio').val(response.data[0].nombre_municipio);
                        $('#municipio').prop( "disabled", true );
                        $('#nombre_institucion').val(response.data[0].nombre_institucion);
                        $('#nombre_institucion').prop( "disabled", true );
                        if(response.data.length == 1){
                            $('#total_horas').val(response.data[0].horas);
                            $('#total_horas').prop( "disabled", true );
                            $('#horas2').val(response.data[0].horas);
                            total_horas = response.data[0].horas;
                        }else{
                            var t_horas = 0;
                            for(var i = 0; i < response.data.length; i++){
                                t_horas = t_horas + response.data[i].horas;
                            }
                            $('#total_horas').val(t_horas);
                            $('#total_horas').prop( "disabled", true );
                            $('#horas2').val(t_horas);
                            total_horas = t_horas;
                        }
                    }
                    id_volun = id_voluntario;
                    bandera = response.bandera;
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }
        
        /**
        * Método para guardar las horas del voluntario
        */
        $('#agregarHoras').on('click', () => {
            if(bandera == true){
                if(document.getElementById("horas2").value !== 0){
                    var horas = document.getElementById("horas2").value;
                    difhoras = horas - total_horas;
                    editarHoras(id_volun, difhoras); 
                }
            }else{
                $('#modalEditarHoras').modal('hide');
                Swal.fire({
                    title: '¡Error!',
                    text: 'El voluntario no se encuentra en una jornada o no ha aceptado la jornada por correo electrónico',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                    });
            }
        });

        /**
        * Método para editar las horas de los voluntarios
         */
        function editarHoras(id_voluntario, horas){
            $.ajax({
                url: "voluntario/editarHoras/" + id_voluntario + "/" + horas,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    $('#modalEditarHoras').modal('hide');
                    if(response.isOk == true){
                        Swal.fire({
                        title: '¡Registro completado!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        });
                    }else{
                        Swal.fire({
                            title: '¡Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                            });
                    }
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

        //limpia el campo de horas del modal 
        function limpiar() {
            document.getElementById("horas").value = 0;
        }
        //reiniciar el contador de horas botón "Agregar horas"
        $('#btnLoadHours').on('click', () => {
                document.getElementById("horas").value = 0;
            }
        );

        //funcionalidad para el botón + 
        function sumar() {
            var horas = document.getElementById("horas").value;
            horas++;
            document.getElementById("horas").value = horas;
        }
        //funcionalidad del boton -
        function restar() {
            var horas = document.getElementById("horas").value;
            if (!(horas == 0)){
                horas--;
                document.getElementById("horas").value = horas;
            } 
        }
        //funcionalidad para el botón + 
        function sumar2() {
            var horas = document.getElementById("horas2").value;
            horas++;
            document.getElementById("horas2").value=horas;
        }
        //funcionalidad del boton -
        function restar2() {
            var horas2 = document.getElementById("horas2").value;
            if (!(horas2 == 0)){
                horas2--;
                document.getElementById("horas2").value=horas2;
            } 
        }
    </script>
@endsection