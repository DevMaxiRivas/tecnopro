<div class="card mb-5">
    <form action="{{ $orden_compra->id ? route('orden_compras.update', $orden_compra) : route('orden_compras.store') }}" method="POST">
        @csrf

        @if ($orden_compra->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="id_proveedor" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
                    @if (is_null($orden_compra->id))
                        <select id="id_proveedor" name="id_proveedor" class="form-control @error('id_proveedor') is-invalid @enderror">
                            <option disabled selected>Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('id_proveedor')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    @else
                        <p> {{ $orden_compra->proveedor->razon_social}} </p>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label for="id_forma_pago" class="col-sm-4 col-form-label"> * Forma de pago </label>
                <div class="col-sm-8">
                    @if (is_null($orden_compra->id))
                        <select id="id_forma_pago" name="id_forma_pago" class="form-control @error('id_forma_pago') is-invalid @enderror">
                            <option disabled selected>Seleccione una forma de pago</option>
                            @foreach ($formas_pagos as $forma_pago)
                                @if($forma_pago->activo == 1)
                                    <option {{$orden_compra->id_forma_pago && $orden_compra->id_forma_pago == $forma_pago->id ? 'selected' : '' }}
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
                        <p> {{ $orden_compra->forma_pago->nombre}} </p>
                    @endif
                </div>
            </div>

            @if (is_null($orden_compra->id))
            <div class="mb-3 row">
                <label for="id_compra" class="col-sm-4 col-form-label"> * Solicitud de Cotización </label>
                <div class="col-sm-8">
                    <select id="id_compra" name="id_compra" class="form-control @error('id_compra') is-invalid @enderror">
                        <option disabled selected>Seleccione una Solicitud de Cotización</option>
                        <!-- Opciones se llenarán dinámicamente -->
                    </select>
                    @error('id_compra')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            @endif 

            @if ($orden_compra->id)
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione una estado</option>
                        @foreach($estados as $key => $estado_compra)
                            <option value="{{ $key }}" {{ $orden_compra->estado_compra == $key ? 'selected' : '' }}>
                            {{ $estado_compra }}
                            </option>
                        @endforeach
                    </select>
                    
                    @error('estado')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            @endif

            <div class="card-footer d-flex justify-content-end items-center">
                <button type="submit" class="btn btn-success text-uppercase">
                    {{ $orden_compra->id ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </div>
    </form>
</div>
