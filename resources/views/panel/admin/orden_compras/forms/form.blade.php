<div class="card mb-5">
    <form action="{{ $o_compras->id ? route('orden_compras.update', $o_compras) : route('orden_compras.store') }}" method="POST">
        @csrf

        @if ($o_compras->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="id_proveedor" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
                    @if (is_null($o_compras->id))
                        <select id="id_proveedor" name="id_proveedor" class="form-control @error('id_proveedor') is-invalid @enderror">
                            <option disabled selected>Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                @if($proveedor->activo == 1)
                                    <option
                                        {{ $o_compras->id_proveedor && $o_compras->id_proveedor == $proveedor->id ? 'selected' : '' }}
                                        value="{{ $proveedor->id }}">
                                            {{ $proveedor->razon_social }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        
                        @error('id_proveedor')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    @else
                        <p>{{ $o_compras->proveedor->razon_social }}</p>
                    @endif
                </div>
            </div>
        
            <div class="mb-3 row">
                <label for="id_forma_pago" class="col-sm-4 col-form-label"> * Forma de pago </label>
                <div class="col-sm-8">
                    @if (is_null($o_compras->id))
                        <select id="id_forma_pago" name="id_forma_pago" class="form-control @error('id_forma_pago') is-invalid @enderror">
                            <option disabled selected>Seleccione una forma de pago</option>
                            @foreach ($formas_pagos as $forma_pago)
                                @if($forma_pago->activo == 1)
                                    <option {{$o_compras->id_forma_pago && $o_compras->id_forma_pago == $forma_pago->id ? 'selected' : '' }}
                                        value="{{ $forma_pago->id }}">
                                        {{ $forma_pago->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('id_forma_pago')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    @else
                        <p> {{ $o_compras->forma_pago->nombre}} </p>
                    @endif
                </div>
            </div> 

            <!-- Campo de selección para Solicitudes de Cotización -->
            <div class="mb-3 row">
                <label for="id_solicitud" class="col-sm-4 col-form-label"> * Número de Solicitud de Cotización asociada </label>
                <div class="col-sm-8">
                    <select id="id_solicitud" name="id_solicitud" class="form-control">
                        <option disabled selected>Seleccione una Solicitud de Cotización</option>
                    </select>
                </div>
            </div>
            
        {{--@if (o_compras->id)
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Numero de solicitud de cotización </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione una estado</option>
                        @foreach($estados as $key => $estado)
                            <option value="{{ $key }}" {{ o_compras->estado == $key ? 'selected' : '' }}>
                            {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('estado')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        @endif--}}
            
        <div class="card-footer d-flex justify-content-end items-center">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $o_compras->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>


    