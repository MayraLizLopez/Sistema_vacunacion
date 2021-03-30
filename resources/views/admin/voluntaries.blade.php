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
                    <th data-field="id">ID</th>
                    <th data-field="name">Item Name</th>
                    <th data-field="price">Item Price</th>
                  </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ url("../resources/js/bootstrap-table.min.js") }}"></script>
    <script src="{{ url("../resources/js/voluntaries.js") }}"></script>
@endsection