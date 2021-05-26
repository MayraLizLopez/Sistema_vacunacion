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
        <h1 class="h3 mb-2 font-weight-bold text-gray-800">Usuarios</h1>
        <p class="mb-4">La siguiente tabla muestra todos los usuarios registrados</p>
    </div>
    <div class="col-md-6">
        <button 
        id="btnInactiveUsers"
        class="btn btn-success float-right"
        style="background-color: #6EDE9E; 
              border: #6EDE9E; 
              font-family: 
              nutmeg-bold; 
              src: url('{{ asset('public/assets/fonts/Nutmeg-Bold.ttf')}}');
              font-weight: bold;
              ">
                <img class="mx-1" src="{{ asset('public/assets/images/usuario_desactivado_blanco.svg')}}" style="width: 40px;"/>
                <span class="h2">Ir a usuarios desactivados</span>
        </button>

        <button 
        id="btnActiveUsers"
        class="btn btn-success float-right"
        style="background-color: #2e59d9;
              border-color: #2653d4; 
              font-family: 
              nutmeg-bold; 
              src: url('{{ asset('public/assets/fonts/Nutmeg-Bold.ttf')}}');
              font-weight: bold;
              ">
                <img class="mx-1" src="{{ asset('public/assets/images/usuario_blanco.svg')}}" style="width: 40px;"/>
                <span class="h2">Ir a usuarios activos</span>
        </button>
    </div>
</div>

