@extends('frontend.layouts.master')
@section('title', '¨TecnoPro Inicio')
@section('main-content')

    @if (session('alert'))
        <div class="containter-fluid mb-3 p-0">

            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                </div>
            </div>

        </div>
    @endif

    {{-- Ultimos Agregados --}}
    <section class="shop-home-list section pt-4">
        <div class="container pt-4">
            <div class="row">
                <div class="col-12">
                    <div class="shop-section-title text-center">
                        <h1>Últimas Novedades</h1>
                    </div>
                </div>
            </div>

            <div class="row justify-content-around mt-2 mb-4">
                @foreach ($productos->take(5) as $producto)
                    @php $imagen = explode('|', $producto->url_imagen) @endphp
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 justify-content-around">
                        <div class="card element-box m-2 producto-card zoom-shadow" style="width: 14rem;">
                            <a href="{{ route('MandarDatosProductoEspecifico', $producto->id) }}"
                                style="color: rgb(38, 38, 38)">
                                <div class="container mt-3 bg-white inner" style="width: 200px; height: 200px">
                                    <img src="{{ $imagen[0] }}" class="card-img-top img-fluid" alt="{{ $imagen[0] }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"> {{ Str::limit($producto->nombre, 25) }} </h5>
                            </a>
                            <p class="card-text">$ {{ $producto->precio }}</p>
                            <button data-agregar-id="{{ $producto->id }}"
                                class="btn btn-sm mb-3 color-enfasis btn-enfasis-adicional rounded-pill text-white text-uppercase agregarAlCarrito add-shadow">
                                Agregar al Carrito
                            </button>
                        </div>
                    </div>
            </div>
            @endforeach

        </div>
        </div>
    </section>
    {{-- Ultimos Agregados Fin --}}
@endsection

@section('js')

    <script>
        // Verificar si hay una URL de redirección adicional
        var redirectUrl = '{{ session('redirectUrl') }}';

        if (redirectUrl) {
            // Redirigir al usuario a la URL adicional
            window.location.href = redirectUrl;
            //window.open(redirectUrl, '_blank'); Por si quiero abrirlo en otra pestaña
        }
        // Display an info toast with no title
    </script>


@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


@endsection
