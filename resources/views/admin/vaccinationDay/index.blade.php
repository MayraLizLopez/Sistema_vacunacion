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
            data-search="true"
            data-sort-name="nombre"
            data-sort-order="desc">
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
                        <option value="" selected disabled hidden>Eliga una institución</option>
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
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script src="{{ url("../resources/js/bootstrap-table-es-MX.js") }}"></script>
    <script>
        let $table = $('#voluntariesTable');
        let $voluntariesTable = $('#voluntariesTable');

        $(document).ready(()=>{
            startEvents();
        });

        function startEvents(){
            //evento para invocar la modal de creación de jornadas
            $('#createVaccinationDay').on('click', (e) => {
                $('#modalCreateVaccinationDay').modal('show');
            });

            //#region Modal events
            //evento para la busqueda de voluntarios por institución
            $('#inInstitution').on('change', () => {
                if($('#inInstitution').children('option:selected').val().length <= 0){
                } else {
                    getAllVoluntantiesByActive($('#inInstitution').children('option:selected').val());
                }                               
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalCreateVaccinationDay').on('show.bs.modal', () => {
                getAllInstitutions();
            });


            //evento para crear una nueva jornada
            $('#saveVaccinationDay').on('click', () => {
                let detalleJornada = [];
                for(let data in $voluntariesTable.bootstrapTable('getSelections')){
                    detalleJornada.push({
                        id_insti: $voluntariesTable.bootstrapTable('getSelections')[data].id_insti,
                        id_voluntario: $voluntariesTable.bootstrapTable('getSelections')[data].id_voluntario
                    });
                }

                let dataVaccinationDay = {
                    fecha_inicio: $('#inStartDate').val(),
                    fecha_fin: $('#inEndDate').val(),
                    mensaje: $('#inMessage').val(),
                    detalleJornada: detalleJornada
                };
                insVaccinationDay(dataVaccinationDay);                                    
            });
            //#endregion
        }

        function getAllInstitutions(){
            $.ajax({
                url: "vaccinationDay/getAllInstitutions/",
                type: "GET",
                success: function (response) {
                    for(let i in response.data){
                        $('#inInstitution').append($('<option>').text(response.data[i].nombre).
                                attr({ 'value': response.data[i].id_insti, 'disabled': false, 'selected': false, 'hidden': false }));
                    }
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function getAllVoluntantiesByActive(id_institution){
            $.ajax({
                url: "vaccinationDay/getAllVoluntantiesByActive/" + id_institution,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    $voluntariesTable.bootstrapTable('destroy');
                    $voluntariesTable.bootstrapTable({data: response.data});
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function insVaccinationDay(data){
            console.log(data);
            $.ajax({
                url: "vaccinationDay/store",
                type: "POST",
                data: {
                    fecha_inicio: data.fecha_inicio,
                    fecha_fin: data.fecha_fin,
                    id_insti: data.id_insti,
                    mensaje: data.mensaje,
                    detalleJornada: data.detalleJornada,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection