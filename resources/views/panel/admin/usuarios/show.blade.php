<div class="modal fade" id="usuarioModal{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel{{ $usuario->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usuarioModalLabel{{ $usuario->id }}"> Detalles de usuario </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Nombre Completo </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->name }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * DNI </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->dni }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Email </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->email }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Rol </label>
                        <p class="col-sm-7 col-form-label"> 
                            <span class="badge badge-secondary text-uppercase">
                                {{ strtoupper(str_replace('_', ' ', $usuario->rol)) }} 
                            </span>
                        </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Telefono </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->telefono }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Domicilio </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->domicilio }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Fecha creacion </label>
                        <p class="col-sm-7 col-form-label"> {{ $usuario->created_at }} </p>
                    </div>

                    <div class="row">
                        <label class="col-sm-5 col-form-label"> * Estado </label>
                        <p class="col-sm-7 col-form-label"> 
                            @if ($usuario->activo == 0)
                                <span class="badge badge-danger">INACTIVO</span>
                            @else
                                <span class="badge badge-success">ACTIVO</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
