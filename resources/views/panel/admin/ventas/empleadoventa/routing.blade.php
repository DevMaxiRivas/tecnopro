@extends('adminlte::page')

@section('title', 'Rutas de Ventas')

@section('content_header')
    <h1>
        <strong>
            Rutas de entrega para las ventas 
        </strong>
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="id_venta" class="col-sm-3 col-form-label"> * Ventas </label>
                        <div class="col-sm-7">
                            <select id="select-venta" name="id_venta" class="form-control">
                                <option disabled selected>Seleccione una venta</option>
                                @foreach ($ventas as $venta)
                                    <option
                                        value="{{ $venta->id }}">
                                            # {{ $venta->id }} - 
                                            @if ($venta->estado == 1)
                                                <span class="badge badge-primary">(Pagado)</span>
                                            @elseif ($venta->estado == 2)
                                                <span class="badge badge-warning">(En preparación)</span>
                                            @elseif ($venta->estado == 3)
                                                <span class="badge badge-success">(Enviado)</span>
                                            @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button id="buscar" class="btn btn-sm btn-primary">
                            Buscar
                        </button>
                    </div>

                    <div id="map" style="height: 450px"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet-gesture-handling.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/leaflet/control-fullscreen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet/markercluster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet-routing-machine.css') }}">

    <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/leaflet/leaflet.min.js') }}"></script>
    {{-- <script src="{{ asset('js/leaflet/leaflet-gesture-handling.min.js') }}"></script> --}}
    <script src="{{ asset('js/leaflet/control-fullscreen.js') }}"></script>
    <script src="{{ asset('js/leaflet/markercluster.min.js') }}"></script>
    <script src="{{ asset('js/leaflet/leaflet-routing-machine.js') }}"></script>

    <script src="{{ asset('js/util/mapa.js') }}"></script>
    {{-- <script src="{{ asset('js/util/modal.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/panel/home.js') }}"></script> --}}
    
    <script>
        let map = L.map('map', {
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft'
                }
        });

        initMap(map);

        // Inicia con un punto en el mapa que apunta a la ubicacion de la tienda
        let markerStore;
        configPointDefault();

        console.log(markerStore.getLatLng());

        let id_venta = '0';
        
        $('#buscar').click(function() {

            const button = $(this);
            const selectVenta = $('#select-venta');

            if(selectVenta.val() != id_venta) {
                button.attr('disabled', true);

                id_venta = selectVenta.val();

                var url = `/panel/ventas_mapa/${id_venta}`;

                $.get(url, function(response) {
                    if(response.success) {
                        initGroupMarker(map, response.data);

                        let cliente = response.data[0];

                        let ubicacionCliente = {
                            lat: cliente.envio_venta.latitud,
                            lng: cliente.envio_venta.longitud
                        };

                        initRouting(map, markerStore.getLatLng(), ubicacionCliente);
                    } else {
                        console.log(response);
                    }
                    
                    button.attr('disabled', false);
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    //modal.createModalFailResponse(formJq, errorThrown);
                    console.log("Error", textStatus, errorThrown);

                    button.attr('disabled', false);
                });
            }
        });

        function configPointDefault() {
    
            // Punto establecido del local TecnoPro
            const pointDefault = [
                -24.7925378,
                -65.4125236
            ];

            let pin_delivery = L.icon({
                iconUrl: "/css/leaflet/images/delivery.png",
                iconSize: [35, 35],
                iconArchor: [17,36]
            });

            var info = `<b>Tienda TecnoPro</b> <br>
                        Domicilio: Florida 219 <br>
            `;

            markerStore = L.marker(pointDefault, { icon: pin_delivery });
            markerStore.bindPopup(info);
            markerStore.addTo(map);
        }
    </script>
@stop