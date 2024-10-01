<div class="card mb-5">
    <form action="{{ $producto->id ? route('producto.update', $producto) : route('producto.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($producto->id)
            @method('PUT')
        @endif

        <div class="card-body">

            {{-- @if (!empty($producto->id)) --}}
            <div class="mb-3 row">
                <img src="{{ $producto->url_imagen ?? 'https://via.placeholder.com/1024'}}" alt="{{ $producto->nombre }}" id="image_preview" class="img-fluid" style="object-fit: cover; object-position: center; height: 420px; width: 100%;">
            </div>
            {{-- @endif --}}

            <div class="mb-3 row">
                <label for="imagen" class="col-sm-4 col-form-label"> * Imagen </label>
                <div class="col-sm-8">
                    <input class="form-control @error('imagen') is-invalid @enderror" type="file" id="imagen" name="imagen" accept="image/jpeg,png,jpg,webp">
                    
                    @error('imagen')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nombre" class="col-sm-4 col-form-label"> * Nombre</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        name="nombre" placeholder="Ingrese nombre"
                        value="{{ old('nombre', optional($producto)->nombre) }}" maxlength="120">
                    
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            

             {{-- <div class="mb-3 row">
                <label for="proveedor" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
                    
                    <select id="id_proveedor" name="id_proveedor" class="form-control @error('id_proveedor') is-invalid @enderror">
                        <option disabled selected>---- seleccione un proveedor ----</option>
                        @foreach ($proveedores as $proveedor)
                        @if($proveedor->activo == 1)
                            <option {{$producto->id_proveedor && $producto->id_proveedor == $proveedor->id ? 'selected': ''}} value="{{ $proveedor->id }}"> 
                                {{ $proveedor->descripcion }}
                            </option>
                        @endif    
                        @endforeach 
                    </select>
                    @error('id_proveedor')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div> --}}

            <div class="mb-3 row">
                <label for="id_categoria" class="col-sm-4 col-form-label"> * Categoria </label>
                <div class="col-sm-8">
                    <select id="id_categoria" name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror">
                        <option disabled selected>Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            @if($categoria->activo == 1)
                                <option
                                    {{ $producto->id_categoria && $producto->id_categoria == $categoria->id ? 'selected' : '' }}
                                    value="{{ $categoria->id }}">
                                        {{ $categoria->nombre }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    
                    @error('id_categoria')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            {{-- <div class="mb-3 row">
                <label for="id_marca" class="col-sm-4 col-form-label"> * Marca </label>
                <div class="col-sm-8">
                    <select id="id_marca" name="id_marca" class="form-control @error('id_marca') is-invalid @enderror">
                        <option disabled selected>---- seleccione una marca ----</option>
                        @foreach ($marcas as $marca)
                        @if($marca->activo == 1)
                            <option {{$producto->id_marca && $producto->id_marca == $marca->id ? 'selected' : '' }}
                                value="{{ $marca->id }}">
                                {{ $marca->descripcion }}
                            </option>
                        @endif
                        @endforeach
                    </select>
                    @error('id_marca')
                    <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div> --}}

            <div class="mb-3 row">
                <label for="precio" class="col-sm-4 col-form-label"> * Precio </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('precio') is-invalid @enderror" id="precio" placeholder="Ingrese precio"
                        name="precio" value="{{ old('precio', optional($producto)->precio) }}" maxlength="9">
                    
                    @error('precio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="precio" class="col-sm-4 col-form-label"> * Stock disponible </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('stock_disponible') is-invalid @enderror" id="stock_disponible" placeholder="Ingrese stock disponible"
                        name="stock_disponible" value="{{ old('stock_disponible', optional($producto)->stock_disponible) }}" maxlength="9">
                    
                        @error('stock_disponible')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="descripcion" class="col-sm-4 col-form-label"> * Descripción </label>
                <div class="col-sm-8">
                    <textarea id="descripcion" name="descripcion" rows="10" class="form-control @error('descripcion') is-invalid @enderror"
                    placeholder="Ingrese una descripción del producto, información técnica, características ó detalles importantes para el cliente.">{{ old('descripcion', optional($producto)->descripcion) }}</textarea>
                    
                    @error('descripcion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            {{-- @if ($producto->id) --}}
                <div class="mb-3 row">
                    <label for="activo" class="col-sm-4 col-form-label"> * Estado </label>
                    <div class="col-sm-8">
                        <select class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo" value="{{ old('activo', optional($producto)->activo) }}">
                            <option value="1" @if ($producto->activo) {{ "selected" }} @endif>Activado</option>
                            <option value="0" @if (isset($producto->activo) and ! $producto->activo) {{ "selected" }} @endif>Desactivado</option>
                        </select>
                        
                        @error('activo')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
            {{-- @endif --}}

        </div>

        <div class="card-footer d-flex justify-content-end items-center">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $producto->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

@push('js')
    <script>
        // Evento que se dispara cuando se termina de cargar la pagina
        document.addEventListener("DOMContentLoaded", function(event) {
            const $image = document.getElementById('imagen');
        
            // evento del input para cargar una imagen
            $image.addEventListener('change', (e) => {

                const input = e.target;
                const imagePreview = document.querySelector('#image_preview');
                
                if(! input.files.length) return

                file = input.files[0];
                objectURL = URL.createObjectURL(file);
                imagePreview.src = objectURL;
            });

            // Expresión regular para validar el precio
            const regex = /^\d+(\.\d{1,2})?$/;
            const $precio = document.getElementById('precio');

            // evento del input para ingresar el precio
            $precio.addEventListener('input', function(e) {
                const value = e.target.value;

                // Si el valor no coincide con la expresión regular
                if (! regex.test(value)) {
                    e.target.value = value.slice(0, -1); // Elimina el último carácter
                }
            });
        });
    </script>
@endpush
