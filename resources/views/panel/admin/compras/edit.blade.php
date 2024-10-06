@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>
        <strong>
            Editar Orden de Compra N°{{ $compra->id }}  
        </strong>
    </h1>
    <br>
    <h5>
    <strong>
            Proveedor: {{$compra->proveedor->razon_social}}
    </strong>    
    </h5>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('compras.index') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>
        </div>
        <div class="col-12">
            @include('panel.admin.compras.forms.form')
                {{--<div class="mb-3 row">
                <label for="id_estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select id="id_estado" name="id_estado" class="form-control @error('id_estado') is-invalid @enderror">
                        <option disabled selected>Seleccione una estado</option>
                        @foreach($estados as $key => $estado)
                            <option value="{{ $key }}" {{ $compras->estado == $key ? 'selected' : '' }}>
                            {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_estado')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                </div> --}}
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop