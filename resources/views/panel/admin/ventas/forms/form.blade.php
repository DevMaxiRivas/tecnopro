<div class="card mb-5">
    <form action="{{ $venta->id ? route('ventas.update', $venta) : route('ventas.store') }}" method="POST">
        @csrf
        @if ($venta->id)
            @method('PUT')
        @endif
        
        <div class="card-header">
            <h5 class="card-title">Información de la Venta</h5>
        </div>

        <div class="card-body">
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Código</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->id }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Fecha</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Hora</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->created_at->format('H:i:s') }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Cliente</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->cliente->name }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Total</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">${{ number_format($venta->total, 2) }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label">* Estado Actual</label>
                <div class="col-sm-8">
                    <p>
                        @if ($venta->estado == 0)
                            <span class="badge badge-warning">Pendiente</span>
                        @elseif ($venta->estado == 1)
                            <span class="badge badge-success">Pagado</span>
                        @elseif ($venta->estado == 2)
                            <span class="badge badge-info">En preparación</span>
                        @elseif ($venta->estado == 3)
                            <span class="badge badge-primary">Enviado</span>
                        @elseif ($venta->estado == 4)
                            <span class="badge badge-danger">Cancelado</span>
                        @endif
                    </p>
                </div>
            </div>
            @if ($venta->id)
                <div class="mb-3 row">
                    <label for="estado" class="col-sm-4 col-form-label">* Nuevo estado</label>
                    <div class="col-sm-8">
                        <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                            <option disabled selected>Seleccione un estado</option>
                            @foreach($estados as $key => $estado)
                                <option value="{{ $key }}" {{ $venta->estado == $key ? 'selected' : '' }}>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endif    
        </div>

        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $venta->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

