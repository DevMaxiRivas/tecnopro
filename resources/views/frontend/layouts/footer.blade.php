    <footer class="footer bg-dark pt-3 pb-1">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center d-flex flex-column gap-1 mb-3">
                    <h3 class="text-white">Sobre Nosotros</h3>

                    <a href="#">La empresa</a>
                    <a href="#">Historia</a>
                    <a href="#">Objetivo</a>

                </div>
                <div class="col-md-3 text-center d-flex flex-column gap-1 mb-3">
                    <h3 class="text-white">Contactanos</h3>

                    <a href="#"><i class='bx bxs-chat'></i> Formulario </a>
                    <a href="#"><i class='bx bxs-phone'></i> 0810-444-7025</a>
                    <a href="#"><i class='bx bxs-envelope'></i> consultas@tecnopro.com</a>

                </div>

                <div class="col-md-6 item text">
                    <div class="logo d-flex flex-column align-items-center gap-3">
                        <a href="/"><img src="{{ asset('imagenes/logo-tecnopro-claro.png') }}" alt="Logo Esmarty"
                                width="150"></a>

                        <p class="text-center">En Esmarty, nos enorgullece ofrecerte lo último en productos electrónicos
                            de alta calidad. <br>
                            ¡Gracias por ser parte de nuestra comunidad tecnológica!
                        </p>
                        <div class="text-white d-flex gap-3 pb-2" style="margin-top: -1rem;">
                            <a href="#"><i class='bx bxl-twitter lead'"></i></a>
                            <a href="#"><i class='bx bxl-facebook-circle lead'></i></a>
                            <a href="#"><i class='bx bxl-instagram lead'></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <p class="copyright text-center">TecnoPro Ecommerce © 2024</p>
        </div>
    </footer>

    <script>
        var token = '{{ csrf_token() }}';
        let rutaContarItemsCarrito = '{{ route('carrito.contarItemsCarrito') }}';
    </script>
    <script src="{{ asset('js/carrito/cant_items_carrito.js') }}"></script>
    @section('js')
        <script src="js/vendor/jquery-2.2.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
        </script>
        <script src={{ asset('vendor/bootstrap/js/bootstrap.min.js') }}></script>
        <script src={{ asset('js/nice-select/nice-select.min.js') }}></script>
        <script src={{ asset('js/owlcarousel/owlcarousel.min.js') }}></script>
        <script src={{ asset('js/jquery.sticky.js') }}></script>
        <script src={{ asset('js/parallax.min.js') }}></script>
    @endsection
