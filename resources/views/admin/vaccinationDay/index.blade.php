@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Jornada de vacunación</h1>
<p class="mb-4">La siguiente vista muestra la tabla de todas las jornadas activas, así como la creación y edición de las mismas.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Voluntarios</h6>
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-2 float-right" id="createVaccinationDay">
            <i class="fas fa-plus"></i>
            Crear jornada
        </button>
        <div class="table-responsive">           
            <table id="vaccinationDayTable" class="table table-striped table-bordered"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true"
            data-search="true"
            data-sort-name="nombre"
            data-sort-order="desc">
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
                    <input type="date" class="form-control" id="inEndDate" placeholder="Ingrese la fecha ">
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
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inMessage">Mensaje para el voluntario</label>
                    <textarea class="form-control" id="inMessage" rows="3"></textarea>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">           
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
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveVaccinationDay">Crear jornada</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
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
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="editInMessage">Mensaje para el voluntario</label>
                    <textarea class="form-control" id="editInMessage" rows="3"></textarea>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">           
                    <table id="editVoluntariesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_insti">ID Institución</th>
                            <th class="d-none" data-field="id_jornada">ID Jornada</th>
                            <th class="d-none" data-field="id_detalle_jornada">ID Detalle Jornada</th>
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
          <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary mb-2 float-right" id="sendEmails">
                    <i class="far fa-envelope"></i>
                    Enviar Correos
                </button>
                <div class="table-responsive">           
                    <table id="viewDetailVoluntariesTable" class="table table-striped table-bordered"
                    data-pagination="true"
                    data-sort-name="nombre"
                    data-sort-order="desc">
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
        let idJornada = 0;

        $(document).ready(()=>{
            getAllJornadas();
            startEvents();
        });

        function defaultValues(){
            $('#inInstitution').empty();
            $('#inInstitution').append($('<option>').text('Eliga una institución').
                                attr({ 'value': '', 'disabled': true, 'selected': true, 'hidden': true }));
            $('#editInInstitution').empty();
            $('#editInInstitution').append($('<option>').text('Eliga una institución').
                                attr({ 'value': '', 'disabled': true, 'selected': true, 'hidden': true }));
        }

        function startEvents(){
            //evento para invocar la modal de creación de jornadas
            $('#createVaccinationDay').on('click', () => {
                $('#modalCreateVaccinationDay').modal('show');
            });

            //#region Modal events
            //evento para la busqueda de voluntarios por institución
            $('#inInstitution').on('change', () => {
                if($('#inInstitution').children('option:selected').val().length <= 0){
                } else {
                    getAllVoluntantiesByActive($('#inInstitution').children('option:selected').val(), 'create');
                }                               
            });

            $('#editInInstitution').on('change', () => {
                if($('#editInInstitution').children('option:selected').val().length <= 0){
                } else {
                    getAllVoluntantiesByActive($('#editInInstitution').children('option:selected').val(), 'edit');
                }                               
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalCreateVaccinationDay').on('show.bs.modal', () => {
                getAllInstitutions('create');
            });

            //Envento que limpia la lista de instituciones
            $('#modalCreateVaccinationDay').on('hide.bs.modal', () => {
                $('#inInstitution').empty();
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalEditJornada').on('show.bs.modal', () => {
                getAllInstitutions('edit');
            });

            //evento que limpia la lista de intiituciones
            $('#modalEditJornada').on('hide.bs.modal', () => {
                $('#editInInstitution').empty();
            });

            //evento para crear una nueva jornada
            $('#saveVaccinationDay').on('click', () => {           
                let idsVoluntarios = [];

                for(let data in $voluntariesTable.bootstrapTable('getSelections')){
                    idsVoluntarios.push(
                        $voluntariesTable.bootstrapTable('getSelections')[data].id_voluntario
                    );
                }
                console.log(idJornada);
                if(idJornada == 0){
                    let dataVaccinationDay = {
                        fecha_inicio: $('#inStartDate').val(),
                        fecha_fin: $('#inEndDate').val(),
                        mensaje: $('#inMessage').val(),
                        idsVoluntarios: idsVoluntarios
                    };
                    insVaccinationDay(dataVaccinationDay);   
                }else{
                    let dataVaccinationDay = {
                        id_jornada: idJornada,
                        fecha_inicio: $('#inStartDate').val(),
                        fecha_fin: $('#inEndDate').val(),
                        mensaje: $('#inMessage').val(),
                        idsVoluntarios: idsVoluntarios
                    };
                    updVaccinationDay(dataVaccinationDay, 'create');
                }                                 
            });

            //evento para editar una jornada
            $('#saveEditedVaccinationDay').on('click', () => {
                let idsVoluntarios = [];

                for(let data in $editVoluntariesTable.bootstrapTable('getSelections')){
                    idsVoluntarios.push(
                        $editVoluntariesTable.bootstrapTable('getSelections')[data].id_voluntario
                    );
                }

                let dataVaccinationDay = {
                    id_jornada: idJornada,
                    fecha_inicio: $('#editInStartDate').val(),
                    fecha_fin: $('#editInEndDate').val(),
                    mensaje: $('#editInMessage').val(),
                    idsVoluntarios: idsVoluntarios
                };
                updVaccinationDay(dataVaccinationDay, 'edit');            
            });
            //#endregion

            $('#sendEmails').on('click', () => {
                let idsDetalleJornadas = [];

                for(let data in $viewDetailVoluntariesTable.bootstrapTable('getSelections')){
                    idsDetalleJornadas.push(
                        $viewDetailVoluntariesTable.bootstrapTable('getSelections')[data].id_detalle_jornada
                    );
                }
                enviarCorreoJornada(idsDetalleJornadas);
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
                    if(actionType == 'create'){
                        $voluntariesTable.bootstrapTable('destroy');
                        $voluntariesTable.bootstrapTable({data: response.data});
                    } else if(actionType == 'edit'){
                        $editVoluntariesTable.bootstrapTable('destroy');
                        $editVoluntariesTable.bootstrapTable({data: response.data});
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getJornada(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornada/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    idJornada = response.data[0].id_jornada;
                    $('#editInStartDate').val(response.data[0].fecha_inicio);
                    $('#editInEndDate').val(response.data[0].fecha_fin);
                    $('#editInMessage').text(response.data[0].mensaje);
                    $editVoluntariesTable.bootstrapTable('destroy');
                    $editVoluntariesTable.bootstrapTable({data: response.data});
                    $editVoluntariesTable.bootstrapTable('checkAll');
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getJornadaDetail(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaDetail/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    $viewDetailVoluntariesTable.bootstrapTable('destroy');
                    $viewDetailVoluntariesTable.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
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
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea agregar mas voluntarios?',
                        confirmButtonColor: '#3085d6',
                        showDenyButton: true,
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
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea agregar mas voluntarios?',
                        confirmButtonColor: '#3085d6',
                        showDenyButton: true,
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
                success: function (response) {
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Hecho',
                    //     text: response.message,
                    //     confirmButtonColor: '#3085d6',
                    //     confirmButtonText: 'Aceptar',
                    //     }).then((result) => {
                    //         if (result.isConfirmed) {
                    //             location.reload();
                    //         }
                    //     });
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="detail mr-2" href="javascript:void(0)" title="Detalle">',
            '<i class="fas fa-info-circle"></i>',
            '</a>',
            '<a class="like mr-2" href="javascript:void(0)" title="Editar">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove mr-2" href="javascript:void(0)" title="Elimnar">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .like': function (e, value, row, index) {
                $('#modalEditJornada').modal('show');
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
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteJornada(row.id_jornada);
                    }
                    });
            },

            'click .detail': function (e, value, row, index) {
                $('#modalViewJornadaDetail').modal('show');
                getJornadaDetail(row.id_jornada);
            }
        }
    </script>
@endsection