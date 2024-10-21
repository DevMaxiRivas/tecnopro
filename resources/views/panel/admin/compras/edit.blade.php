@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>
        <strong>
            Editar Solicitud N° {{ $compra->id }}  
        </strong>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('compras.CotizacionIndex') }}" class="btn btn-sm btn-secondary text-uppercase">
                Volver Atras
            </a>

        </div>

        @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

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