<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('css/boxicons/boxicons.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owlcarousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paginaPrincipal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    {{-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}"></script>
    {{-- <script src="https://kit.fontawesome.com/88816cb6bd.js" crossorigin="anonymous"></script> --}}
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet" />
    @yield('styles')

</head>

<body>

    @include('frontend.layouts.header')

    <div class="main-content">
        @yield('main-content')
    </div>
    @include('frontend.layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchButton').click(search);

            $('#busquedaInput').keydown(function(event) {
                if (event.which === 13) {
                    search();
                }
            });

            function search() {
                var searchTerm = $('#busquedaInput').val().trim();

                if (searchTerm !== '') {
                    window.location.href = '/resultados?search=' + searchTerm;
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                var header = document.querySelector('.navbar');
                header.classList.toggle('scrolled', window.scrollY > 0);
            });
        });
    </script>

    <script>
        var precioRange = document.getElementById('precio_range');
        var selectedPrice = document.getElementById('selected_price');

        if (precioRange) {
            precioRange.addEventListener('input', function() {
                selectedPrice.value = precioRange.value;
            });
        }
    </script>

    <script>
        let rutaParaAgregar = '{{ route('carrito.agregarAlCarrito') }}';
        var token = '{{ csrf_token() }}';
        let clienteId = {{ Auth::id() ? Auth::id() : 0 }}
    </script>

    <script src="{{ asset('js/carrito/agregar_al_carrito.js') }}"></script>

    <script src="{{ asset('js/carrito/toastr.min.js') }}"></script>
    @yield('js')

</body>

</html>
