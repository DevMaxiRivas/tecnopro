@extends('frontend.layouts.master')
@section('title', 'TecnoPro Carrito')
@section('main-content')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <!-- Breadcrumbs -->


    <!-- Shopping Cart -->
    <div class="shopping-cart section m-4">
        <div class="container border p-2 rounded-2 add-shadow bg-white border-0 " style="">
            <div class="row">
                <div class="col-12 " style="overflow-x: auto;">
                    <!-- Shopping Summery -->
                    <h4> <i class='bx bx-cart-alt'></i>Carrito de Compras</h4>
                    <table id="tabla_carrito" class="table shopping-summery table-striped text-center " style="width: 100%;">
                        <thead class="table content-box">
                            <tr class="main-hading">
                                <th class="text-center"></th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Quitar</th>
                            </tr>
                        </thead>
                        <tbody id="cart_item_list">
                        </tbody>
                    </table>
                    <!--/ End Shopping Summery -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <!-- Total Amount -->

                    <div class="total-amount text-center text-white border pt-2"
                        style="width: 15rem; margin-top: -17px; border-radius: 0 0 30px 30px; background: rgb(116, 160, 139);">
                        <p><i class='bx bx-money-withdraw'></i> Total a pagar:</span> $<span id="valorTotal"></p>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('productos') }}" class="btn btn-secondary rounded-pill text-white"><i
                            class='bx bxs-store-alt'></i> Seguir comprando</a>
                    <a href="{{ route('carrito.create') }}" id="btn-checkout" class="btn btn-success rounded-pill"><span><i
                                class='bx bx-credit-card'></i></span> Ir a Pagar</a>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

@endsection
@section('styles')
    <style>
        .cantidades {
            padding: 5px;
        }

        .columnaCantidad {
            display: flex;
            flex-wrap: nowrap;
        }

        .btn-warning {
            color: #fff;
            font-weight: bold;
            scale: 75%;
        }

        .btn-warning:hover {
            color: #fff;
            font-weight: bold;
        }

        .btn-warning:active {
            color: #fff !important;
            font-weight: bold;
        }

        .btn-warning:focus {
            color: #fff;
            font-weight: bold;
        }
    </style>

    {{-- <link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet"> --}}
@endsection


@section('js')
    <script>
        let rutaParaEliminar = '{{ route('carrito.quitarItem', '') }}';
        let base_url = '{{ route('carrito.miCarrito') }}';
        let rutaParaActualizarCantidad = '{{ route('carrito.actualizarCantidad') }}';
        var token = '{{ csrf_token() }}';
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- 		<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> --}}
    <script src="{{ asset('js/carrito/tabla_carrito.js') }}"></script>
@stop
