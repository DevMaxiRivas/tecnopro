@extends('frontend.layouts.master')
@section('title', 'Confirmar pedidos')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="section m-4 check-out">
    <div class="container p-3 rounded-3 add-shadow bg-white border-0 ">
        <div class="pt-3 pb-1 text-left">
          
          <h2><b>Completa tus datos</b></h2>
          <p class="lead">Automaticamente se cargan los datos de tu perfil, pero puedes cambiarlos dependiendo de quien reciba el paquete.</p>
        </div>
      
        <div class="row">
          <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-heading-h3"><b>Resumen de compra</b></span>
              <span class="badge badge-secondary badge-pill">{{ count($carrito) }}</span>
            </h4>
            <ul class="list-group mb-3">
                 @php ($total = 0)

                @foreach ($carrito as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div class="d-flex align-items-center">
                      <div class="me-1">
                        <img style="width: 50px; heigth: 50px" src="{{ $item->options->url_imagen }}" alt="{{ $item->name }}">
                      </div>
                      <div>
                        <h6 class="my-0">{{ $item->name }}</h6>
                        <small style="color: var(--enfasis); opacity: 0.9;">Cantidad: {{ $item->qty }}</small>
                      </div>
                    </div>
                    <span style="color: var(--enfasis); opacity: 0.9;" >${{ number_format($item->price * $item->qty, 2) }}</span>
                  </li>    
                
                
                  @php ($total += $item->price * $item->qty)
                 

                @endforeach
              
              <li class="list-group-item d-flex justify-content-between">
                <span>Total a pagar: </span>
                <strong style="color: var(--enfasis);">${{ number_format($total, 2) }}</strong>
              </li>
            </ul>
      
          </div>
          <div class="col-md-7 order-md-1">
            <h4 class="mb-3 text-heading-h3"><b>Datos del cliente</b></h4>
            <form class="needs-validation" novalidate action="{{ route('carrito.crearVenta') }}" method="POST">
              @csrf

              <div class="row">
                <div class="col-md-6 mb-3">

                  <label for="nombre" class="">Nombre Completo: </label>
                  <div class="">
                      <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                          name="nombre" value="{{ old('nombre', optional($cliente)->name) }}">
                      @error('nombre')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>
              {{-- <div class="col-md-6 mb-3">
                  <label for="apellido" class="">Apellido: </label>
                  <div class="">
                      <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                          name="apellido" value="{{ old('apellido', optional($pedido)->apellido) }}">
                      @error('apellido')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
              </div> --}}
              
                <div class="col-md-6 mb-3">
                  <label for="dni" class="">DNI: </label>
                  <div class="">
                      <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni"
                          name="dni" placeholder="Sin puntos" value="{{ old('dni', optional($cliente)->dni) }}">
                      @error('dni')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>
              </div>
      
              {{-- <div class="mb-3">
                <label for="dni" class="">DNI: </label>
                <div class="">
                    <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni"
                        name="dni" placeholder="Sin puntos" value="{{ old('dni', optional($pedido)->dni) }}">
                    @error('dni')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
              </div> --}}
              
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="email" class="">E-mail: </label>
                  <div class="">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                          name="email" value="{{ old('email', optional($cliente)->email) }}">
                      @error('email')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
  
                </div>
  
                <div class="col-md-6 mb-3">
                  <label for="telefono" class="">Teléfono: </label>
                  <div class="">
                      <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                          name="telefono" placeholder="" value="{{ old('telefono', optional($cliente)->telefono) }}">
                      @error('telefono')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>
              </div>
      
              <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="direccion" class="">Dirección de envío: </label>
                    <div class="">
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                            name="direccion" placeholder="" value="{{ old('direccion', optional($cliente)->domicilio) }}">
                        @error('direccion')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="codigo_postal" class="">Codigo Postal: </label>
                  <div class="">
                      <input type="number" class="form-control @error('codigo_postal') is-invalid @enderror" id="codigo_postal"
                          name="codigo_postal" placeholder="">
                      @error('codigo_postal')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="id_forma_pago" class="">Formas de pago: </label>
                    <select id="id_forma_pago" name="id_forma_pago" class="form-control @error('id_forma_pago') is-invalid @enderror">
                      <option disabled selected>Seleccione una forma de pago</option>
                      @foreach ($formas_pagos as $forma_pago)
                          <option value="{{ $forma_pago->id }}">
                              {{ $forma_pago->nombre }}
                          </option>
                      @endforeach
                  </select>
                  @error('id_forma_pago')
                      <div class="invalid-feedback"> {{ $message }} </div>
                  @enderror
                </div>
              </div>

              {{-- <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="latitud" class="">Latitud: </label>
                  <div class="">
                      <input type="number" class="form-control @error('latitud') is-invalid @enderror" id="latitud"
                          name="latitud" readonly placeholder="">
                      @error('latitud')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>

                <div class="col-md-6 mb-3">
                  <label for="longitud" class="">Longitud: </label>
                  <div class="">
                      <input type="number" class="form-control @error('longitud') is-invalid @enderror" id="longitud"
                          name="longitud" readonly placeholder="">
                      @error('longitud')
                          <div class="invalid-feedback"> {{ $message }} </div>
                      @enderror
                  </div>
                </div>
              </div> --}}

              <div class="d-flex flex-column">
                <div class="d-flex justify-content-between">
                <a style="border: 2px solid gray!important; background-color: gray;" class="d-flex align-items-center justify-content-around btn btn-atras color-atras btn-lg btn-block m-1" href="{{route('carrito.carrito')}}">
                  <i class="fas fa-shopping-cart me-1"></i>
                  Volver al carrito
                </a>
                <button class="d-flex align-items-center justify-content-around btn btn-enfasis color-enfasis btn-lg btn-block my-1 @if (!$total) disabled @endif" type=@if(!$total) "button" @else "submit" @endif>
                  <i class="fas fa-credit-card me-1"></i>
                  Confirmar compra
                </button>
              </div>

              <div class="d-flex justify-content-end mt-3">
                <img style="width: 100px; heigth: 100px;" src="{{ asset('imagenes/mercado_pago.png')}}" alt="Mercado Pago">
              </div>
            </form>
            <div class="text-secondary small">
              <br>
              <i class="fas fa-info-circle"></i> 
              Al confirmar el pedido, se te redirigirá a realizar el pago inmediatamente, si el pago falla puedes acceder al link de pago en cualquier momento desde tu panel en la opción "Mis compras".</div> 
            </div>
          </div>
        </div> 
      </div>
    </div>
@endsection

@section('styles')

@endsection

@section('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script> --}}
@stop
