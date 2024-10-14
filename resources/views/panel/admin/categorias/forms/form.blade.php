<div class="card mb-5">
    <form action="{{ $categoria->id ? route('categoria.update', $categoria) : route('categoria.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($categoria->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre" name="nombre"
                        value="{{ old('nombre', optional($categoria)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo">
                        <option value="1" @if ($categoria->activo) {{"selected"}} @endif>Activado</option>
                        <option value="0" @if (isset($categoria->activo) && !$categoria->activo) {{"selected"}} @endif>Desactivado</option>
                    </select>
                    @error('activo')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer">
<<<<<<< HEAD
            <button id="update-button" type="submit" class="btn btn-success text-uppercase">
=======
            <button  id="update-button" type="submit" class="btn btn-success text-uppercase">
>>>>>>> 878bf5679d00d8b78923be80f9fa19c209553ed6
                {{ $categoria->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
@push('js')
@endpush

