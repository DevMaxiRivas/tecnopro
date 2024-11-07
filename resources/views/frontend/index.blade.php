@extends('frontend.layouts.master')
@section('title', 'Esmarty || Inicio')
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
    {{-- Slider --}}

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
    
        <div class="carousel-inner">
          <div class="carousel-item active c-item">
            <img src="{{ asset('imagenes/carrusel/banner-index.jpg')}}" class="d-block w-100 c-img img-fluid" alt="Slide 1">
          </div>
          <div class="carousel-item c-item">
            <img src="{{ asset('imagenes/carrusel/banner-index-1.jpg')}}" class="d-block w-100 c-img img-fluid" alt="Slide 2">
          </div>
          <div class="carousel-item c-item">
            <img src="{{ asset('imagenes/carrusel/banner-index-2.jpg')}}" class="d-block w-100 c-img img-fluid" alt="Slide 3">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    {{-- Slider Fin --}}



          {{-- Todas las Categorías --}}
    <section class="todas-categorias">
        <div class="text-center">
            <h1 class="pb-4"> Nuestras categorías </h1>
        </div>
        <div class="container content-box p-4 add-inner-shadow">
            <div class="row justify-content-around pb-4 mt-auto">

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/1">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-tvs.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Memorias RAM</div>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/4">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-consolas.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Placas de video</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/3">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-perifericos.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Procesadores</div>
                        </div>
                    </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/2">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-componentes.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Almacenamiento</div>
                        </div>
                    </div>
                    </a>
                </div>

            </div>

            <div class="row justify-content-around">

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/5">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-celulares.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Monitores</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/6">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-relojes.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Fuentes de alimentación</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/7">
                    <div class="row p-2">
                        <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                            <img src="{{ asset('imagenes/cat-notebook.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="text-enfasis">Gabinetes</div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-6 col-sm-6 rounded-4 element-box categoria-hover add-shadow mb-2 mt-2" style="height: 250px; width: 300px;">
                    <a href="/productos/categoria/8">
                        <div class="row p-2">
                            <div class="col-md-12 justify-center zoom-effect" style="height: 12rem;">
                                <img src="{{ asset('imagenes/cat-audio.png')}}" alt="#" style="height: 100%; width: 100%; object-fit: contain;">
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="text-enfasis">Motherboards</div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
    {{-- Fin Todas las Categorías --}}

    
    <section class="categorias mt-5 mb-5">
        <div class="container">
            <div class="row mb-3">

                <div class="col-md-12 justify-content-center">
                    <div class="text-center">
                        <h1 class="pb-4"> Elecciones Principales </h1>
                    </div>
                    <div class="row p-4 content-box content-box mx-auto add-shadow">

                        <div class="col-md-12 col-sm-12 col-12 p-2" style="height: 19rem">
                            <a href="/productos/categoria/8"><div class="container bg-cover img-fluid rounded-4 zoom-effect" style="height: 100%; background-image:url('{{ asset('imagenes/categoria-ancha-1.jpg') }}')"></div></a>
                        </div>
                        <div class="col-md-6 col-sm-12 p-2" style="height: 23 rem">
                            <a href="productos/detallesProducto/17"><div class="container bg-cover img-fluid rounded-4 zoom-effect" style="height: 100%; background-image:url('{{ asset('imagenes/categoria-1.jpg') }}')"></div></a>
                        </div>
                        <div class="col-md-6 col-sm-12 p-2" style="height: 23rem">
                            <a href="/productos/categoria/3"><div class="container bg-cover img-fluid rounded-4 zoom-effect" style="height: 100%; background-image:url('{{ asset('imagenes/categoria-2.jpg') }}')"></div></a>
                        </div>
                        <div class="col-md-12 col-sm-12 p-2" style="height: 19rem">
                            <a href="productos/detallesProducto/9"><div class="container bg-cover img-fluid rounded-4 zoom-effect" style="height: 100%; background-image:url('{{ asset('imagenes/categoria-ancha-2.jpg') }}')"></div></a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>



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

                @foreach ($productos->where('activo', 1)->take(24) as $producto)
                @php $imagen = explode('|', $producto->url_imagen) @endphp
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 justify-content-around">
                    <div class="card element-box m-2 producto-card zoom-shadow" style="width: 14rem;">
                        <a href="{{ route('MandarDatosProductoEspecifico', $producto->id) }}" style="color: rgb(38, 38, 38)">
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

<!-- Estilo de sombra y degradado para todas las categorías -->
<style>
    .categoria-hover {
        position: relative;
        overflow: hidden;
    }

    .categoria-hover:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .categoria-hover::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0;
        background: linear-gradient(to top, rgba(69, 187, 255, 0.6), transparent);
        transition: height 0.3s ease;
    }

    .categoria-hover:hover::after {
        height: 35%; /* Muestra el degradado azul desde abajo hacia arriba */
    }
</style>

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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


@endsection

@endsection
