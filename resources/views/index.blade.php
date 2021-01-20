@extends('plantillas.plantilla1')
@section('titulo')
Conesionarios
@endsection
@section('cabecera')
Concesionarios del Sur S.A.
@endsection
@section('contenido')
<div class="text-center mt-4">
<a href="{{route('marcas.index')}}" class="btn btn-success btn-lg mr-4"><i class="fab fa-maxcdn"></i> Gestionar Marcas</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="{{route('coches.index')}}" class="btn btn-success btn-lg ml-4"><i class="fa fa-car"></i> Gestionar Coches</a>
</div>
@endsection
