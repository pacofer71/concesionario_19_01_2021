@extends('plantillas.plantilla1')
@section('titulo')
    coches
@endsection
@section('cabecera')
    Coches Clásicos S.A.
@endsection
@section('contenido')
    @if ($text = Session::get('mensaje'))
        <p class="bg-secondary text-white p-2 my-3">{{ $text }}</p>
    @endif
    <form name="search" method="get" action="{{ route('coches.index') }}" class="form-inline">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('coches.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Crear Coche</a>
                <a href="{{ route('inicio') }}" class="btn btn-primary"><i class="fa fa-house-user"></i> Inicio</a>
            </div>
            <div class="col-2">
                <select name='marca_id' class='form-select mr-2 text-nowrap' onchange="this.form.submit()">
                    <option value='%'>Todas</option>
                    <option value='-1'>Sin Marca</option>
                    @foreach ($marcas as $marca)
                        @if ($marca == $request->marca)
                            <option selected value='{{ $marca->id }}'>{{ $marca->nombre }}</option>

                        @else
                            <option value='{{ $marca->id }}'>{{ $marca->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="kilometros"   class="form-select" onchange="this.form.submit()">
                    <option value="%">Cualquiera</option>
                    <option value="1">0-10000</option>
                    <option value="2">10000-30000</option>
                    <option value="3">30000-50000</option>
                    <option value="4">Más de 50000</option>
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-info ml-2"><i class="fa fa-search"></i> Buscar</button>
            </div>


        </div>

    </form>



    <table class="table table-striped table-primary mt-3">
        <thead>
            <tr>
                <th scope="col">Detalle</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Color</th>
                <th scope="col">Kilometros</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coches as $item)
                <tr style="vertical-align: middle">
                    <th scope="row">
                        <a href="{{ route('coches.show', $item) }}" class="btn btn-info btn-lg"><i class="fa fa-info"></i>
                            Detalles</a>
                    </th>
                    <td>
                        @if (isset($item->marca->nombre))
                            {{ $item->marca->nombre }}
                        @else
                            Sin Marca
                        @endif
                    </td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->kilometros }}</td>
                    <td>
                        <form name="a" action="{{ route('coches.destroy', $item) }}" method='POST' class="form-inline">
                            @csrf
                            @method("DELETE")
                            <a href="{{ route('coches.edit', $item) }}" class="btn btn-primary btn-lg"><i
                                    class="fa fa-edit"></i> Editar</a>
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('¿Borrar Coche')">
                                <i class="fas fa-trash"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $coches->appends(Request::except('page'))->links() }}
@endsection
