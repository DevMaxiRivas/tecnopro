<div class="card mb-5">
    <form action="{{ route('ventas.empleadoventa.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-header">
            <h5 class="card-title">Información de la Venta</h5>
        </div>

        <div class="card-body">
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Código</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->id }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Fecha</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Hora</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->created_at->format('H:i:s') }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Cliente</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">{{ $venta->cliente->name }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Total</label>
                <div class="col-sm-8">
                    <p class="form-control-plaintext">${{ number_format($venta->total, 2) }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">* Estado Actual</label>
                <div class="col-sm-8">
                    <p>
                        @switch($venta->estado)
                            @case(0)
                                <span class="badge badge-warning">Pendiente</span>
                            @break

                            @case(1)
                                <span class="badge badge-success">Pagado</span>
                            @break

                            @case(2)
                                <span class="badge badge-info">En preparación</span>
                            @break

                            @case(3)
                                <span class="badge badge-primary">Enviado</span>
                            @break

                            @case(4)
                                <span class="badge badge-danger">Cancelado</span>
                            @break
                        @endswitch
                    </p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label">* Nuevo estado</label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione un estado</option>
                        @foreach ($estados as $key => $estado)
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
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success text-uppercase">
                Actualizar
            </button>
        </div>
    </form>
</div>
