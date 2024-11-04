<div class="card mb-5">
    <form action="{{ $usuario->id ? route('usuarios.update', $usuario) : route('usuarios.store') }}" method="POST">
        
        @csrf
        
        @if ($usuario->id)
            @method('PUT')
        @endif

        <div class="card-body">

            <div class="mb-3 row">
                <label for="name" class="col-sm-4 col-form-label"> * Nombre Completo </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name"
                        value="{{ old('name', optional($usuario)->name) }}">
                    
                    @error('name')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="dni" class="col-sm-4 col-form-label"> * DNI</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('dni') is-invalid @enderror"
                        id="dni" dni="dni"
                        value="{{ old('dni', optional($usuario)->dni) }}">
                    
                    @error('dni')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="rol" class="col-sm-4 col-form-label"> * Rol </label>
                <div class="col-sm-8">
                    <select class="form-control @error('rol') is-invalid @enderror" name="rol" id="rol" value="{{ old('rol', optional($usuario)->rol) }}">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol }}" @if ($usuario->rol == $rol) {{"selected"}} @endif>
                                {{ strtoupper(str_replace('_', ' ', $rol)) }}
                            </option>
                        @endforeach
                    </select>

                    @error('rol')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-4 col-form-label"> * Contraseña </label>
                <div class="col-sm-8">
                    
                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                        id="password" dni="password">

                    @error('password')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-4 col-form-label"> * Email </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email"
                        value="{{ old('email', optional($usuario)->email) }}">
                    
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="telefono" class="col-sm-4 col-form-label"> * Telefono </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                        id="telefono" name="telefono"
                        value="{{ old('telefono', optional($usuario)->telefono) }}">
                    
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="direccion" class="col-sm-4 col-form-label"> * Direccion </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                        id="direccion" name="direccion"
                        value="{{ old('direccion', optional($usuario)->direccion) }}">
                    
                    @error('direccion')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $usuario->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>