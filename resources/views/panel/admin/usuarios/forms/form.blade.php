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
                        id="dni" name="dni"
                        value="{{ old('dni', optional($usuario)->dni) }}">
                    
                    @error('dni')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="rol" class="col-sm-4 col-form-label"> * Rol </label>
                <div class="col-sm-8">
                    @if ($usuario->id)
                        <p> {{ strtoupper(str_replace('_', ' ', $usuario->rol)) }} </p>
                    @else
                        <select class="form-control @error('rol') is-invalid @enderror" name="rol" id="rol" value="{{ old('rol', optional($usuario)->rol) }}">
                            @foreach ($roles as $rol)
                                <option value="{{ $rol }}" @if ($usuario->rol == $rol) {{"selected"}} @endif>
                                    {{ strtoupper(str_replace('_', ' ', $rol)) }}
                                </option>
                            @endforeach
                        </select>
                    @endif

                    @error('rol')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            @if (! $usuario->id)
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label"> * Contraseña </label>
                    <div class="col-sm-8">
                        
                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password">

                        @error('password')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
            @endif

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
                <label for="domicilio" class="col-sm-4 col-form-label"> * Domicilio </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('domicilio') is-invalid @enderror"
                        id="domicilio" name="domicilio"
                        value="{{ old('domicilio', optional($usuario)->domicilio) }}">
                    
                    @error('domicilio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            @if ($usuario->id)
                <div class="mb-3 row">
                    <label for="activo" class="col-sm-4 col-form-label"> * Estado </label>
                    <div class="col-sm-8">
                        <select class="form-control @error('activo') is-invalid @enderror" name="activo" id="activo" value="{{ old('activo', optional($usuario)->activo) }}">
                            <option value="1" @if ($usuario->activo) {{ "selected" }} @endif>Activado</option>
                            <option value="0" @if (isset($usuario->activo) and ! $usuario->activo) {{ "selected" }} @endif>Desactivado</option>
                        </select>
                        
                        @error('activo')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
            @endif

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $usuario->id ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>