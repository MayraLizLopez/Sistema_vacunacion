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

        .horas {
            max-width: 800px;
            margin: 1.75rem auto;
        }

        .jornadas-aceptadas{
            max-width: 2000px;
            margin: 1.75rem auto;
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

<div class="card shadow mb-4">
    <div class="card-body">
        <div id="toolbar1">
            <div class="form-inline" role="form">
                <button type="button" class="btn btn-primary" id="createVaccinationDay">
                <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
                    Registrar jornada
                </button>
            </div>
        </div>
        
        <!-- DataTales Example -->
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
                    <label for="inTown">Municipio
                        <span style="font-size: 20px; color: red;">*</span>
                        <span id="spanTown" style="color: red;">Es necesario elegir un municipio para ver la tabla de Sedes e Instituciones</span>
                    </label>
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
          <div class="row mb-3 divSedesTable">
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
          <div class="row mb-3 divInstitutionsTable">
            <div class="col-md-12">
                <div class="table-responsive"> 
                    <label for="institutionsTable">
                        Instituciones
                        <span style="font-size: 20px; color: red;">*</span>
                        <span id="spanInstitution" style="color: red;">Es necesario elegir al menos una Institución para poder ver la tabla de Voluntarios</span>
                    </label>
                    <table id="institutionsTable" class="table table-striped table-bordered"
                    data-locale="es-MX"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc"> 
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
                <div class="mt-3 float-right">
                    <button class="btn btn-primary" id="btnFilterVoluntary">Filtrar Voluntarios</button>
                </div>
            </div>
          </div>
          <div class="row divVoluntariesTable">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="voluntariesTable">Voluntarios</label>
                    <div id="toolbar2">
                        <div class="row">                           
                                <h5 class="ml-3"><span class="badge badge-success">Pocas horas</span></h5>                            
                                <h5 class="ml-2"><span class="badge badge-warning" style="color: black">Por cumplir</span></h5>                      
                                <h5 class="ml-2"><span class="badge badge-danger">Cumplidas</span></h5>                        
                        </div>
                    </div>     
                    <table id="voluntariesTable" class="table table-striped table-bordered"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc"
                    data-toolbar="#toolbar2">
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
                            <th data-field="horas" data-sortable="true" data-halign="center" data-align="center" data-formatter="statusFormater">Horas</th>
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
                    <label for="editInTown">
                        Municipio
                        <span style="font-size: 20px; color: red;">*</span>
                    </label>
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
                    <label for="editInstitutionsTable">
                        Instituciones
                        <span style="font-size: 20px; color: red;">*</span>
                    </label>
                    <table id="editInstitutionsTable" class="table table-striped table-bordered"
                    data-locale="es-MX"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc">
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
                <div class="mt-3 float-right">
                    <button class="btn btn-primary" id="btnEditFilterVoluntary">Filtrar Voluntarios</button>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <label for="editVoluntariesTable">Voluntarios</label>
                    <div id="toolbar3">
                        <div class="row">                           
                                <h5 class="ml-3"><span class="badge badge-success">Pocas horas</span></h5>                            
                                <h5 class="ml-2"><span class="badge badge-warning" style="color: black">Por cumplir</span></h5>                      
                                <h5 class="ml-2"><span class="badge badge-danger">Cumplidas</span></h5>                        
                        </div>
                    </div>          
                    <table id="editVoluntariesTable" class="table table-striped table-bordered"
                    data-pagination="false"
                    data-height="300"
                    data-sort-name="nombre"
                    data-sort-order="desc"
                    data-toolbar="#toolbar3">
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
                            <th data-field="horas" data-sortable="true" data-halign="center" data-align="center" data-formatter="statusFormater">Horas</th>
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

  <div id="modalRejectEmail" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mensaje</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="rejectMessage">Mensaje para el voluntario</label>
                    <textarea class="form-control" id="rejectMessage" rows="3"></textarea>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal-footer mr-auto">
            <button type="button" class="btn btn-success botonEnviar" id="btnSendRejecEmail">Enviar</button>       
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Agregar horas a voluntarios-->
<div id="modalLoadHours" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog horas modal-dialog-centered" role="document">
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
                <button id="button-largo" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>       
            </div>
        </div>
    </div>
</div>

<div id="modalEditarHoras" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog horas modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Editar las horas del voluntario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" hidden>
                        <div class="form-group">
                            <input type="text" class="form-control" id="id_voluntario" name="id_voluntario"/>
                        </div>
                    </div>
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
                <button id="button-largo" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>       
            </div>
        </div>
    </div>
</div>

<div id="modalJornadasAceptadas" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog jornadas-aceptadas modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Voluntarios Aceptados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
            </button>
            </div>
            <div class="modal-body">
                <div id="voluntariesAcceptedToolbar">
                    <div class="form-inline" role="form">
                        <div class="form-group ml-1">
                            <input type="text" class="form-control" placeholder="Busqueda general" id="inSearchCustom">
                        </div>
    
                        {{-- <div class="form-group ml-1">
                            <button type="button" class="btn btn-primary" id="btnRejectEmail" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpiar Filtros">
                                <i class="far fa-envelope"></i>
                                <span class="item-label">Cancelación</span>
                            </button>      
                        </div> --}}
    
                        <div class="form-group ml-1">
                            <a class="btn btn-info btn-table" id="btnLoadHours" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar horas">
                                <img class="mx-2" src="{{ asset('public/assets/images/reloj.svg')}}" style="width: 20px;"/>
                                <span class="item-label">Agregar horas</span>                 
                            </a>
                        </div>

                        <div class="form-group ml-1">
                            <a class="btn btn-success btn-table" id="btnExportToExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Generar reporte">
                                <img class="mx-2" src="{{ asset('public/assets/images/documento.svg')}}" style="width: 20px; height: 20px"/>
                                <span class="item-label">Generar reporte</span>                 
                            </a>
                        </div>
                    </div>
                </div>
    
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">           
                            <table id="voluntariesAcceptedTable" class="table table-striped table-bordered"
                            data-search-selector="#inSearchCustom"
                            data-sort-name="nombre"
                            data-sort-order="desc"
                            data-toolbar="#voluntariesAcceptedToolbar">
                                <thead>
                                  <tr>
                                    <th data-checkbox="true"></th>
                                    <th class="d-none" data-field="id_jornada">ID Jornada</th>
                                    <th class="d-none" data-field="id_detalle_jornada">ID Jornada</th>
                                    <th class="d-none" data-field="id_voluntario">ID Voluntario</th>
                                    <th data-field="folio" data-sortable="true" data-halign="center" data-align="center">Folio</th>
                                    <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                                    <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                                    <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                                    <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                                    <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                                    <th data-field="curp" data-sortable="true" data-halign="center" data-align="center">CURP</th>
                                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                                    <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                                    <th data-field="nombres_sedes" data-sortable="true" data-halign="center" data-align="center">Sedes</th>
                                    <th data-field="turno" data-sortable="true" data-halign="center" data-align="center">Turno</th>
                                    <th data-field="horas" data-sortable="true" data-halign="center" data-align="center">Horas</th>
                                    <th data-field="operate" data-formatter="volAcepFormatter" data-halign="center" data-align="center" data-events="volAcepEvents"></th>
                                  </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer mr-auto">
                <button id="agregarHoras" class="btn btn-success botonEnviar" type="submit">Guardar</button>
                <button id="button-largo" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>       
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script src="{{ asset('public/assets/js/xls-export.js') }}"></script>
    <script>
        let $vaccinationDayTable = $('#vaccinationDayTable');
        let $voluntariesTable = $('#voluntariesTable');
        let $voluntariesAcceptedTable = $('#voluntariesAcceptedTable');
        let $viewDetailVoluntariesTable = $('#viewDetailVoluntariesTable');
        let $editVoluntariesTable = $('#editVoluntariesTable');
        let $institutionsTable = $('#institutionsTable');
        let $editInstitutionsTable = $('#editInstitutionsTable');
        let $sedesTable = $('#sedesTable');
        let $editSedesTable = $('#editSedesTable');
        let idJornada = 0;
        let total_horas = 0;
        let difhoras = 0;
        let voluntariosData = [];

        $(document).ready(()=>{
            getAllJornadas();
            startEvents();

            $voluntariesAcceptedTable.bootstrapTable({data: []});

            $(document).on('show.bs.modal', '.modal', function (event) {
                let zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            });
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
                let fileNames = e.target.files;
                let names = [];

                for(let i = 0; i < fileNames.length; i++){
                    names.push(fileNames[i].name);
                }

                $('#inFile').next('.custom-file-label').html(names.join(', '));
            });


            $('#editInFile').on('change', (e) => {
                let fileNames = e.target.files;
                let names = [];

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
                    $('#spanTown').attr({'hidden': true});
                    $('.divSedesTable').attr({'hidden': false});
                    $('.divInstitutionsTable').attr({'hidden': false});
                }                            
            });

            $('#editInTown').on('change', () => {
                if($('#editInTown').children('option:selected').val().length > 0){
                    getAllSedesByIdTown($('#editInTown').children('option:selected').val(), 'edit');
                }                             
            });

            //evento para obtener la lista de todos los voluntarios activos y no eliminados
            $('#modalCreateVaccinationDay').on('show.bs.modal', () => {
                $('#spanTown').attr({'hidden': false});
                $('#spanInstitution').attr({'hidden': false});

                $('.divInstitutionsTable').attr({'hidden': true});
                $('.divSedesTable').attr({'hidden': true});
                $('.divVoluntariesTable').attr({'hidden': true});

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
                 
                let voluntariesTable = $voluntariesTable.bootstrapTable('getSelections');
                let sedesTable = $sedesTable.bootstrapTable('getSelections');
                
                //console.log(anexoFiles.files[0].size);
                
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

                        if(anexoFiles.files.length > 0){
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
            $('#btnFilterVoluntary').on('click', () => {
                let institutionsTable = $institutionsTable.bootstrapTable('getSelections');
                let idsIinstitution = institutionsTable.map(element => element.id_insti);
                $('#spanInstitution').attr({'hidden': true});
                $('.divVoluntariesTable').attr({'hidden': false});

                getVoluntariesByInstitution(idsIinstitution, 'create');
            });

            $('#btnEditFilterVoluntary').on('click', () => {
                let editInstitutionsTable = $editInstitutionsTable.bootstrapTable('getSelections');
                let idsIinstitution = editInstitutionsTable.map(element => element.id_insti);

                getVoluntariesByInstitution(idsIinstitution, 'edit');
            });

            $('#btnRejectEmail').on('click', () => {
                let voluntariesAcceptedTable = $voluntariesAcceptedTable.bootstrapTable('getSelections');

                if(voluntariesAcceptedTable.length > 0){
                    $('#modalRejectEmail').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Primero debe elegir todos los voluntarios',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });

            $('#btnSendRejecEmail').on('click', () => {
                let idJornada = $voluntariesAcceptedTable.bootstrapTable('getSelections')[0].id_jornada;
                let idsDetalleJornadas = $voluntariesAcceptedTable.bootstrapTable('getSelections').map(element => element.id_detalle_jornada);
                let mensaje = $('#rejectMessage').val();
                // console.log(idJornada);
                enviarCorreoCancelacion(idJornada, idsDetalleJornadas, mensaje);
            });

            $('#btnLoadHours').on('click', () => {
                let idsDetalleJornadas = $voluntariesAcceptedTable.bootstrapTable('getSelections').map(element => element.id_detalle_jornada);
                
                if(idsDetalleJornadas.length > 0){
                    $('#modalLoadHours').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                } else {
                    Swal.fire({
                        title: '¡Advertencia!',
                        text: 'Debe seleccionar al menos un voluntario',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        });
                }
            });
         
            $('#agregarHorarMuti').on('click', () => {
                let idsDetalleJornadas = $voluntariesAcceptedTable.bootstrapTable('getSelections').map(element => element.id_detalle_jornada);
                let horas = document.getElementById("horas").value;

                agregarQuitarHoras(idsDetalleJornadas, horas);
            });

            $('#agregarHoras').on('click', () => {
                if(bandera == true){
                    if(document.getElementById("horas2").value !== 0){
                        let horas = document.getElementById("horas2").value;
                        let id_voluntario = document.getElementById("id_voluntario").value;

                        difhoras = horas - total_horas;

                        editarHoras(id_voluntario, difhoras);
                    }
                } else {
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
            
            $('#btnExportToExcel').on('click', () => {
                let today = new Date();

                const xls = new xlsExport(
                    voluntariosData, 
                    'Jornadas'
                );

                xls.exportToXLS(
                    'reporte voluntarios por jornadas_' 
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

        function getAllVolunteersAccepted(folio){
            $.ajax({
                url: "vaccinationDay/getAllVolunteersAccepted/" + folio,
                type: "GET",
                success: function (response) {
                    // console.log(response.data);
                    if(response.data != []){

                        let voluntarios = response.data.map(item => {
                            let data = {
                                'Nombre': item.nombre,
                                'Apellido Paterno': item.ape_pat,
                                'Apellido Materno': item. ape_mat,
                                'Email': item.email,
                                'Teléfono': item.tel,
                                'CURP': item.curp,
                                'Municipio': item.nombre_municipio,
                                'Institución': item.nombre_institucion,
                                'Sedes': item.nombres_sedes,
                                'Turno': item.turno,
                                'Horas': item.horas
                            };
                            return data;
                        });

                        voluntariosData = [];
                        voluntariosData = voluntarios;

                        $voluntariesAcceptedTable.bootstrapTable('destroy');
                        $voluntariesAcceptedTable.bootstrapTable({data: response.data});
                    }else{
                        $voluntariesAcceptedTable.bootstrapTable({data: []});
                    }
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ids_institution: ids_institution
                },
                success: function (response) {
                    // console.log(response);
                    if(response.data.length > 0){

                        let data = response.data.map(item => {
                            return {
                                id_voluntario: item.id_voluntario,
                                nombre: item.nombre,
                                ape_pat: item.ape_pat,
                                ape_mat: item.ape_mat,
                                email: item.email,
                                tel: item.tel,
                                curp: item.curp,
                                nombre_municipio: item.nombre_municipio,
                                nombre_institucion: item.nombre_institucion,
                                horas: item.horas == null ? "0" : item.horas
                            }
                        });

                        if(actionType == 'create'){
                            $voluntariesTable.bootstrapTable('destroy');
                            $voluntariesTable.bootstrapTable({data: data});
                        } 
                        else if(actionType == 'edit'){
                            $editVoluntariesTable.bootstrapTable('destroy');
                            $editVoluntariesTable.bootstrapTable({data: data});
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
                    if(response.data.length > 0){
                        let filesName = response.data.map(item => item.nombre);
                        $('#editInFile').next('.custom-file-label').html(filesName.join(', '));
                    } else {
                        $('#editInFile').next('.custom-file-label').html('Cada uno de los archivos no deben ser mayor a 2MB, de lo contrario estos no se guardaran.');
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
                    // console.log(response.data);

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
                            nombre_institucion: response.data.find(s => s.id_voluntario === id_voluntario).nombre_institucion,
                            horas: response.data.find(s => s.id_voluntario === id_voluntario).horas
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

        function getJornadaDetailForEmails(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaDetailForEmails/" + id_jornada,
                type: "GET",
                success: function (response) {
                    let jornadaData = Array.from(new Set(response.data.map(x => x.id_voluntario))).
                    map(id_voluntario => {
                        return {
                            id_voluntario: id_voluntario,
                            id_detalle_jornada: response.data.find(s => s.id_voluntario === id_voluntario).id_detalle_jornada
                        };
                    });

                    // console.log(jornadaData);

                    if(jornadaData.length > 0){
                        let ids_detalle_jornadas = jornadaData.map(item => item.id_detalle_jornada);
                        enviarCorreoJornada(ids_detalle_jornadas);
                    } else {
                        Swal.fire({
                        title: 'Sin correos pendientes',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                    getJornadaDetailForEmailsNoSend(id_jornada);
                }
            });
        }

        function getJornadaDetailForEmailsNoSend(id_jornada){
            $.ajax({
                url: "vaccinationDay/getJornadaDetailForEmailsNoSend/" + id_jornada,
                type: "GET",
                success: function (response) {
                    console.log(response.data);
                    Swal.fire({
                        title: 'Correos pendientes',
                        text: 'No fue posible enviar todos los correos. Faltan' + response.data[0].total_voluntarios + 'voluntarios. Vuelva a intentarlo'
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        });
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

        function insVaccinationDay(data){
            let filesForm = new FormData();
            let anexoFiles =  document.getElementById('inFile');

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

                    if(anexoFiles != null){
                        if(anexoFiles.files != []){
                            for(let i = 0; i < anexoFiles.files.length; i++){
                                if(anexoFiles.files[i].size <= 2097152){ // 2MB
                                    filesForm.set('id_jornada', response.id_jornada);
                                    filesForm.set('idsVoluntarios', data.get('idsVoluntarios'));
                                    filesForm.set('file', anexoFiles.files[i]);

                                    insAnexos(filesForm);
                                }
                            }
                        }
                    }

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
                    //console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }

        function updAnexos(data){
            // console.log(data.get('file'));
            deleteFilesForUpdate(data.get('id_jornada'));

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

        //Funcion auxiliar que elimina los anexos si existen en el id de jornada dado.
        function deleteFilesForUpdate(id_jornada){
            $.ajax({
                url: "vaccinationDay/deleteFilesForUpdate",
                type: "POST",
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_jornada: id_jornada
                },
                success: function (response) {
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_jornada: id_jornada
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ids_detalle_jornadas: idsDetalleJornadas
                },
                beforeSend: () => {
                    Swal.fire({
                        showConfirmButton: false,
                        imageUrl: "{{ asset('public/assets/images/loading.png') }}",
                        title: 'Por favor espere. Este proceso puede tardar varios minutos.',
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
                    Swal.fire({
                        title: 'Error',
                        text: error.responseJSON.message,
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                        console.error(error);
                }
            });
        }

        function enviarCorreoCancelacion(id_jornada, idsDetalleJornadas, mensaje){
            $.ajax({
                url: "vaccinationDay/sendrejectemail",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_jornada: id_jornada,
                    mensaje: mensaje,
                    ids_detalle_jornada: idsDetalleJornadas
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

                /**
        * Método que consulta al getDetalleVoluntario de la clase de VoluntariosController
        * que consulta los datos del voluntario y permite visualizarla en los campos correspondientes de 
        * la ventana modal para edita las horas del voluntario
        */
        function getHorasvoluntario(id_voluntario){
            // console.log(id_voluntario);
            $.ajax({
                url: "voluntario/detalles/" + id_voluntario,
                type: "GET",
                success: function (response) {
                     //console.log(response);
                    //idVoluntario = response.data.id_voluntario;
                    if(response.bandera == false){
                        $('#id_voluntario').val(response.data.id_voluntario);
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
                        $('#id_voluntario').val(response.data[0].id_voluntario);
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

        function agregarQuitarHoras(ids_detalle_jornadas, horas){
            $.ajax({
                url: "vaccinationDay/agregarQuitarHoras",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ids_detalle_jornadas: ids_detalle_jornadas,
                    horas: parseInt(horas)
                },
                success: function (response) {
                    $('#modalLoadHours').modal('hide');
                    Swal.fire({
                        title: '¡Registro completado!',
                        text: response.mensaje,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

         /**
        * Método para editar las horas de los voluntarios
         */
         function editarHoras(id_voluntario, horas){
            //  console.log(id_voluntario + ' - ' + horas);
            $.ajax({
                url: "voluntario/editarHoras/" + id_voluntario + "/" + horas,
                type: "GET",
                success: function (response) {
                    //console.log(response);
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

        function volAcepFormatter(value, row, index) {
            return [
            '<a class="edit_horas mr-2" href="javascript:void(0)" title="Editar horas voluntario">',
                '<img src="{{ asset('public/assets/images/reloj_azul.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>'
            ].join('');
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="email mr-2" href="javascript:void(0)" title="Email">',
                '<i class="far fa-envelope"></i>',
            '</a>',
            '<a class="detail mr-2" href="javascript:void(0)" title="Detalles">',
            '<img src="{{ asset('public/assets/images/i1.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>',                
            '<a class="edit mr-2" href="javascript:void(0)" title="Editar">',
                '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>',
            '<a class="remove mr-2" href="javascript:void(0)" title="Eliminar">',
                '<img src="{{ asset('public/assets/images/basura.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>'
            ].join('')
        }

        function statusFormater(value, row, index){
            let status = '';

            if(row.horas >= 400 && row.horas < 480){
                status = '<h3><span class="badge badge-warning" style="color: black">' + row.horas + '</span></h3>'
            } 
            else if(row.horas >= 480){
                status = '<h3><span class="badge badge-danger">' + row.horas + '</span></h3>'
            }
            else if(row.horas < 400) {
                status = '<h3><span class="badge badge-success">' + row.horas + '</span><h3>'
            }
            return [status].join('');
        }

        // function stateFormatter(value, row, index) {
        //     if (row.horas >= 50) {
        //         return {
        //             disabled: true
        //         }
        //     }
        //     return value;
        // }

        window.volAcepEvents = {
            'click .edit_horas': function (e, value, row, index) {
                $('#modalEditarHoras').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getHorasvoluntario(row.id_voluntario);
            }
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

            'click .email': function (e, value, row, index) {
                getJornadaDetailForEmails(row.id_jornada);
            },

            'click .detail': function (e, value, row, index) {
                $('#modalJornadasAceptadas').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                getAllVolunteersAccepted(row.folio);
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