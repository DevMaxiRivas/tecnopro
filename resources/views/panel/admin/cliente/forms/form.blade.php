<div class="card mb-5" style="flex-grow: 2">
    <form action="{{ $cliente->id ? route('cliente.actualizar', $cliente->id) : route('cliente.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($cliente->id)
            @method('PUT')
        @endif

        <div class="card-body">
            <h5>Mis datos:</h5>
           
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-4 col-form-label"> * Nombre: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', optional($cliente)->name) }}">
                            @error('name')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="dni" class="col-sm-4 col-form-label"> * DNI: </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni"
                                name="dni" placeholder="Sin puntos" value="{{ old('dni', optional($cliente)->dni) }}">
                            @error('dni')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>
                
            <div class="mb-3 row">
                <label for="email" class="col-sm-4 col-form-label"> * E-mail: </label>
                <div class="col-sm-8">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', optional($cliente)->email) }}">
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="telefono" class="col-sm-4 col-form-label"> * Teléfono: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        name="telefono" placeholder="Solo números"
                        value="{{ old('telefono', optional($cliente)->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="direccion" class="col-sm-4 col-form-label"> * Domicilio: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('domicilio') is-invalid @enderror" id="domicilio"
                        name="domicilio" placeholder="" value="{{ old('domicilio', optional($cliente)->domicilio) }}">
                    @error('domicilio')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>


        </div> {{-- cierre div card-body --}}

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $cliente->id ? 'Actualizar Datos' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>

<div class="card mb-5" style="flex-grow: 1">
    <form action="{{ $cliente->id ? route('cliente.actualizar', $cliente->id) : route('cliente.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if ($cliente->id)
            @method('PUT')
        @endif

        <input type="hidden" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ $cliente->name }}">

        <!--<input type="hidden" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
            name="apellido" value="{{ $cliente->apellido }}"> -->

        <input type="hidden" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni"
            placeholder="Sin puntos" value="{{ $cliente->dni }}">


        <input type="hidden" class="form-control @error('email') is-invalid @enderror" id="email"
            name="email" value="{{ $cliente->email }}">


        <input type="hidden" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
            name="telefono" placeholder="Solo números" value="{{ $cliente->telefono }}">


        <input type="hidden" class="form-control @error('domicilio') is-invalid @enderror" id="domicilio"
            name="domicilio" placeholder="" value="{{ $cliente->domicilio }}">

        <div class="card-body">
            <h5>Cambiar contraseña:</h5>
            <div class="mb-3 row">
                <label for="current_password" class="col-sm-4 col-form-label">Contraseña Actual:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                        id="current_password" name="current_password" value="" required>
                    @error('current_password')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-4 col-form-label">Nueva Contraseña: </label>
                <div class="col-sm-8">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" name="password" value="" required>
                    @error('password')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password-confirm" class="col-sm-4 col-form-label">Confirmar Nueva Contraseña: </label>
                <div class="col-sm-8">
                    <input type="password" class="form-control @error('password-confirm') is-invalid @enderror"
                        id="password-confirm" name="password_confirmation" value="" required>
                    @error('password-confirm')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
            </div>
        </div> {{-- cierre div card-body --}}

        <div class="card-footer">
            <button type="submit" class="btn btn-success text-uppercase">
                {{ $cliente->id ? 'Actualizar Contraseña' : 'Guardar' }}
            </button>
        </div>
    </form>
</div>
