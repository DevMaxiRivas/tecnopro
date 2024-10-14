<div class="card mb-5">
    <form action="{{ $ventas->id ? route('ventas.update', $ventas) : route('ventas.store') }}" method="POST">

        @csrf

        @if ($ventas->id)
            @method('PUT')
        @endif

        <div class="card-body">

            {{-- @if ($post->id) --}}
            {{-- <div class="mb-3 row">
                <img src="{{ $producto->imagen ?? 'https://via.placeholder.com/1024'}}" alt="{{ $producto->nombre }}" id="image_preview" class="img-fluid" style="object-fit: cover; object-position: center; height: 420px; width: 100%;">
            </div> --}}
            {{-- @endif --}}

            <div class="mb-3 row">
                <label for="id" class="col-sm-4 col-form-label"> * # </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                        name="id" value="{{ old('id', optional($ventas)->id) }}">

                    @error('id')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="id_forma_pago" class="col-sm-4 col-form-label"> * Forma de pago </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('id_forma_pago') is-invalid @enderror"
                        id="id_forma_pago" name="id_forma_pago"
                        value="{{ old('id_forma_pago', optional($ventas)->id_forma_pago) }}">

                    @error('id_forma_pago')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="id_cliente" class="col-sm-4 col-form-label"> * Cliente </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('id_cliente') is-invalid @enderror" id="id_cliente"
                        name="id_cliente" value="{{ old('cuit', optional($ventas)->id_cliente) }}">

                    @error('id_cliente')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="id_empleado" class="col-sm-4 col-form-label"> * Empleado </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('id_empleado') is-invalid @enderror"
                        id="id_empleado" name="id_empleado"
                        value="{{ old('id_empleado', optional($ventas)->id_empleado) }}">

                    @error('id_empleado')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            @if ($ventas->id)
                <div class="mb-3 row">
                    <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                    <div class="col-sm-8">
                        <select class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo"
                            value="{{ old('activo', optional($ventas)->activo) }}">
                            <option value="1" @if ($ventas->activo) {{ 'selected' }} @endif>
                                Activado</option>
                            <option value="0" @if (isset($ventas->activo) and !$ventas->activo) {{ 'selected' }} @endif>
                                Desactivado</option>
                        </select>

                        {{-- <input type="text" class="form-control @error('activo') is-invalid @enderror" id="activo"
                        name="activo" value="{{ old('activo', optional($ventas)->activo) }}"> --}}
                        @error('activo')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
            @endif
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
            <button {{ $ventas->id ? 'id=update-button' : '' }} type="submit" class="btn btn-success text-uppercase">
                {{ $ventas->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>
