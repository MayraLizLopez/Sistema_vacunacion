@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Centros de Vacunación</h1>
<p class="mb-4">La siguiente tabla contiene todos los centros de vacunación registrados</p>
<div id="toolbar">
    <div class="form-inline">
        <a class="btn btn-primary" style="color:white;" href="{{route('createSede')}}"><img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/> Agregar centro</a>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">           
            <table id="sedesTable" class="table table-striped table-bordered"
            data-locale="es-MX"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true"
            data-search="true"
            data-page-size="10"
            data-page-list="[5, 10, 15, 50, 100, 200, 500, 1000]"
            data-sort-name="nombre"
            data-sort-order="desc"
            data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_sede">ID</th>
                    <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="direccion" data-sortable="true" data-halign="center" data-align="center">Domicilio</th>
                    <th data-field="colonia" data-sortable="true" data-halign="center" data-align="center">Colonia</th>
                    <th data-field="cp" data-sortable="true" data-halign="center" data-align="center">Código Postal</th>
                    <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                    <th data-field="nombre_encargado" data-sortable="true" data-halign="center" data-align="center">Encargado del centro</th>
                    <th data-field="cupo" data-sortable="true" data-halign="center" data-align="center">Voluntarios necesarios</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<div id="modalViewJornadaDetail" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-0 font-weight-bold text-primary">Información del centro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 20px;"/>
                </button>
            </div>

            <div class="modal-body">
                <div id="toolbar4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre de la sede</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="required"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="domicilio">Domicilio de la institución</label>
                                <input type="text" class="form-control" id="domicilio" name="direccion" required="required"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cruce_calles">Cruce de calles</label>
                                <input type="text" class="form-control" id="cruce_calles" name="cruce_calles" required="required"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="colonia">Colonia</label>
                                <input type="text" class="form-control" id="colonia" name="colonia" required="required"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cp">Código postal</label>
                                <input type="number" class="form-control" id="cp" name="cp" min="11111" max="99999" required="required"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailVoluntary">Municipio</label>
                                <input type="text" class="form-control" id="municipio" name="municipio" required="required"/>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="num_voluntarios">Número de voluntarios necesarios</label>
                                <input type="number" class="form-control" id="num_voluntarios" name="cupo" min="1" max="50" required="required"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_encargado">Nombre del encargado</label>
                                <input type="text" class="form-control" id="nombre_encargado" name="nombre_encargado"  required="required"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emailVoluntary">Tel. del encargado</label>
                                <input type="text" class="form-control" id="tel" name="tel_encargado" required="required"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="num_voluntarios">Email del encargado</label>
                                <input type="number" class="form-control" id="email" name="email_encargado" min="1" max="50" required="required"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mapa">Mapa</label>
                                
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
    <script>
        let $table = $('#sedesTable');

        $(document).ready(()=>{
            getAllSedes();
        });


        function getAllSedes(){      
            let sedes = @json($sedes); 
            $table.bootstrapTable({data: sedes});            
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="detail mr-2" href="javascript:void(0)" title="Detalle">',
            '<i class="fas fa-info-circle"></i>',
            '</a>',
            '<a class="like mr-3" href="editar/' + row.id_sede + '"' + 'title="Editar">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Eliminar">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    text: "¿Seguro que deseas eliminar esta sede?",
                    showCancelButton: true,
                    confirmButtonColor: '#E33C3C',
                    cancelButtonColor: '#67737A',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Calcelar',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteSede(row.id_sede);
                    }
                    });
            },

            'click .detail': function (e, value, row, index) {
                $('#modalViewJornadaDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getDetalleSede(row.id_sede);
            }
        }

        function getDetalleSede(id_sede){
            $.ajax({
                url: "detalles/" + id_sede,
                type: "GET",
                success: function (response) {
                    console.log(response);
                    idSede = response.data.id_sede;
                    $('#nombre').val(response.data.nombre);
                    $('#nombre').prop( "disabled", true );
                    $('#domicilio').val(response.data.direccion);
                    $('#domicilio').prop( "disabled", true );
                    $('#colonia').val(response.data.colonia);
                    $('#colonia').prop( "disabled", true );
                    $('#cruce_calles').val(response.data.cruce_calles);
                    $('#cruce_calles').prop( "disabled", true );
                    $('#cp').val(response.data.cp);
                    $('#cp').prop( "disabled", true );
                    $('#municipio').val(response.data.nombre_municipio);
                    $('#municipio').prop( "disabled", true );
                    $('#nombre_encargado').val(response.data.nombre_encargado);
                    $('#nombre_encargado').prop( "disabled", true );
                    $('#tel').val(response.data.tel_encargado);
                    $('#tel').prop( "disabled", true );
                    $('#email').val(response.data.email_encargado);
                    $('#email').prop( "disabled", true );
                    $('#num_voluntarios').val(response.data.cupo);
                    $('#num_voluntarios').prop( "disabled", true );
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

        function deleteSede(id){
            $.ajax({
                url: "eliminar/" + id,
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

    </script>
@endsection