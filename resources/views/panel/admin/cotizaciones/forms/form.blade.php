

<div class="card mb-5">
    <form action="{{ $compra->id ?: route('compras.StoreCotizacion', $compra)  }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        
        @if ($compra->id)
            @method('PUT')
        @endif

        <div class="card-body">
        <div class="mb-3 ">
            <input type="file" class="form-control @error('url_presupuesto') is-invalid @enderror" id="url_presupuesto" name="url_presupuesto" accept=".jpg,.png" required>
            @error('url_presupuesto')
                <div class="invalid-feedback">
                    {{ $message }} 
                </div>
            @enderror
        </div>

        <div class="card-footer">
            <button {{ $compra->id ? 'id=update-button' : '' }} type="submit" class="btn btn-sm btn-success text-uppercase ">
                {{ $compra->id ? 'Subir ' : 'no hay un id' }}
            </button>

            <a href="{{ route('compras.CotizacionIndex') }}" class="btn btn-sm btn-secondary text-uppercase">
                Cancelar 
            </a>
        </div>
    </form>
</div>

@push('js')
@endpush





          








