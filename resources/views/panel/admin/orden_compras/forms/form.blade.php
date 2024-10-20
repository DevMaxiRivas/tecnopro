<div class="card mb-5">
    <form action="{{ route('orden_compras.update', $compra) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            <!-- Proveedor (solo como texto, no editable) -->
            <div class="mb-3 row">
                <label for="compra" class="col-sm-4 col-form-label"> * Número orden de compra </label>
                <div class="col-sm-8">
                    <p>{{ $compra->id }}</p>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="forma_pago" class="col-sm-4 col-form-label"> * Número de solicitud de cotización </label>
                <div class="col-sm-8">
                    @if ($compra->forma_pago)
                        <p>{{ $compra->forma_pago->nombre }}</p>
                    @else
                        <p>No hay un nro de cotizacion</p>
                    @endif
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="proveedores" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
                    @if ($compra->proveedor)
                        <p>{{ $compra->proveedor->razon_social }}</p>
                    @else
                        <p>No hay un proveedor asociado</p>
                    @endif
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="fecha_creacion" class="col-sm-4 col-form-label"> * Fecha de creación </label>
                <div class="col-sm-8">
                    <p>{{ $compra->created_at }}</p>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="hora_creacion" class="col-sm-4 col-form-label"> * Hora de creación </label>
                <div class="col-sm-8">
                    <p>{{ $compra->created_at }}</p> 
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="estado_actual" class="col-sm-4 col-form-label"> * Estado actual </label>
                <div class="col-sm-8">
                    <p>{{ $compra->estado_pedido }}</p>
                </div>
            </div>
            

            <!-- Estado (editable) -->
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Nuevo Estado </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione un estado</option>
                        @foreach($estados as $key => $estado_compra)
                            <option value="{{ $key }}" {{ $compra->estado_compra == $key ? 'selected' : '' }}>
                                {{ $estado_compra }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-end items-center">
            <button type="submit" class="btn btn-success text-uppercase">Actualizar</button>
        </div>
    </form>
</div>
