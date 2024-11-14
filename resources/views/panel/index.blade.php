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
        <!-- BAR CHART para Productos más vendidos -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Top 4 Productos más vendidos</strong>
                </div>
                <div class="card-body">
                    <canvas id="barChartVentas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- BAR CHART para Productos más comprados -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>Costos por adquisición mensual </strong>
                </div>
                <div class="card-body">
                    <canvas id="barChartCompras"></canvas>
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
            function cargarYGraficar(url, canvasId, chartTitle, chartType, hideLabels = false, addDollarSymbol = false) {
            // Seleccionamos el contexto del canvas
            const context = document.getElementById(canvasId).getContext("2d");

            // Petición AJAX para obtener datos
            $.get(url, function(response) {
                response = JSON.parse(response);

                // Si hay éxito en la petición
                if(response.success) {
                    let labels = response.data[0];
                    let counts = response.data[1];

                    // Graficamos usando la función `graficar` y pasamos addDollarSymbol
                    graficar(context, chartType, labels, counts, chartTitle, hideLabels, addDollarSymbol);
                } else {
                    console.log(response.message);
                }
            }).fail(function(error) {
                console.log(error.statusText, error.status);
            });
        }

            function graficar(context, typeGraphic, labels, data, title, hideLabels, addDollarSymbol = false) {
                var configChart = {
                    "type": typeGraphic,
                    "data": {
                        "labels": labels,
                        "datasets": [{
                            "label": title,
                            "data": data,
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
                    },
                    "options": {
                        "scales": {
                            "xAxes": [{
                                "ticks": {
                                    "beginAtZero": true,
                                    "display": !hideLabels // Si hideLabels es verdadero, oculta las etiquetas en el eje X
                                }
                            }],
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true,
                                    "callback": function(value, index, values) {
                                        return addDollarSymbol ? '$' + value : value; // Agrega el símbolo de dólar solo si addDollarSymbol es true
                                    }
                                }
                            }]
                        },
                        "legend": {
                            "display": false // Desactiva la leyenda
                        }
                    }
                };
                new Chart(context, configChart);
            }

        // Llamamos a la función para cargar y graficar cada gráfico
        cargarYGraficar("/panel/graficos-productos", "barChartVentas", "Cantidad de Productos más vendidos", "bar", true, false); // Primer gráfico: sin símbolo $
        cargarYGraficar("/panel/graficos-productos2", "barChartCompras", "Costos por mes", "line", false, true); // Segundo gráfico: con símbolo $
 });
    </script>
    
    @endrole
@stop