<div id="toolbar">
    <div class="form-inline" role="form">

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Usuario" id="inSearchByUser">
        </div>

        <div class="form-group ml-1">
            <select class="custom-select" id="inSearchByInstitution">
                <option value="" selected disabled hidden>Elija una institución</option>
            </select>           
        </div>

        <div class="form-group ml-1">
            <select class="custom-select" id="inSearchByRol">
                <option value="" selected disabled hidden>Elija un rol</option>
                <option value="Administrador General">Administrador General</option>
                <option value="Enlace de institución">Enlace de institución</option>
            </select>           
        </div>

        <div class="form-group ml-1">
            <input type="text" class="form-control" placeholder="Busqueda general" id="inSearchCustom">
        </div>

        <div class="form-group ml-1">
            <button type="button" class="btn btn-success btn-table" id="cleanFilters" data-bs-toggle="tooltip" data-bs-placement="top" title="Limpiar Filtros">
            <img class="mx-2" src="{{ asset('public/assets/images/borrador.svg')}}" style="width: 20px;"/>
                <span class="item-label">Limpiar Filtros</span>
            </button>      
        </div>

        <div class="form-group ml-1">
            <a class="btn btn-primary" style="color:white;" href="{{route('createUser')}}">
                <img class="mx-2" src="{{ asset('public/assets/images/agregar.svg')}}" style="width: 20px;"/>
                Registrar Usuario
            </a>
        </div>

    </div>
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">           
            <table id="usersTable" class="table table-striped table-bordered"
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
                    <th class="d-none" data-field="id_user">ID</th>
                    <th data-field="nombre" data-sortable="true" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="ape_pat" data-sortable="true" data-halign="center" data-align="center">Apellido Paterno</th>
                    <th data-field="ape_mat" data-sortable="true" data-halign="center" data-align="center">Apellido Materno</th>
                    <th data-field="email" data-sortable="true" data-halign="center" data-align="center">Email</th>
                    <th data-field="tel" data-sortable="true" data-halign="center" data-align="center">Teléfono</th>
                    <th data-field="cargo" data-sortable="true" data-halign="center" data-align="center">Cargo</th>
                    <th data-field="rol" data-sortable="true" data-halign="center" data-align="center">Rol</th>
                    <th data-field="nombre_institucion" data-sortable="true" data-halign="center" data-align="center">Institución</th>
                    <th class="d-none" data-field="activo" data-sortable="true" data-halign="center" data-align="center">Activo</th>
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
        let $table = $('#usersTable');

        $(document).ready(()=>{
            getAllUsers();
            getAllInstitutions();
            startEvents();

            $('#btnActiveUsers').attr('hidden', true);
            $('#btnInactiveUsers').attr('hidden', false);
        });

        function startEvents(){
            $('#btnActiveUsers').on('click', () => {
                $('#btnActiveUsers').attr('hidden', true);
                $('#btnInactiveUsers').attr('hidden', false);

                getAllActiveUsers();
            });

            $('#btnInactiveUsers').on('click', () => {
                $('#btnInactiveUsers').attr('hidden', true);
                $('#btnActiveUsers').attr('hidden', false);

                getAllInactiveUsers();
            });

            //Evento de busqueda por nombre de voluntario.
            $('#inSearchByUser').on('keypress', (event) => {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    if($('#inSearchByUser').val().length <= 0){
                    } else {
                        searchByUser($('#inSearchByUser').val());
                    }                   
                }               
            });

            $('#inSearchByRol').on('change', () => {
                if($('#inSearchByRol').children('option:selected').val().length <= 0){
                } else {
                    searchByRol($('#inSearchByRol').children('option:selected').val());
                }                               
            });

            $('#inSearchByInstitution').on('change', () => {
                if($('#inSearchByInstitution').children('option:selected').val().length <= 0){
                } else {
                    searchByInstitution($('#inSearchByInstitution').children('option:selected').val());
                }                               
            });

            $('#cleanFilters').on('click', () => {
                location.reload();
            });
        }

        function getAllUsers(){      
            let users = @json($usuarios);
            $table.bootstrapTable({data: users});         
        }

        function getAllActiveUsers(){
            $.ajax({
                url: "getAllActiveUsers",
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

        function getAllInactiveUsers(){
            $.ajax({
                url: "getAllInactiveUsers",
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

        function getAllInstitutions(){
            $.ajax({
                url: "getAllInstitutions",
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

        //#region Seach
        function searchByUser(name){
            $.ajax({
                url: "searchByUser/" + name,
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

        function searchByRol(name){
            $.ajax({
                url: "searchByRol/" + name,
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
                url: "searchByInstitution/" + id,
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

        function desableUser(id){
            $.ajax({
                url: "destroy/" + id,
                type: "GET",
                success: function (response) {
                    if(response.isOk == true){
                        Swal.fire({
                        title: 'Hecho',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Calcelar',
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

        function enableUser(id){
            $.ajax({
                url: "build/" + id,
                type: "GET",
                success: function (response) {
                    if(response.isOk == true){
                        Swal.fire({
                        title: 'Hecho',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Calcelar',
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

             if(row.activo == 1){
                actionButton = '<a class="disable" href="javascript:void(0)" title="Disable">'
                + '<img src="{{ asset('public/assets/images/desactivar_usuario.svg')}}" style="width: 15px; padding:0px;"/>',         
                + '</a>';
             } else {
                actionButton = '<a class="enable" href="javascript:void(0)" title="Enable">'
                + '<img src="{{ asset('public/assets/images/activar_usuario.svg')}}" style="width: 15px; padding:0px;"/>'         
                + '</a>';
             }

            return [
            '<a class="like mr-3" href="edit/' + row.id_user + '"' + 'title="Edit">',
                '<img src="{{ asset('public/assets/images/lapiz.svg')}}" style="width: 15px; padding:0px;"/>',
            '</a>', actionButton
            ].join('')
        }

        window.operateEvents = {
            'click .disable': function (e, value, row, index) {
                Swal.fire({
                    title: '¿Está seguro que desea desactivar este usuario?',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6A7379',
                    confirmButtonText: 'Desactivar',
                    cancelButtonText: 'Calcelar',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        desableUser(row.id_user);
                    }
                    });
            },
            'click .enable': function (e, value, row, index) {
                Swal.fire({
                    title: '¿Está seguro que desea activar este usuario?',
                    showCancelButton: true,
                    confirmButtonColor: '#54A583',
                    cancelButtonColor: '#6A7379',
                    confirmButtonText: 'Activar',
                    cancelButtonText: 'Calcelar',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        enableUser(row.id_user);
                    }
                    });
            }
        }
    </script>
@endsection