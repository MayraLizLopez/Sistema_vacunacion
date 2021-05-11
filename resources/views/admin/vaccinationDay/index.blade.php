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

        #button-largo{
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
        <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
            Registrar jornada
        </button>
    </div>
    {{-- <a href="{{ route('downloadFiles') }}">Descargar archivos</a> --}}
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
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
                    <th data-field="folio" data-sortable="true" data-halign="center" data-align="center">Folio</th>
                    <th data-field="fecha_inicio" data-sortable="true" data-halign="center" data-align="center">Fecha Inicio</th>
                    <th data-field="fecha_fin" data-sortable="true" data-halign="center" data-align="center">Fecha Fin</th>
                    <th data-field="total_voluntarios" data-sortable="true" data-halign="center" data-align="center">Total de Voluntarios</th>
                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="nombres_sedes" data-sortable="true" data-halign="center" data-align="center">Sedes</th>
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
            <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
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
                    <label for="inTown">Municipio</label>
                    <select class="custom-select" id="inTown">
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
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inFile" lang="es" multiple>
                      <label class="custom-file-label" for="inFile" data-browse="Anexo(s)">Cada uno de los archivos no deben ser mayor a 2MB,
                           de lo contrario estos no se guardaran.</label>
                    </div>
                  </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
                <div id="toolbar2">
                    <button class="btn btn-primary" id="btnFilterVoluntary">Filtrar Voluntarios</button>
                </div>
                <div class="table-responsive"> 
                    <label for="institutionsTable">Instituciones</label>
                    <table id="institutionsTable" class="table table-striped table-bordered"
                    data-locale="es-MX"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc"
                    data-toolbar="#toolbar2"> 
                        <thead>
                            <tr>
                                <th data-checkbox="true"></th>
                                <th class="d-none" data-field="id_insti">ID</th>
                                <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                                <th data-field="domicilio" data-sortable="true" data-halign="center" data-align="center">Domicilio</th>
                                <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="sedesTable">Sedes</label>           
                    <table id="sedesTable" class="table table-striped table-bordered"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_sede">ID</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="direccion" data-sortable="true" data-halign="center" data-align="center">Dirección</th>
                            <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
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
                    data-pagination="false"
                    data-height="300"
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
            <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
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
                    <label for="editInTown">Municipio</label>
                    <select class="custom-select" id="editInTown">
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
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="editInFile" lang="es" multiple>
                      <label class="custom-file-label" for="inFile" data-browse="Anexo(s)">Cada uno de los archivos no deben ser mayor a 2MB,
                           de lo contrario estos no se guardaran.</label>
                    </div>
                  </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
                <div id="toolbar3">
                    <button class="btn btn-primary" id="btnEditFilterVoluntary">Filtrar Voluntarios</button>
                </div>
                <div class="table-responsive"> 
                    <label for="editInstitutionsTable">Instituciones</label>
                    <table id="editInstitutionsTable" class="table table-striped table-bordered"
                    data-locale="es-MX"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc"
                    data-toolbar="#toolbar3">
                        <thead>
                            <tr>
                                <th data-checkbox="true"></th>
                                <th class="d-none" data-field="id_insti">ID</th>
                                <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                                <th data-field="domicilio" data-sortable="true" data-halign="center" data-align="center">Domicilio</th>
                                <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="editSedesTable">Sedes</label>           
                    <table id="editSedesTable" class="table table-striped table-bordered"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
                            <th class="d-none" data-field="id_detalle_jornada">ID Detalle Jornada</th>
                            <th class="d-none" data-field="id_sede">ID Sede</th>
                            <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                            <th data-field="direccion" data-sortable="true" data-halign="center" data-align="center">Dirección</th>
                            <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
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
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc">
                        <thead>
                          <tr>
                            <th data-checkbox="true"></th>
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
        <div class="modal-footer mr-auto">
            <button type="button" class="btn btn-success botonEnviar" id="saveEditedVaccinationDay">Editar jornada</button>
          <button type="button" class="btn btn-secondary" id="button-largo" data-dismiss="modal">Cancelar</button>        
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
            <div id="toolbar4">
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
                    data-toolbar="#toolbar4">
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
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script>
        let $vaccinationDayTable = $('#vaccinationDayTable');
        let $voluntariesTable = $('#voluntariesTable');
        let $viewDetailVoluntariesTable = $('#viewDetailVoluntariesTable');
        let $editVoluntariesTable = $('#editVoluntariesTable');
        let $institutionsTable = $('#institutionsTable');
        let $editInstitutionsTable = $('#editInstitutionsTable');
        let $sedesTable = $('#sedesTable');
        let $editSedesTable = $('#editSedesTable');
        let idJornada = 0;

        $(document).ready(()=>{
            getAllJornadas();
            startEvents();
        });

        function defaultValues(actionType){
            if(actionType == 'create'){
                $('#inTown').empty();
                $('#inTown').append($('<option>').text('Eliga un municipio').
                                    attr({ 'value': 0, 'disabled': true, 'selected': true, 'hidden': true }));
            } else if(actionType == 'edit'){
                $('#editInTown').empty();
                $('#editInTown').append($('<option>').text('Eliga un municipio').
                                    attr({ 'value': 0, 'disabled': true, 'selected': true, 'hidden': true })); 
            }                
        }

        function startEvents(){
            $('#inFile').on('change', (e) => {
                //get the file name
                let fileNames = e.target.files;
                let names = [];
                //replace the "Choose a file" label
                for(let i = 0; i < fileNames.length; i++){
                    names.push(fileNames[i].name);
                }

                $('#inFile').next('.custom-file-label').html(names.join(', '));
            });


            $('#editInFile').on('change', (e) => {
                //get the file name
                let fileNames = e.target.files;
                let names = [];
                //replace the "Choose a file" label
                for(let i = 0; i < fileNames.length; i++){
                    names.push(fileNames[i].name);
                }

                $('#editInFile').next('.custom-file-label').html(names.join(', '));
            });

            //#region Modal events
            //evento para la busqueda de voluntarios por institución
            $('#inTown').on('change', () => {
                if($('#inTown').children('option:selected').val().length > 0){
                    getAllSedesByIdTown($('#inTown').children('option:selected').val(), 'create');
                }                            
            });

            $('#editInTown').on('change', () => {
                if($('#editInTown').children('option:selected').val().length > 0){
                    getAllSedesByIdTown($('#editInTown').children('option:selected').val(), 'edit');
                }                             
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalCreateVaccinationDay').on('show.bs.modal', () => {
                getAllTowns('create');
                getAllInstitutions('create');
                $voluntariesTable.bootstrapTable({data: []});
                $sedesTable.bootstrapTable({data: []});
            });

            //Envento que limpia la lista de instituciones
            $('#modalCreateVaccinationDay').on('hide.bs.modal', () => {
                idJornada = 0;
                $('#inTown').empty();
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalEditJornada').on('show.bs.modal', () => {
                getAllTowns('edit');
                getAllInstitutions('edit');
            });

            //evento que limpia la lista de intiituciones
            $('#modalEditJornada').on('hide.bs.modal', () => {
                idJornada = 0;
                $('#editInTown').empty();
            });

            //evento para invocar la modal de creación de jornadas
            $('#createVaccinationDay').on('click', () => {
                $('#modalCreateVaccinationDay').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            //evento para crear una nueva jornada
            $('#saveVaccinationDay').on('click', () => {
                let form = new FormData();
                let filesForm = new FormData();
                 
                let voluntariesTable = $voluntariesTable.bootstrapTable('getSelections');
                let sedesTable = $sedesTable.bootstrapTable('getSelections');

                let anexoFiles =  document.getElementById('inFile');
                
                console.log(anexoFiles.files[0].size);
                
                if(validateFields('createJornada') == false){
                    if(validateDateRange('create') == true){
                        let idsVoluntarios = voluntariesTable.map(element => element.id_voluntario);
                        let idSedes = sedesTable.map(element => element.id_sede);

                        //console.log(idJornada);
                        if(idJornada == 0){
                            form.set('fecha_inicio', $('#inStartDate').val());
                            form.set('fecha_fin', $('#inEndDate').val());
                            form.set('mensaje', $('#inMessage').val());
                            form.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                            form.set('idSedes', JSON.stringify(idSedes));

                            insVaccinationDay(form);

                            if(anexoFiles.files != []){
                                for(let i = 0; i < anexoFiles.files.length; i++){
                                    if(anexoFiles.files[i].size <= 2097152){ // 2MB
                                        filesForm.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                                        filesForm.set('file', anexoFiles.files[i]);

                                        insAnexos(filesForm);
                                    }
                                }
                            }
                        }else{
                            form.set('id_jornada', idJornada);
                            form.set('fecha_inicio', $('#inStartDate').val());
                            form.set('fecha_fin', $('#inEndDate').val());
                            form.set('mensaje', $('#inMessage').val());
                            form.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                            form.set('idSedes', JSON.stringify(idSedes));

                            updVaccinationDay(form, 'create');

                            if(anexoFiles.files != []){
                                for(let i = 0; i < anexoFiles.files.length; i++){
                                    if(anexoFiles.files[i].size <= 2097152){ // 2MB
                                        filesForm.set('id_jornada', idJornada);
                                        filesForm.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                                        filesForm.set('file', anexoFiles.files[i]);

                                        updAnexos(filesForm); 
                                    }
                                }
                            }
                        }
                    }
                }                                
            });

            //evento para editar una jornada
            $('#saveEditedVaccinationDay').on('click', () => {
                let form = new FormData();
                let filesForm = new FormData();

                let editVoluntariesTable = $editVoluntariesTable.bootstrapTable('getSelections');
                let editSedesTable = $editSedesTable.bootstrapTable('getSelections');

                let anexoFiles =  document.getElementById('editInFile');

                if(validateFields('editJornada') == false){
                    if(validateDateRange('edit') == true){
                        let idsVoluntarios = editVoluntariesTable.map(element => element.id_voluntario);
                        let idSedes = editSedesTable.map(element => element.id_sede);

                        form.set('id_jornada', idJornada);
                        form.set('fecha_inicio', $('#editInStartDate').val());
                        form.set('fecha_fin', $('#editInEndDate').val());
                        form.set('mensaje', $('#editInMessage').val());
                        form.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                        form.set('idSedes', JSON.stringify(idSedes));

                        updVaccinationDay(form, 'edit');

                        if(anexoFiles.files != []){
                            for(let i = 0; i < anexoFiles.files.length; i++){
                                if(anexoFiles.files[i].size <= 2097152){ // 2MB
                                    filesForm.set('id_jornada', idJornada);
                                    filesForm.set('idsVoluntarios', JSON.stringify(idsVoluntarios));
                                    filesForm.set('file', anexoFiles.files[i]);

                                    updAnexos(filesForm);
                                }
                            }
                        }
                    }                   
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

            $('#btnFilterVoluntary').on('click', () => {
                let institutionsTable = $institutionsTable.bootstrapTable('getSelections');
                let idsIinstitution = institutionsTable.map(element => element.id_insti);

                getVoluntariesByInstitution(idsIinstitution, 'create');
            });

            $('#btnEditFilterVoluntary').on('click', () => {
                let editInstitutionsTable = $editInstitutionsTable.bootstrapTable('getSelections');
                let idsIinstitution = editInstitutionsTable.map(element => element.id_insti);

                getVoluntariesByInstitution(idsIinstitution, 'edit');
            });
        }

        function getAllTowns(actionType){
            $.ajax({
                url: "vaccinationDay/getAllTowns/",
                type: "GET",
                success: function (response) {                   
                    if(actionType == 'create'){
                        defaultValues('create');
                        for(let i in response.data){
                        $('#inTown').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_municipio, 'disabled': false, 'selected': false, 'hidden': false }));
                        }
                    }else if(actionType == 'edit'){
                        defaultValues('edit');
                        for(let i in response.data){
                        $('#editInTown').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_municipio, 'disabled': false, 'selected': false, 'hidden': false }));
                        }
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
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
                        $institutionsTable.bootstrapTable('destroy');
                        $institutionsTable.bootstrapTable({data: response.data});
                    }else if(actionType == 'edit'){
                        $editInstitutionsTable.bootstrapTable('destroy');
                        $editInstitutionsTable.bootstrapTable({data: response.data});
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
                    //console.log(response);
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
                    //console.log(response);
                    $voluntariesTable.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });            
        }

        function getVoluntariesByInstitution(ids_institution, actionType){
            $.ajax({
                url: "vaccinationDay/getVoluntariesByInstitution",
                type: "POST",
                data: {
                    ids_institution: ids_institution,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    //console.log(response);
                    if(response.data.length > 0){
                        if(actionType == 'create'){
                            $voluntariesTable.bootstrapTable('destroy');
                            $voluntariesTable.bootstrapTable({data: response.data});
                        } 
                        else if(actionType == 'edit'){
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
            //console.log(id_town);
            $.ajax({
                url: "vaccinationDay/getAllSedesByIdTown/" + id_town,
                type: "GET",
                success: function (response) {
                    //console.log(response);
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

                    getFilesJornada(id_jornada);
                    getJornadaForVoluntaries(id_jornada);
                    getJornadaForSedes(id_jornada);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getFilesJornada(id_jornada){
            $.ajax({
                url: "vaccinationDay/getFilesJornada/" + id_jornada,
                type: "GET",
                success: function (response) {
                    if(response.data != []){
                        let filesName = response.data.map(item => item.nombre);
                        $('#editInFile').next('.custom-file-label').html(filesName.join(', '));
                    }
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
                    //console.log(response.data);

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
                    //console.log(response.data);

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
                    //console.log(response);
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

                    //console.log(voluntaryData);
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea realizar cambios antes de salir?',
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
                    //console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function insAnexos(data){
            $.ajax({
                url: "vaccinationDay/storeFiles",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function updAnexos(data){
            $.ajax({
                url: "vaccinationDay/updateFiles",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Hecho',
                        text: response.message + '\n¿Desea realizar cambios antes de salir?',
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
                    //console.log(response);
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
                    //console.log(response);
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
                        imageUrl: "{{ asset('public/assets/images/loading.png') }}",
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
                    //console.log(response);
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
            '<a class="remove mr-2" href="javascript:void(0)" title="Eliminar">',
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
                    title: '¿Está seguro que desea eliminar esta jornada?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6A7379',
                    confirmButtonText: 'Eliminar',
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

        function  validateDateRange(actionType){
            let inStartDate = Date.parse($('#inStartDate').val());
            let inEndDate = Date.parse($('#inEndDate').val());
            let editInStartDate = Date.parse($('#editInStartDate').val());
            let editInEndDate = Date.parse($('#editInEndDate').val());

            if(actionType == 'create'){
                if(inStartDate < inEndDate){ 
                    return true;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'La fecha inicial no debe ser mayo a la final',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    });
                    return false;
                }
            } else if(actionType == 'edit'){
                if(editInStartDate < editInEndDate){
                    return true;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'La fecha inicial no debe ser mayo a la final',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    });
                    return false;
                }
            }
        }
    </script>
@endsection