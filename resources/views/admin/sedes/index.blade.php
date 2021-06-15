@extends('admin.layout')
@section('css')
    <link href="{{ asset('public/assets/css/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Sedes de vacunación</h1>
<p class="mb-4">La siguiente tabla contiene todos los centros de vacunación registrados</p>
<div id="toolbar">
    <div class="form-inline">
        <a class="btn btn-primary" style="color:white;" href="{{route('createSede')}}"><img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/> Agregar sede</a>
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
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">Acciones</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal para ver la información de la sede -->
<div id="modalViewSedeDetail" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="m-0 font-weight-bold text-primary">Información de la sede</h5>
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
                                <input type="text" class="form-control" id="tel" name="tel_encargado" data-mask="000 000 0000" required="required"/>      
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
                                <div id="map" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FIN Modal para ver la información de la sede -->
@endsection
@section('scripts')
    <script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script>
        let $table = $('#sedesTable');

        $(document).ready(()=>{
            getAllSedes();
        });

        /**
         * Método para ingresar los  datos a la tabla de sedes
         */
        function getAllSedes(){      
            let sedes = @json($sedes); 
            $table.bootstrapTable({data: sedes});            
        }

        /**
         * Método para agregar los botones de lado derecho de la tabla
         */
        function operateFormatter(value, row, index) {
            return [
            '<a class="detail mr-2" href="javascript:void(0)" title="Detalles">',
            '<img src="{{ asset('public/assets/images/geo.svg')}}" style="width: 15px; margin:0px;"/>',
            '</a>',
            '<a class="like mr-3" href="editar/' + row.id_sede + '"' + 'title="Editar">',
            '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; margin:0px;"/>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Eliminar">',
            '<img src="{{ asset('public/assets/images/basura.svg')}}" style="width: 15px; margin:0px;"/>',,
            '</a>'
            ].join('')
        }

        /**
         * Sweetalert para eliminar sedes 
         */
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
            /**
            * Acción para eliminar sedes 
            */
            'click .detail': function (e, value, row, index) {
                $('#modalViewSedeDetail').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                getDetalleSede(row.id_sede);
            }
        }

        /**
         * método para mostrarlos datos de los detalles de la modal y para la visualización de mapa, ya sea busqueda de coordenadas o por dirección
         */
        function getDetalleSede(id_sede){
            $.ajax({
                url: "detalles/" + id_sede,
                type: "GET",
                success: function (response) {
                    //console.log(response);
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

                    if(response.data.latitud === null){
                        var geocoder = new google.maps.Geocoder();
                        var map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 17,
                            scrollwheel: true,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        let direccion = document.getElementById("nombre").value + " " + document.getElementById("domicilio").value;
                        if(response.data.colonia !== null){
                            direccion= direccion + " " + response.data.colonia;
                        }
                        if(response.data.cp !== null){
                            direccion= direccion + " " + response.data.cp;
                        }
                        direccion = direccion + " " + document.getElementById("municipio").value + " Jal."
                        //console.log(direccion);
                        geocoder.geocode({'address': direccion}, function(results, status) {
                            if (status === 'OK') {
                                var resultados = results[0].geometry.location,
                                    resultados_lat = resultados.lat(),
                                    resultados_long = resultados.lng();
                                    //console.log("latitud: "+ resultados_lat + " longitud: "+ resultados_long);
                                
                                map.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: map,
                                    position: results[0].geometry.location,
                                    title: response.data.nombre
                                });

                                let datosSede = {
                                    id_sede: id_sede,
                                    latitud: resultados.lat(),
                                    longitud: resultados.lng(),
                                };
                                saveCoordenadas(datosSede);

                            } else {
                                var mensajeError = "";
                                if (status === "ZERO_RESULTS") {
                                    mensajeError = "No hubo resultados para la dirección ingresada, modifique los datos del centro.";
                                } else if (status === "OVER_QUERY_LIMIT" || status === "REQUEST_DENIED" || status === "UNKNOWN_ERROR") {
                                    mensajeError = "Error general del mapa.";
                                } else if (status === "INVALID_REQUEST") {
                                    mensajeError = "Error de la web. Contacte con Name Agency.";
                                }
                                Swal.fire({
                                    title: 'Error',
                                    text: mensajeError,
                                    icon: 'error',
                                });
                            }
                        });
                    }else{
                        var latitud = response.data.latitud;
                        var longitud = response.data.longitud;
                        var myLatlng = new google.maps.LatLng(latitud, longitud);
                        map = new google.maps.Map(document.getElementById("map"), {
                            center: myLatlng,
                            zoom: 17,
                            scrollwheel: true,
                        });
                        var marker = new google.maps.Marker({
                            map: map,
                            position: myLatlng,
                            title: response.data.nombre,
                        });
                    }
                    
                },
                error: function (error, resp, text) {
                    console.error(error.responseJSON.message);
                }
            });
        }

        /**
         * método para guardar las coordenadas de la sede si la dirección es correcta
         */
        function saveCoordenadas(data){
            $.ajax({
                url: "coordenadas",
                type: "POST",
                data: {
                    id_sede: data.id_sede,
                    latitud: data.latitud,
                    longitud: data.longitud,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                   // console.log(response);
                },
                error: function (error, resp, text) {
                    console.error(error);
                }
            });
        }
        /**
         * método para eliminar sede
         */
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

        //let map;



    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArelYYPGecMIlIwE5UUmC_e5FJr6qBh8M&libraries=&v=weekly" async></script>
@endsection