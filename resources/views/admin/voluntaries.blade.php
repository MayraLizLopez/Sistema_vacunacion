@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">           
            <table id="voluntariesTable"
            data-pagination="true"
            data-single-select="true"
            data-click-to-select="true">
                <thead>
                  <tr>
                    <th class="d-none" data-radio="true"></th>
                    <th class="d-none" data-field="id_voluntario">ID</th>
                    <th data-field="nombre" data-halign="center" data-align="center">Nombre</th>
                    <th data-field="ape_pat" data-halign="center" data-align="center">Apellido Paterno</th>
                    <th data-field="ape_mat" data-halign="center" data-align="center">Apellido Materno</th>
                    <th data-field="email" data-halign="center" data-align="center">Email</th>
                    <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
{{-- start modal section --}}
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar voluntario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nameVoluntary">Nombre (s)</label>
                                <input type="text" class="form-control" id="nameVoluntary" name="nombre" placeholder="Nombre (s)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="paternalSurnameVoluntary">Apellido Paterno</label>
                                <input type="text" class="form-control" id="paternalSurnameVoluntary" name="ape_pat" placeholder="Apellido Paterno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="maternalSurnameVoluntary">Apellido Materno</label>
                                <input type="text" class="form-control" id="maternalSurnameVoluntary" name="ape_mat" placeholder="Apellido Materno">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailVoluntary">Correo electrónico</label>
                                <input type="text" class="form-control" id="emailVoluntary" name="email" placeholder="Correo electrónico">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phoneVoluntary">Teléfono / Celular</label>
                                <input type="text" class="form-control" id="phoneVoluntary" name="tel" placeholder="Número celular o fijo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="townVoluntary">Municipio</label>
                                <select class="form-control" id="townVoluntary" name="id_municipio">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instututionVoluntary">Institución</label>
                                <select class="form-control" id="instututionVoluntary" name="id_insti">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  {{-- end modal section --}}
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script>
        let $table = $('#voluntariesTable');

        $(document).ready(()=>{
            getAllVolunataries();
        });

        //Start table actions & operations
        function getAllVolunataries(){           
            let voluntarios = @json($voluntarios);    
            $table.bootstrapTable({data: voluntarios});
        }

        function operateFormatter(value, row, index) {
            return [
            '<a class="like mr-3" href="voluntario/edit/' + row.id_voluntario + '"' + 'title="Edit">',
            '<i class="fas fa-edit"></i>',
            '</a>',
            '<a class="remove" href="javascript:void(0)" title="Remove">',
            '<i class="fa fa-trash"></i>',
            '</a>'
            ].join('')
        }

        window.operateEvents = {
            'click .like': function (e, value, row, index) {

                //alert('You click like action, row: ' + JSON.stringify(row))
            },

            'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                    field: 'id_voluntario',
                    values: [row.id_voluntario]
                })
            }
        }
        //End table actions & operations
    </script>
@endsection