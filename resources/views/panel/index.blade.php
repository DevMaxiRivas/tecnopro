@extends('adminlte::page')
@section('plugins.Chartjs', true)

@section('title', 'Inicio')

@section('content_header')
    <h1><b>¡Bienvenido {{ auth()->user()->name }}!</b></h1>
@stop

@section('content')
<div class="row">

    @role('admin|empleado_ventas|empleado_compras')

        {{-- @foreach ($results as $result)
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body border-left-blue">
                    <h5 class="card-title text-lg font-weight-bold ">{{ $result['nombre'] }}</h5>
                    <p class="card-text text-xl font-weight-bold text-right">{{ $result['cantidad']}}</p>
                </div>
            </div>
        </div>
        @endforeach --}}

        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body border-left-blue">
                    <h5 class="card-title text-lg font-weight-bold">
                        <i class="fas fa-map-marked-alt"></i>
                        Mapa de Ventas
                    </h5>
                    <p class="card-text text-xl font-weight-bold text-right m-0">
                        <button id="button_map" class="card-text btn btn-sm btn-primary">
                            Abrir
                        </button>
                    </p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-mapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">  
                <div id="content" class="modal-content">

                    <div class="modal-header bg-primary">
                        <h6 class="modal-title">Mapa de Ventas (PAGADO, EN PREPARACION y ENVIADO)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div id="map_2"></div>

                </div>
            </div>
        </div>
    @endrole
</div>

<div class="row">
    <!-- BAR CHART -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Productos más vendidos</strong>
                        {{--<form action="{{ route('exportar-graficos-pdf') }}" method="POST" target="_blank">
                            @csrf
                            @method('POST')

                            <input id="config_barchart" name="config_grafics" type="text" hidden>

                            <button id="button_form_barchart" type="submit" class="btn btn-danger" title="Imprimir BarChart PDF">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                        </form>--}}
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
</div>

@stop

@section('css')
    @role('admin|empleado_ventas|empleado_compras')
        <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/leaflet/leaflet-gesture-handling.min.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/leaflet/control-fullscreen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/leaflet/markercluster.css') }}">

        <link rel="stylesheet" href="{{ asset('css/mapa.css') }}">
    @endrole
@stop

@section('js')
    @role('admin|empleado_ventas|empleado_compras')
        <script src="{{ asset('js/leaflet/leaflet.min.js') }}"></script>
        {{-- <script src="{{ asset('js/leaflet/leaflet-gesture-handling.min.js') }}"></script> --}}
        <script src="{{ asset('js/leaflet/control-fullscreen.js') }}"></script>
        <script src="{{ asset('js/leaflet/markercluster.min.js') }}"></script>

        <script src="{{ asset('js/util/mapa.js') }}"></script>
        <script src="{{ asset('js/util/modal.js') }}"></script>
        <script src="{{ asset('js/panel/home.js') }}"></script>
    @endrole

    @role('admin')
    <script>
        $(function() {
            const barChart = document.getElementById('barChart').getContext('2d');

            const configDataBarChart = $('#config_barchart');

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get('/panel/graficos-productos', function(response) {
                response = JSON.parse(response);

                // Si hay exito en la petición
                if(response.success) {

                    let labels = response.data[0];
                    let count = response.data[1];

                    // Para Graficar el Diagrama de Barras (BarChart)
                    graficar(barChart, 'bar', labels, count, 'Cantidad de Productos más vendidos', configDataBarChart);


                } else {
                    console.log(response.message);
                }
            })
            .fail(function(error) {
                console.log(error.statusText, error.status);
            });

            // Grafica cualquier gráfico estadistico de ChartJs
            function graficar(context, typeGraphic, label, count, title, inputData) {

                // Inicio de la configuracion de ChartJs
                let configChart = `{
                    "type": "${typeGraphic}",
                    "data": {
                        "labels": ${ JSON.stringify(label) },
                        "datasets": [{
                            "label": "${title}",
                            "data": ${ JSON.stringify(count) },
                            "backgroundColor": [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(54, 162, 235, 0.2)",
                                "rgba(75, 192, 192, 0.2)",  
                                "rgba(153, 102, 255, 0.2)"
                            ],
                            "borderColor": [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(75, 192, 192, 1)",
                                "rgba(153, 102, 255, 1)"
                            ],
                            "borderWidth": 2
                        }]
                    }`;

                // Si es alguno de estos graficos, iniciarán en el punto 0
                if(typeGraphic === 'bar' || typeGraphic === 'horizontalBar') {
                    configChart += `
                    ,"options": {
                        "scales": {
                            "xAxes": [{
                                "ticks": {
                                    "beginAtZero": true,
                                    "display": false
                                }
                            }],
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        }
                    }
                    `;
                }

                configChart += '}'; // Cierre del JSON

                // Guardamos el string en el input data del formulario correspondiente
                inputData.val(configChart);

                // JSON.parse(string) -> convierte el string a JSON
                let myChart = new Chart(context, JSON.parse(configChart));
            }
        });
    </script>
    @endrole
@stop



