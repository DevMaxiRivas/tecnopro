<div class="card mb-5">
    <form action="{{ $compra->id ? route('compras.update', $compra) : route('compras.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($compra->id)
            @method('PUT')
        @endif

        <div class="card-body">            


        @if (is_null($compra->id))
            <div class="mb-3 row">
                <label for="id_proveedor" class="col-sm-4 col-form-label"> * Proveedor </label>
                <div class="col-sm-8">
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
                </div>
            </div>
        
            <div class="mb-3 row">
                <label for="id_forma_pago" class="col-sm-4 col-form-label"> * Forma de pago </label>
                <div class="col-sm-8">
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
                </div>
            </div> 
            @endif
            @if ($compra->id)
            <div class="mb-3 row">
                <label for="estado" class="col-sm-4 col-form-label"> * Estado </label>
                <div class="col-sm-8">
                    <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                        <option disabled selected>Seleccione una estado</option>
                        @foreach($estados as $key => $estado)
                            <option value="{{ $key }}" {{ $compra->estado == $key ? 'selected' : '' }}>
                            {{ $estado }}
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
            /* const regex = /^\d+(\.\d{1,2})?$/;
            const $precio = document.getElementById('precio');

            // evento del input para ingresar el precio
            $precio.addEventListener('input', function(e) {
                const value = e.target.value;

                // Si el valor no coincide con la expresión regular
                if (! regex.test(value)) {
                    e.target.value = value.slice(0, -1); // Elimina el último carácter
                }
            }); */
        });
    </script>
@endpush