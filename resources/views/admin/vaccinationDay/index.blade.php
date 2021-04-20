@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  

<style type="text/css">
        @font-face {
            font-family: nutmeg-bold;
            src: url("{{ asset('assets/fonts/Nutmeg-Bold.ttf')}}");
            font-weight: bold;
        }

        @font-face {
            font-family: montserrat;
            src: url("{{ asset('assets/fonts/Montserrat-Regular.ttf')}}");
        }

        #button-largo{
            width: 184px;
            font-family: montserrat;
            font-weight: bold;
        }

        .botonEnviar{
            margin-right: 16px;
            width: 184px;
            font-family: montserrat;
            
        }

        h1{
            font-family: nutmeg-bold;
        }

        h5{
            font-family: nutmeg-bold;
        }
        
        label{
            font-family: montserrat;
        }
        
        input{
            font-family: montserrat;
        }

        a{
            font-family: montserrat;
        }
</style>


<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Jornada de vacunación</h1>
<p class="mb-4">La siguiente vista muestra la tabla de todas las jornadas activas, así como la creación y edición de las mismas.</p>

<div id="toolbar1">
    <div class="form-inline" role="form">
        <button type="button" class="btn btn-primary" id="createVaccinationDay">
        <img class="mx-2" src="{{ asset('assets/images/agregar.svg')}}" style="width: 20px;"/>
            Registrar jornada
        </button>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Voluntarios</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">           
            <table id="vaccinationDayTable" class="table table-striped table-bordered"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true"
            data-search="true"
            data-page-size="5"
            data-page-list="[5, 10, 15, 50, 100, 200, 500, 1000]"
            data-sort-name="nombre"
            data-sort-order="desc"
            data-toolbar="#toolbar1">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_jornada">ID</th>
                    <th data-field="fecha_inicio" data-sortable="true" data-halign="center" data-align="center">Fecha Inicio</th>
                    <th data-field="fecha_fin" data-sortable="true" data-halign="center" data-align="center">Fecha Fin</th>
                    <th data-field="total_voluntarios" data-sortable="true" data-halign="center" data-align="center">Total de Voluntarios</th>
                    <th data-field="operate" data-halign="center" data-align="center" data-formatter="operateFormatter" data-events="operateEvents"></th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="modalCreateVaccinationDay" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear jornada</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inStartDate">Fecha inicio</label>
                    <input type="date" class="form-control" id="inStartDate" placeholder="Ingrese la fecha de inicio">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inEndDate">Fecha fin</label>
                    <input type="date" class="form-control" id="inEndDate" placeholder="Ingrese la fecha final">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inInstitution">Institución</label>
                    <select class="custom-select" id="inInstitution">
                    </select>           
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label for="inHoras">Horas</label>
                    <input type="number" class="form-control" id="inHoras" placeholder="Ingrese el número de horas">
                </div>
            </div> --}}
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inMessage">Mensaje para el voluntario</label>
                    <textarea class="form-control" id="inMessage" rows="3"></textarea>
                  </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="sedesTable">Sedes</label>           
                    <table id="sedesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_sede">ID</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="direccion" data-sortable="true" data-halign="center" data-align="center">Dirección</th>
                            <th data-field="cupo" data-sortable="true" data-halign="center" data-align="center">Cupo</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="voluntariesTable">Voluntarios</label>     
                    <table id="voluntariesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_voluntario">ID</th>
                            <th class="d-none" data-field="id_insti">ID Institución</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                            <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                            <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                            <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                            <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                            <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer mr-auto">
            <button type="button" class="btn btn-success botonEnviar" id="saveVaccinationDay">Crear jornada</button>
            <button id="button-largo" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        

        </div>
      </div>
    </div>
  </div>

  <div id="modalEditJornada" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar jornada</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="editInStartDate">Fecha inicio</label>
                    <input type="date" class="form-control" id="editInStartDate" placeholder="Ingrese la fecha de inicio">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="editInEndDate">Fecha fin</label>
                    <input type="date" class="form-control" id="editInEndDate" placeholder="Ingrese la fecha ">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="editInInstitution">Institución</label>
                    <select class="custom-select" id="editInInstitution">                      
                    </select>           
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label for="editInHoras">Horas</label>
                    <input type="number" class="form-control" id="editInHoras" placeholder="Ingrese el número de horas">
                </div>
            </div> --}}
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="editInMessage">Mensaje para el voluntario</label>
                    <textarea class="form-control" id="editInMessage" rows="3"></textarea>
                  </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="sedesTable">Sedes</label>           
                    <table id="editSedesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th data-field="id_detalle_jornada">ID Detalle Jornada</th>
                            <th class="d-none" data-field="id_sede">ID Sede</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="direccion" data-sortable="true" data-halign="center" data-align="center">Dirección</th>
                            <th data-field="cupo" data-sortable="true" data-halign="center" data-align="center">Cupo</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="editVoluntariesTable">Voluntarios</label>          
                    <table id="editVoluntariesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th data-field="id_detalle_jornada">ID Detalle Jornada</th>
                            <th class="d-none" data-field="id_voluntario">ID Voluntario</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                            <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                            <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                            <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                            <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                            <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveEditedVaccinationDay">Editar jornada</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
        </div>
      </div>
    </div>
  </div>

  <div id="modalViewJornadaDetail" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Datos de los Voluntarios</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="toolbar2">
                <div class="form-inline" role="form">
                    <button type="button" class="btn btn-primary" id="sendEmails">
                        <i class="far fa-envelope"></i>
                        Enviar Correo(s)
                    </button>
                </div>
            </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">           
                    <table id="viewDetailVoluntariesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc"
                    data-toolbar="#toolbar2">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_voluntario">ID</th>
                            <th class="d-none" data-field="id_detalle_jornada">ID Detalle Jornada</th>
                            <th class="d-none" data-field="id_insti">ID Institución</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                            <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                            <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                            <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                            <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                            <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                          </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
    <script src="{{ url('../resources/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ url('../resources/js/bootstrap-table-es-MX.js') }}"></script>
    <script>
        let $vaccinationDayTable = $('#vaccinationDayTable');
        let $voluntariesTable = $('#voluntariesTable');
        let $viewDetailVoluntariesTable = $('#viewDetailVoluntariesTable');
        let $editVoluntariesTable = $('#editVoluntariesTable');
        let $sedesTable = $('#sedesTable');
        let $editSedesTable = $('#editSedesTable');
        let idJornada = 0;

        $(document).ready(()=>{
            getAllJornadas();
            startEvents();
        });

        function defaultValues(){
            $('#inInstitution').empty();
            $('#inInstitution').append($('<option>').text('Eliga una institución').
                                attr({ 'value': 0, 'disabled': true, 'selected': true, 'hidden': true }));
            $('#editInInstitution').empty();
            $('#editInInstitution').append($('<option>').text('Eliga una institución').
                                attr({ 'value': 0, 'disabled': true, 'selected': true, 'hidden': true }));
        }

        function startEvents(){
            //evento para invocar la modal de creación de jornadas
            $('#createVaccinationDay').on('click', () => {
                $('#modalCreateVaccinationDay').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            //#region Modal events
            //evento para la busqueda de voluntarios por institución
            $('#inInstitution').on('change', () => {
                if($('#inInstitution').children('option:selected').val().length > 0){
                    getAllVoluntantiesByActive($('#inInstitution').children('option:selected').val(), 'create');
                }                            
            });

            $('#editInInstitution').on('change', () => {
                if($('#editInInstitution').children('option:selected').val().length > 0){
                    getAllVoluntantiesByActive($('#editInInstitution').children('option:selected').val(), 'edit');
                }                             
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalCreateVaccinationDay').on('show.bs.modal', () => {
                $voluntariesTable.bootstrapTable({data: []});
                $sedesTable.bootstrapTable({data: []});
                getAllInstitutions('create');
            });

            //Envento que limpia la lista de instituciones
            $('#modalCreateVaccinationDay').on('hide.bs.modal', () => {
                idJornada = 0;
                $('#inInstitution').empty();
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalEditJornada').on('show.bs.modal', () => {
                getAllInstitutions('edit');
            });

            //evento que limpia la lista de intiituciones
            $('#modalEditJornada').on('hide.bs.modal', () => {
                idJornada = 0;
                $('#editInInstitution').empty();
            });

            //evento para crear una nueva jornada
            $('#saveVaccinationDay').on('click', () => {           
                let idsVoluntarios = [];
                let idSedes = [];
                let idsDetalleJornada = [];

                if(validateFields('createJornada') == false){
                    for(let data in $voluntariesTable.bootstrapTable('getSelections')){
                        idsVoluntarios.push(
                            $voluntariesTable.bootstrapTable('getSelections')[data].id_voluntario
                        );
                    }

                    for(let data in $sedesTable.bootstrapTable('getSelections')){
                        idSedes.push(
                            $sedesTable.bootstrapTable('getSelections')[data].id_sede
                        );
                    }

                    for(let data in $editSedesTable.bootstrapTable('getSelections')){
                        idsDetalleJornada.push(
                            $editSedesTable.bootstrapTable('getSelections')[data].id_detalle_jornada
                        );
                    }

                    console.log(idJornada);
                    if(idJornada == 0){
                        let dataVaccinationDay = {
                            fecha_inicio: $('#inStartDate').val(),
                            fecha_fin: $('#inEndDate').val(),
                            mensaje: $('#inMessage').val(),
                            idsVoluntarios: idsVoluntarios,
                            idSedes: idSedes
                        };
                        insVaccinationDay(dataVaccinationDay);   
                    }else{
                        let dataVaccinationDay = {
                            id_jornada: idJornada,
                            fecha_inicio: $('#inStartDate').val(),
                            fecha_fin: $('#inEndDate').val(),
                            mensaje: $('#inMessage').val(),
                            idsVoluntarios: idsVoluntarios,
                            idSedes: idSedes,
                            idsDetalleJornada: idsDetalleJornada
                        };
                        updVaccinationDay(dataVaccinationDay, 'create');
                    }
                }                                
            });

            //evento para editar una jornada
            $('#saveEditedVaccinationDay').on('click', () => {
                let idsVoluntarios = [];
                let idSedes = [];
                let idsDetalleJornada = [];

                if(validateFields('editJornada') == false){
                    for(let data in $editVoluntariesTable.bootstrapTable('getSelections')){
                    idsVoluntarios.push(
                        $editVoluntariesTable.bootstrapTable('getSelections')[data].id_voluntario
                        );
                    }

                    for(let data in $editSedesTable.bootstrapTable('getSelections')){
                        idSedes.push(
                            $editSedesTable.bootstrapTable('getSelections')[data].id_sede
                        );
                    }

                    for(let data in $editSedesTable.bootstrapTable('getSelections')){
                        idsDetalleJornada.push(
                            $editSedesTable.bootstrapTable('getSelections')[data].id_detalle_jornada
                        );
                    }

                    let dataVaccinationDay = {
                        id_jornada: idJornada,
                        fecha_inicio: $('#editInStartDate').val(),
                        fecha_fin: $('#editInEndDate').val(),
                        mensaje: $('#editInMessage').val(),
                        idsVoluntarios: idsVoluntarios,
                        idSedes: idSedes,
                        idsDetalleJornada: idsDetalleJornada
                    };
                    updVaccinationDay(dataVaccinationDay, 'edit');  
                }
            });
            //#endregion

            $('#sendEmails').on('click', () => {
                let idsDetalleJornadas = [];

                if(validateFields('sendEmail') == false){
                    for(let data in $viewDetailVoluntariesTable.bootstrapTable('getSelections')){
                    idsDetalleJornadas.push(
                        $viewDetailVoluntariesTable.bootstrapTable('getSelections')[data].id_detalle_jornada
                        );
                    }
                    enviarCorreoJornada(idsDetalleJornadas); 
                }
            });
        }

        function getAllInstitutions(actionType){
            $.ajax({
                url: "vaccinationDay/getAllInstitutions/",
                type: "GET",
                success: function (response) {
                    defaultValues();
                    if(actionType == 'create'){
                        for(let i in response.data){
                        $('#inInstitution').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_insti, 'disabled': false, 'selected': false, 'hidden': false }));
                        }
                    }else if(actionType == 'edit'){
                        for(let i in response.data){
                        $('#editInInstitution').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_insti, 'disabled': false, 'selected': false, 'hidden': false }));
                        }
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllJornadas(){
            $.ajax({
                url: "vaccinationDay/show/",
                type: "GET",
                success: function (response) {
                    //console.log(response.data);
                    $vaccinationDayTable.bootstrapTable('destroy');
                    $vaccinationDayTable.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllVoluntanties(){      
            $.ajax({
                url: "vaccinationDay/getAllVoluntanties/",
                type: "GET",
                success: function (response) {
                    console.log(response);
                    $voluntariesTable.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });            
        }

        function getAllVoluntantiesByActive(id_institution, actionType){
            $.ajax({
                url: "vaccinationDay/getAllVoluntantiesByActive/" + id_institution,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    if(response.data.length > 0){
                        if(actionType == 'create'){
                        getAllSedesByIdTown(response.data[0].id_instituciones_municipio, 'create');
                        $voluntariesTable.bootstrapTable('destroy');
                        $voluntariesTable.bootstrapTable({data: response.data});
                        } else if(actionType == 'edit'){
                            getAllSedesByIdTown(response.data[0].id_instituciones_municipio, 'edit');
                            $editVoluntariesTable.bootstrapTable('destroy');
                            $editVoluntariesTable.bootstrapTable({data: response.data});
                        }
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllSedesByIdTown(id_town, actionType){
            console.log(id_town);
            $.ajax({
                url: "vaccinationDay/getAllSedesByIdTown/" + id_town,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    if(actionType == 'create'){
                        $sedesTable.bootstrapTable('destroy');
                        $sedesTable.bootstrapTable({data: response.data});
                    } else if(actionType == 'edit'){
                        $editSedesTable.bootstrapTable('destroy');
                        $editSedesTable.bootstrapTable({data: response.data});
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        //#region Grupo de funciones para obtener la información de las jornadas a editar.
        function getJornada(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornada/" + id_jornada,
                type: "GET",
                success: function (response) {
                    idJornada = response.data.id_jornada;
                    $('#editInStartDate').val(response.data.fecha_inicio);
                    $('#editInEndDate').val(response.data.fecha_fin);
                    $('#editInMessage').text(response.data.mensaje);

                    getJornadaForVoluntaries(id_jornada);
                    getJornadaForSedes(id_jornada);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getJornadaForVoluntaries(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaForVoluntaries/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response.data);

                    let voluntaryData = Array.from(new Set(response.data.map(x => x.id_voluntario))).
                    map(id_voluntario => {
                        return {
                            id_voluntario: id_voluntario,
                            id_detalle_jornada: response.data.find(s => s.id_voluntario === id_voluntario).id_detalle_jornada,
                            nombre: response.data.find(s => s.id_voluntario === id_voluntario).nombre,
                            ape_pat: response.data.find(s => s.id_voluntario === id_voluntario).ape_pat,
                            ape_mat: response.data.find(s => s.id_voluntario === id_voluntario).ape_mat,
                            email: response.data.find(s => s.id_voluntario === id_voluntario).email,
                            tel: response.data.find(s => s.id_voluntario === id_voluntario).tel,
                            nombre_municipio: response.data.find(s => s.id_voluntario === id_voluntario).nombre_municipio,
                            nombre_institucion: response.data.find(s => s.id_voluntario === id_voluntario).nombre_institucion
                        };
                    });

                    $editVoluntariesTable.bootstrapTable('destroy');
                    $editVoluntariesTable.bootstrapTable({data: voluntaryData});
                    $editVoluntariesTable.bootstrapTable('checkAll');
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getJornadaForSedes(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaForSedes/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response.data);

                    let sedeData = Array.from(new Set(response.data.map(x => x.id_sede))).
                    map(id_sede => {
                        return {
                            id_sede: id_sede,
                            id_detalle_jornada: response.data.find(s => s.id_sede === id_sede).id_detalle_jornada,
                            nombre: response.data.find(s => s.id_sede === id_sede).nombre,
                            direccion: response.data.find(s => s.id_sede === id_sede).direccion,
                            cupo: response.data.find(s => s.id_sede === id_sede).cupo
                        };
                    });

                    $editSedesTable.bootstrapTable('destroy');
                    $editSedesTable.bootstrapTable({data: sedeData});
                    $editSedesTable.bootstrapTable('checkAll');
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }
        //#endregion

        function getJornadaDetail(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaDetail/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    let voluntaryData = Array.from(new Set(response.data.map(x => x.id_voluntario))).
                    map(id_voluntario => {
                        return {
                            id_voluntario: id_voluntario,
                            id_detalle_jornada: response.data.find(s => s.id_voluntario === id_voluntario).id_detalle_jornada,
                            id_insti: response.data.find(s => s.id_voluntario === id_voluntario).id_insti,
                            nombre: response.data.find(s => s.id_voluntario === id_voluntario).nombre,
                            ape_pat: response.data.find(s => s.id_voluntario === id_voluntario).ape_pat,
                            ape_mat: response.data.find(s => s.id_voluntario === id_voluntario).ape_mat,
                            email: response.data.find(s => s.id_voluntario === id_voluntario).email,
                            tel: response.data.find(s => s.id_voluntario === id_voluntario).tel,
                            nombre_municipio: response.data.find(s => s.id_voluntario === id_voluntario).nombre_municipio,
                            nombre_institucion: response.data.find(s => s.id_voluntario === id_voluntario).nombre_institucion
                        };
                    });

                    console.log(voluntaryData);
                    $viewDetailVoluntariesTable.bootstrapTable('destroy');
                    $viewDetailVoluntariesTable.bootstrapTable({data: voluntaryData});
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

        function getLastJornada(){
            $.ajax({
                url: "vaccinationDay/getLastJornada/",
                type: "GET",
                success: function (response) {
                    idJornada = parseInt(response.data.id_jornada);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function insVaccinationDay(data){
            $.ajax({
                url: "vaccinationDay/store",
                type: "POST",
                data: {
                    fecha_inicio: data.fecha_inicio,
                    fecha_fin: data.fecha_fin,
                    id_insti: data.id_insti,
                    mensaje: data.mensaje,
                    idsVoluntarios: data.idsVoluntarios,
                    idSedes: data.idSedes,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea agregar mas voluntarios?',
                        confirmButtonColor: '#3085d6',
                        showDenyButton: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        confirmButtonText: 'Aceptar',
                        denyButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getLastJornada();   
                            } else if(result.isDenied){
                                idJornada = 0;
                                $('#modalCreateVaccinationDay').modal('hide');
                                location.reload();
                            }
                        });
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function updVaccinationDay(data, actionType){
            $.ajax({
                url: "vaccinationDay/update",
                type: "POST",
                data: {
                    id_jornada: data.id_jornada,
                    fecha_inicio: data.fecha_inicio,
                    fecha_fin: data.fecha_fin,
                    id_insti: data.id_insti,
                    mensaje: data.mensaje,
                    idsVoluntarios: data.idsVoluntarios,
                    idSedes: data.idSedes,
                    idsDetalleJornada: data.idsDetalleJornada,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea agregar mas voluntarios?',
                        confirmButtonColor: '#3085d6',
                        showDenyButton: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        confirmButtonText: 'Aceptar',
                        denyButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if(actionType == 'create'){
                                    getLastJornada();
                                }                             
                            } else if(result.isDenied){
                                if(actionType == 'create'){
                                    idJornada = 0;
                                    $('#modalCreateVaccinationDay').modal('hide');
                                    location.reload();
                                } else if(actionType == 'edit'){
                                    idJornada = 0;
                                    $('#modalEditJornada').modal('hide');
                                    location.reload();                  
                                }
                            }
                        });
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function deleteJornada(id_jornada){
            $.ajax({
                url: "vaccinationDay/destroy",
                type: "POST",
                data: {
                    id_jornada: id_jornada,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function enviarCorreoJornada(idsDetalleJornadas){
            $.ajax({
                url: "vaccinationDay/sendemail",
                type: "POST",
                data: {
                    ids_detalle_jornadas: idsDetalleJornadas,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: () => {
                    Swal.fire({
                        showConfirmButton: false,
                        imageUrl: '{{ url("../resources/image/loading.png") }}',
                        title: 'Por favor espere.',
                        text: 'enviando correo(s)',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });  
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.mensaje,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function validateFields(actionType){
            let isEmpty;
            if(actionType == 'createJornada'){
                if($('#inStartDate').val().length > 0 
                && $('#inEndDate').val().length > 0 
                && $('#inMessage').val().length > 0
                && $sedesTable.bootstrapTable('getSelections').length > 0
                && $voluntariesTable.bootstrapTable('getSelections').length > 0){
                    isEmpty = false;                
                } else {
                    isEmpty = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Debe llenar todos los campos, asi como elegir al menos un voluntario y una sede.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    }); 
                }
            } 
            else if(actionType == 'editJornada'){
                if($('#editInStartDate').val().length > 0 
                && $('#editInEndDate').val().length > 0 
                && $('#editInMessage').val().length > 0
                && $editSedesTable.bootstrapTable('getSelections').length > 0
                && $editVoluntariesTable.bootstrapTable('getSelections').length > 0){
                    isEmpty = false;                 
                } else {
                    isEmpty = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Debe llenar todos los campos, asi como elegir al menos un voluntario y una sede.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    }); 
                }             
            } 
            else if(actionType == 'sendEmail'){
                if($viewDetailVoluntariesTable.bootstrapTable('getSelections').length > 0){
                    isEmpty = false;                 
                } else {
                    isEmpty = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Debe elegir al menos un voluntario.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    }); 
                }  
            }
            return isEmpty;
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="detail mr-2" href="javascript:void(0)" title="Detalle">',
            '<i class="fas fa-info-circle"></i>',
            '</a>',
            '<a class="edit mr-2" href="javascript:void(0)" title="Editar">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove mr-2" href="javascript:void(0)" title="Elimnar">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .edit': function (e, value, row, index) {
                $('#modalEditJornada').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getJornada(row.id_jornada);
            },

            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    title: 'Advertencia',
                    text: "¿Está seguro que desea eliminar esta jornada?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteJornada(row.id_jornada);
                    }
                    });
            },

            'click .detail': function (e, value, row, index) {
                $('#modalViewJornadaDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getJornadaDetail(row.id_jornada);
            }
        }
    </script>
@endsection