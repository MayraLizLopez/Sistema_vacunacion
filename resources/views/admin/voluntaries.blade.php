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
            data-pagination="true">
                <thead>
                  <tr>
                    <th data-field="nombre">Nombre</th>
                    <th data-field="ape_pat">Apellido Paterno</th>
                    <th data-field="ape_pat">Apellido Materno</th>
                    <th data-field="email">Email</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script>
        $(document).ready(()=>{
            getAllVolunataries();
        });

        function getAllVolunataries(){
            let $table = $('#voluntariesTable');
            let voluntarios = @json($voluntarios);
            console.log(voluntarios);     
            $table.bootstrapTable({data: voluntarios});
        }
    </script>
@endsection