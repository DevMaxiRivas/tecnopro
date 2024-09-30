@extends('frontend.layouts.master')
@section('title', 'Confirmar pedido || Esmarty')
@section('main-content')
    <!-- Breadcrumbs -->
    <div class="section m-4 check-out">
    <div class="container border p-3 rounded-3 add-shadow bg-white border-0 ">
        <div class="pt-3 pb-1 text-left">
          
          <h2>Completa tus datos:</h2>
          <p class="lead">Automaticamente se cargan los datos de tu perfil, pero puedes cambiarlos dependiendo de quien reciba el paquete.</p>
        </div>
      
        <div class="row">
          <div class="col-md-5 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-heading-h3">Tu carrito: </span>
              <span class="badge badge-secondary badge-pill">{{count($carrito)}}</span>
            </h4>
            <ul class="list-group mb-3">
                 @php ($total = 0)

                @foreach ($carrito as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                      <h6 class="my-0">{{$item->productos->nombre}}</h6>
                      <small style="color: #330AE3; opacity: 0.9;">Cantidad: {{$item->cant_producto}}</small>
                    </div>
                    <span style="color: #330AE3; opacity: 0.9;" >${{$item->subtotal * $item->cant_producto}}</span>
                  </li>    
                
                
                  @php ($total += $item->subtotal * $item->cant_producto)
                 

                @endforeach
              
              <li class="list-group-item d-flex justify-content-between">
                <span>Total a pagar: </span>
                <strong style="color: #330AE3;">${{$total}}</strong>
              </li>
            </ul>
      
            
          </div>
          <div class="col-md-7 order-md-1">
            <h4 class="mb-3 text-heading-h3">Dirección de envío: </h4>
            <form class="needs-validation" novalidate action="{{route('pedido.store')}}" method="POST">
                @csrf
              <div class="row">
                <div class="col-md-6 mb-3">

                  <label for="nombre" class="">Nombre: </label>
                <div class="">
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                        name="nombre" value="{{ old('nombre', optional($pedido)->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="">Apellido: </label>
                    <div class="">
                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                            name="apellido" value="{{ old('apellido', optional($pedido)->apellido) }}">
                        @error('apellido')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
              </div>
      
              <div class="mb-3">
                <label for="dni" class="">DNI: </label>
                <div class="">
                    <input type="number" class="form-control @error('dni') is-invalid @enderror" id="dni"
                        name="dni" placeholder="Sin puntos" value="{{ old('dni', optional($pedido)->dni) }}">
                    @error('dni')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
              </div>
      
              <div class="mb-3">
                <label for="email" class="">E-mail: </label>
                <div class="">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', optional($pedido)->correo) }}">
                    @error('email')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>

              </div>
      
              <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="direccion" class="">Dirección: </label>
                    <div class="">
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion"
                            name="direccion" placeholder="" value="{{ old('direccion', optional($pedido)->direccion) }}">
                        @error('direccion')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="codigo_postal" class="">Codigo Postal: </label>
                    <div class="">
                        <input type="number" class="form-control @error('codigo_postal') is-invalid @enderror" id="codigo_postal"
                            name="codigo_postal" placeholder="" value="{{ old('codigo_postal', optional($pedido)->codigo_postal) }}">
                        @error('codigo_postal')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                </div>
              </div>
      
              <div class="mb-3">
                <label for="telefono" class="">Teléfono: </label>
                <div class="">
                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        name="telefono" placeholder="" value="{{ old('telefono', optional($pedido)->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback"> {{ $message }} </div>
                    @enderror
                </div>
              </div>
      
            
              <div class="d-flex flex-column ">
                <div class="d-flex justify-content-between">
                <a style="border: 2px solid gray!important; background-color: gray;" class="d-flex align-items-center justify-content-around btn btn-atras color-atras btn-lg btn-block m-1" href="{{route('carrito.carrito')}}">Volver al carrito <i class='bx bx-cart-add lead' ></i></a>
               <button style="border: 2px solid #330AE3!important" class="d-flex align-items-center justify-content-around btn btn-enfasis color-enfasis btn-lg btn-block m-1 @if (!$total) disabled @endif" type=@if(!$total) "button" @else "submit" @endif>Confirmar Pedido<i class='bx bx-cart-download lead'></i></button>
              </div>
               <div class="text-secondary small"> <br><i class='bx bxs-info-circle' ></i> Al confirmar el pedido, se te redirigira a realizar el pago inmediatamente, si el pago falla puedes acceder al link de pago en cualquier momento desde tu panel en la opcion "Mis compras"</div> 
              </div>
            </form>
          </div>
        </div> 
      </div>
    </div>
      @endsection

      @section('styles')
    
    
    </div>
    <style>

    </style>

@endsection


@section('js')
    <script></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@stop
