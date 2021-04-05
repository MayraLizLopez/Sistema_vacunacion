@extends('admin.layout')
@section('css')
    <link href="{{ url("../resources/css/bootstrap-table.min.css") }}" rel="stylesheet" type="text/css">
@endsection
@section('content')  
<!-- Page Heading --> 

<div class="row g-0">
    <div class="col-sm-6 col-md-8 col-sm-8  col-xs-10">
        <h1 class="h3 mb-2 text-gray-800">Instituciones</h1>
        <p class="mb-4">La siguiente tabla contiene todas las instituciones registradas. </p>
    </div>
    <div class="col-6 col-md-4 col-sm-4 col-xs-2">
        <div class="nav justify-content-end">
            <button type="button" class="btn btn-primary "><a style="color:white;" href="{{route('createInstitucion')}}">Registrar Institución</a></button>
        </div>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Instituciones</h6>
    </div>
    <div class="card-body">
    <table id="datatable" class="table table-striped table-bordered"  data-pagination="true" data-single-select="true" data-click-to-select="true">
    
        <thead>
        <tr>
        <th class="d-none" data-radio="true"></th>
        <th data-field="nombre" data-halign="center" data-align="center">Nombre</th>
        <th data-field="domicilio" data-halign="center" data-align="center">Domicilio</th>
        <th data-field="nombre_enlace" data-halign="center" data-align="center">Nombre Enlace</th>
        <th data-field="id_municipio" data-halign="center" data-align="center">Municipio</th>
        <th data-field="email" data-halign="center" data-align="center">Email</th>
        <th data-field="tel" data-halign="center" data-align="center">Teléfono</th>
        <th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents"></th>
        </tr>
        </thead>


        <tbody>
        @foreach($instituciones as $item)
            @if($item->activo == 1)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>{{$item->domicilio}}</td>
                <td>{{$item->nombre_enlace}}</td>
                @foreach ($municipios as $municipio)
                    @if ($item->id_municipio == $municipio->id_municipio)
                        <td>{{$municipio->nombre}}</td>
                    @endif
                @endforeach
                <td>{{$item->email}}</td>
                <td>{{$item->tel}}</td>

                <td>  
                    <a class="like mr-3" href="{{route('editarInstituciones', $item->id_insti)}}" title="Edit" type="reset"><i class="fas fa-edit"></i></a>
                    <a class="remove" href="javascript:void(0)" title="Remove"><i class="fa fa-trash"></i></a>
                </td>

            </tr>
            @endif
        @endforeach()
        </tbody>
    </table>
    </div>
</div>
@endsection
@section('scripts')
@endsection