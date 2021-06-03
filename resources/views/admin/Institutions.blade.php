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
<h1 class="h3 mb-2 font-weight-bold text-gray-800">Instituciones</h1>
<p class="mb-4">La siguiente tabla contiene todas las instituciones registradas.</p>
<div id="toolbar">
    <div class="form-inline">
        <a class="btn btn-primary" style="color:white;" href="{{route('createInstitucion')}}"><img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/> Registrar Institución</a>
        <div class="form-group ml-1">
            <a class="btn btn-success btn-table" id="btnModalCorreo" data-bs-toggle="tooltip" data-bs-placement="top" title="Enviar correo">
                <img class="mx-2" src="{{ asset('public/assets/images/carta_correo.svg')}}" style="width: 20px;"/>
                <span class="item-label">Enviar correo</span>                 
            </a>
        </div>
    </div>
</div>
<!-- DataTales Example -->
<form action= "{{route('enviarCorreoInsti')}}"  method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if(Session::get('success'))
    @section('scripts')
        <script>    
            Swal.fire({
                title: '¡Hecho!',
                text: '¡Correo enviado!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "{{route('tabla_insti')}}";
                    }
                });
        </script>
    @endsection
    @endif
    @if(Session::get('fail'))
    @section('scripts')
        <script>    
            Swal.fire({
                title: '¡Error!',
                text: 'no fue posible envíar el correo',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
                });
        </script>
    @endsection
    @endif 

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive"> 
            <table id="institutionsTable" class="table table-striped table-bordered"
            data-locale="es-MX"
            data-pagination="true" 
            data-click-to-select="true"
            data-search="true"
            data-page-size="50"
            data-page-list="[5, 10, 15, 50, 100, 200, 500, 1000]"
            data-sort-name="nombre"
            data-sort-order="asc"
            data-toolbar="#toolbar"> 
                <thead>
                    <tr>
                        <th id="selectTable" data-checkbox="true"></th>
                        <th class="d-none" data-field="id_insti">ID</th>
                        <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                        <th data-field="domicilio" data-sortable="true" data-halign="center" data-align="center">Domicilio</th>
                        <th data-field="nombre_enlace" data-sortable="true" data-halign="center" data-align="center">Nombre Enlace</th>
                        <th data-field="nombre_municipio" data-sortable="true" data-halign="center" data-align="center">Municipio</th>
                        <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                        <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                        <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- Modal enviar correo-->
<div id="modalCorreo" class="modal" tabindex="-1" role="dialog">
    
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Envíar Correo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img class="mx-2" src="{{ asset('public/assets/images/salir.svg')}}" style="width: 30px;"/>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inMessage">Mensaje para los enlaces</label><span class="text-danger">*</span>
                                <textarea class="form-control" id="inMessage" rows="3" name="mensaje" required="required"></textarea>
                                <span id="errorMensaje" class="text-danger"> </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                <input class="form-contol bg-light shadow-sm" type="file" lang="es" name="archivo" multiple>
                                <!-- <input type="file" class="form-control-file" id="exampleFormControlFile1"> -->
                                <input type="file" class="custom-file-input" name="archivo" lang="es" id="inFile" multiple >
                                <label class="custom-file-label" for="inFile" data-browse="Anexo(s)">Cada uno de los archivos no deben ser mayor a 2MB.</label>
                                <input hidden type="text" name="ids" id="ids">
                                </div>
                            </div>
                        </div>
                    </div>
                            
                </div>
                <div class="modal-footer mr-auto">
                    <button id="enviarCorreo" class="btn btn-success botonEnviar" type="submit" >Enviar</button>
                    <a class="btn btn-secondary" id="boton" style="color:white;" data-dismiss="modal">Cancelar</a>       
                </div>
            </div>
        </div>
</div>
</form>
@endsection
@section('scripts')
<script src="{{ asset('public/assets/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-table-es-MX.js') }}"></script>
    <script>
        let $table = $('#institutionsTable');

        $(document).ready(()=>{
            getAllInstitutions();
        });

        //Start table actions & operations
        function getAllInstitutions(){      
            let instituciones = @json($instituciones);       
            $table.bootstrapTable({data: instituciones});     
            //console.log($table);      
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="like mr-3" href="institutions/edit/' + row.id_insti + '"' + 'title="Edit">',
                '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<img src="{{ asset('public/assets/images/basura.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .remove': function (e, value, row, index) {
                Swal.fire({
                    text: "¿Seguro que deseas eliminar esta institución?",
                    showCancelButton: true,
                    confirmButtonColor: '#E33C3C',
                    cancelButtonColor: '#67737A',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Calcelar',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteInstitution(row.id_insti);
                    }
                    });
            }
        }

        function deleteInstitution(id){
            $.ajax({
                url: "institutions/destroy/" + id,
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
        $('#btnModalCorreo').on('click', () => {
            let idsInsti = $table.bootstrapTable('getSelections').map(element => element.id_user);
            document.getElementById('ids').value = $table.bootstrapTable('getSelections').map(element => element.email);
            if(idsInsti.length > 0){
                $('#modalCorreo').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            } else {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: 'Debe seleccionar al menos una institución',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
        $('#enviarCorreo').on('click', () => {
            if(document.getElementById('inMessage').value === ""){
                console.log(document.getElementById('inMessage').value);
                document.getElementById('errorMensaje').innerHTML = "Ingrese un mensaje";
            }else{
                let idsInsti = $table.bootstrapTable('getSelections');
                let filesForm = new FormData();
                let anexoFiles =  document.getElementById('inFile');
                var file = $('#inFile').prop("files")[0];
                var mensaje = document.getElementById('inMessage').value;
                if(anexoFiles != null){
                    if(anexoFiles.files != []){
                        for(let i = 0; i < anexoFiles.files.length; i++){
                            if(anexoFiles.files[i].size <= 2097152){ // 2MB
                                filesForm.set('file', anexoFiles.files[i]);
                            }
                        }
                    }
                }
                //console.log(filesForm.get('file'));
                //console.log(mensaje);
                //enviarCorreo(idsInsti, filesForm, mensaje);
                //console.log("enviar");
            }
        });

        function enviarCorreo(id_insti, archivos, mensaje){
           // console.log(archivos);
            $.ajax({
                url: "institutions/enviarCorreo",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ids: id_insti,
                    message: mensaje,
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
                    console.log(response);
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

        $(document).ready(()=>{
            startEvents();
    
        });

        function startEvents(){
            $('#inFile').on('change', (e) => {
                let fileNames = e.target.files;
                let names = [];

                for(let i = 0; i < fileNames.length; i++){
                    names.push(fileNames[i].name);
                }

                $('#inFile').next('.custom-file-label').html(names.join(', '));
            });
        }

        
        //End table actions & operations
    </script>
@endsection