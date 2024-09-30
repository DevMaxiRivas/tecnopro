<div class="card mb-5">
    <form action="{{ $categoria->id ? route('categoria.update', $categoria) : route('categoria.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($categoria->id)
            @method('PUT')
        @endif

        <div class="card-body">

            {{-- @if ($post->id) --}}
            {{-- <div class="mb-3 row">
                <img src="{{ $producto->imagen ?? 'https://via.placeholder.com/1024'}}" alt="{{ $producto->nombre }}" id="image_preview" class="img-fluid" style="object-fit: cover; object-position: center; height: 420px; width: 100%;">
            </div> --}}
            {{-- @endif --}}



            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        id="descripcion" name="descripcion"
                        value="{{ old('descripcion', optional($categoria)->descripcion) }}">
                    @error('descripcion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo" value="{{ old('activo', optional($categoria)->activo) }}">
                        <option value="1" @if ($categoria->activo) {{"selected"}} @endif>Activado</option>
                        <option value="0" @if (isset($categoria->activo) and !$categoria->activo) {{"selected"}} @endif>Desactivado</option>
                    </select>

                    {{-- <input type="text" class="form-control @error('activo') is-invalid @enderror" id="activo"
                        name="activo" value="{{ old('activo', optional($categoria)->activo) }}"> --}}
                    @error('descripcion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            {{-- <div class="mb-3 row">
                <label for="imagen" class="col-sm-4 col-form-label"> * Imagen </label>
                <div class="col-sm-8">
                    <input class="form-control @error('imagen') is-invalid @enderror" type="file" id="imagen" name="imagen" accept="image/*">
                    @error('imagen')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                    </div>
                </div>
            --}}
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $categoria->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>

</div>

@push('js')
@endpush
