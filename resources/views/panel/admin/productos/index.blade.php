{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
{{-- @section('plugins.Datatables', true) --}}
{{-- @section('plugins.Sweetalert2', true) --}}

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Productos')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>&nbsp;<strong>MIS PRODUCTOS</strong></h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">

                <a href="{{ route('producto.create') }}" class="btn btn-success text-uppercase">
                    Nuevo Producto
                </a>

                {{-- <a href="{{ route('exportar-productos-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                </a>

                <a href="{{ route('exportar-productos-excel') }}" class="btn btn-success" title="Excel">
                    <i class="fas fa-file-excel"></i>
                </a> --}}


            </div>

            @if (session('alert'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="float-right ml-5 ">

                            <label for="filtroSelect">Filtrar por estado:</label>
                            <select id="filtroSelect" class="form-select">
                                <option value="">Mostrar todos</option>
                                <option value="1">Activado</option>
                                <option value="0">Desactivado</option>
                            </select>

                        </div> --}}
                        @if (count($productos) > 0)
                            <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-uppercase">Codigo</th>
                                        <th scope="col" class="text-uppercase">Nombre</th>
                                        <th scope="col" class="text-uppercase">Categoría</th>
                                        {{-- <th scope="col" class="text-uppercase">Marca</th> --}}
                                        <th scope="col" class="text-uppercase">Precio</th>
                                        <th scope="col" class="text-uppercase">Stock</th>
                                        <th scope="col" class="text-uppercase">Imagen</th>
                                        <th scope="col" class="text-uppercase">Activo</th>
                                        <th scope="col" class="text-uppercase text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ $producto->id }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->categoria->nombre }}</td>
                                            {{-- <td>{{ $producto->marca->descripcion}}</td> --}}
                                            {{-- <td>{{ $producto->marca ? $producto->marca->descripcion : 'N/A'}}</td> --}}
                                            <td>$ {{ $producto->precio }}</td>
                                            <td class='text-center'>
                                                @if ($producto->stock_disponible == 0)
                                                    <span class="badge badge-danger">SIN STOCK</span>
                                                @else
                                                    {{ $producto->stock_disponible }}
                                                @endif
                                            <td>
                                                <img src="{{ $producto->url_imagen }}" alt="{{ $producto->nombre }}"
                                                    class="img-fluid" style="width: 150px;">
                                            </td>
                                            <td>
                                                @if ($producto->activo == 0)
                                                    <span class="badge badge-danger">INACTIVO</span>
                                                @else
                                                    <span class="badge badge-success">ACTIVO</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                            <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-uppercase">
                                                    Eliminar
                                                </button>
                                                <div>
                                                    <label class="switch">
                                                        <input type="checkbox" class="miInterruptor" value="{{ $producto->activo }}" data-change-id="{{ $producto->id }}">
                                                        <span class="slider"> <p class="estadop" style="visibility: hidden">{{ $producto->activo }}</p></span>
                                                    
                                                    </label>
                                                </div
                                            </form> 
                                        </td> --}}
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="#{{-- route('producto.show', $producto) --}}" title="Ver" data-toggle="modal"
                                                        data-target="#productoModal{{ $producto->id }}"
                                                        class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                                        <i class="far fa-eye" aria-hidden="true"></i>
                                                    </a>

                                                    <a href="#{{-- route('producto.edit', $producto) --}}" title="Editar"
                                                        class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>

                                                    {{-- <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger text-uppercase">
                                                        Eliminar
                                                    </button>
                                                </form> --}}
                                                </div>
                                            </td>
                                        </tr>
                                        @include('panel.admin.productos.show')
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger mb-0" role="alert">
                                No hay productos disponibles
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @stop

    {{-- Importacion de Archivos CSS --}}
    @section('css')

    @stop


    {{-- Importacion de Archivos JS --}}
    @section('js')
        {{-- <script>
            var cambiarEstadoUrl = '{{ route('cambiar.estado.producto') }}';
            var token = '{{ csrf_token() }}';
        </script> --}}

        {{-- <script src="{{ asset('js/button_switch.js') }}"></script> --}}
        {{-- La funcion asset() es una funcion de Laravel PHP que nos dirige a la carpeta "public" --}}
        {{-- <script src="{{ asset('js/productos.js') }}"></script> --}}
    @stop
