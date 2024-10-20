<div class="card mb-5">
    <form action="{{ $compra->id ? route('compras.update', $compra) : route('compras.store') }}" method="POST">
        @csrf

        @if ($compra->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="id_proveedor" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
                    @if (is_null($compra->id))
                        <select id="id_proveedor" name="id_proveedor" class="form-control @error('id_proveedor') is-invalid @enderror">
                            <option disabled selected>Seleccione un proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                @if($proveedor->activo == 1)
                                    <option
                                        {{ $compra->id_proveedor && $compra->id_proveedor == $proveedor->id ? 'selected' : '' }}
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
                        <p>{{ $compra->proveedor->razon_social }}</p>
                    @endif
                </div>
            </div>
        
            <div class="mb-3 row">
                <label for="id_forma_pago" class="col-sm-4 col-form-label"> * Forma de pago </label>
                <div class="col-sm-8">
                    @if (is_null($compra->id))
                        <select id="id_forma_pago" name="id_forma_pago" class="form-control @error('id_forma_pago') is-invalid @enderror">
                            <option disabled selected>Seleccione una forma de pago</option>
                            @foreach ($formas_pagos as $forma_pago)
                                @if($forma_pago->activo == 1)
                                    <option {{$compra->id_forma_pago && $compra->id_forma_pago == $forma_pago->id ? 'selected' : '' }}
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
                        <p> {{ $compra->forma_pago->nombre}} </p>
                    @endif
                </div>
            </div> 
            

        @if ($compra->id)
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione una estado</option>
                        @foreach($estados as $key => $estado_pedido)
                            <option value="{{ $key }}" {{ $compra->estado_pedido == $key ? 'selected' : '' }}>
                            {{ $estado_pedido }}
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
                {{ $compra->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>