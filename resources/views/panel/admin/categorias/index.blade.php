@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('title', 'Categorías')

@section('content_header')
    <h1>&nbsp;<strong>MIS CATEGORIAS</strong></h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('categoria.create') }}" class="btn btn-success text-uppercase">
                Nueva Categoria 
            </a>
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
                   {{-- <div class="float-right ml-5">
                        <label for="filtroSelect">Filtrar por estado:</label>
                        <select id="filtroSelect" class="form-select">
                            <option value="">Mostrar todos</option>
                            <option value="1">Activado</option>
                            <option value="0">Desactivado</option>
                        </select>
                    </div>--}}
                    @if (count($categorias) > 0)
                    <table id="datatable" class="table table-striped table-hover w-100" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col" class="text-uppercase text-center">#</th>
                                <th scope="col" class="text-uppercase text-center">Nombre</th>
                                <th scope="col" class="text-uppercase text-center">Activo</th>
                                <th scope="col" class="text-uppercase text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                            <tr>
                                <td class="text-center">{{ $categoria->id }}</td>
                                <td class="text-center">{{ $categoria->nombre }}</td>
                                <td class="text-center">
                                    @if ($categoria->activo == 0)
                                        <span class="badge badge-danger">INACTIVO</span>
                                    @else
                                        <span class="badge badge-success">ACTIVO</span>
                                    @endif
                                    {{-- <form action="{{ route('categoria.destroy', $categoria) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="miInterruptor" data-change-id="{{ $categoria->id }}" class="miInterruptor" value="{{ $categoria->activo }}" {{ $categoria->activo ? 'checked' : '' }}>
                                                <span class="slider"><p class="estadop" style="visibility: hidden">{{ $categoria->activo }}</p></span>
                                            </label>
                                        </div>
                                    </form> --}}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="#{{-- route('categoria.show', $categoria) --}}" title="Ver" data-toggle="modal" data-target="#categoriaModal{{ $categoria->id }}" class="btn btn-sm btn-info text-white text-uppercase me-1 mr-2">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="#{{-- route('categoria.edit', $categoria) --}}" title="Editar" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            {{-- @include('panel.admin.categorias.show') --}}
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-danger mb-0" role="alert">
                            No hay categorias disponibles
                        </div>                          
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
