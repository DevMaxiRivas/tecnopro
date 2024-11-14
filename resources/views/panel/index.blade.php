@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('title', 'Inicio')
@section('plugins.Chartjs', true)


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

            <div class="col-lg-4 col-md-6 col-sm-12">
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

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <a href="{{ route('reporte.ventas') }}" class="text-dark">
                        <div class="card-body border-left-blue">
                            <h5 class="card-title text-lg font-weight-bold">
                                <i class="fas fa-money-bill-wave"></i>
                                Ganancia de este mes
                            </h5>
                            <p class="card-text text-xl font-weight-bold text-right m-0">
                                $ {{ $ganancias }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-mapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-backdrop="static">
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

    @role('admin|empleado_ventas|empleado_compras')
    <div class="row">
        <!-- BAR CHART STOCK PRODUCTOS -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-warehouse" style="font-size: 24px; margin-right: 8px;"></i>
                        <strong>Stock de Productos</strong>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <!-- PIE CHART VENTAS POR MÉTODOS DE PAGO -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 8px;"></i>
                        <strong>Ventas por Métodos de Pago</strong>
                    </div>
                </div>
                <div class="card-body h-50">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- REGISTRO DE CLIENTES -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Registro de Clientes <i class="fa fa-users" aria-hidden="true"></i></strong>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <!-- MEJORES CLIENTES -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Mejores Clientes <i class="fa fa-users" aria-hidden="true"></i></strong>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChartclientes"></canvas>
                </div>
            </div>
        </div>
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
    @endrole
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
            $(document).ready(function() {
                const lineChart = document.getElementById('lineChart').getContext('2d');
                const barChart = document.getElementById('barChartclientes').getContext('2d');

                const configDataLineChart = $('#config_linechart');
                const configDataBarChart = $('#config_barchart');

                // Peticion AJAX para extraer datos de la BD y graficar
                $.get("{{ route('graficos-clientes') }}", function(response) {
                        response = JSON.parse(response);
                        // Si hay éxito en la petición
                        if (response.success && response.data.length === 2) {
                            let labels = response.data[0];
                            let count = response.data[1];

                            graficarRegCli(lineChart, 'line', labels, count, 'Cantidad de clientes por mes',
                                configDataLineChart);
                        } else {
                            console.log(response.message);
                        }
                    })
                    .fail(function(error) {
                        console.log(error.statusText, error.status);
                    });

                $.get("{{ route('grafico-mejores-clientes') }}", function(response) {
                        console.log('Respuesta del servidor:', response);
                        response = JSON.parse(response);
                        if (response.success) {
                            let labels = response.data[0];
                            let count = response.data[1];

                            graficarMejClie(barChart, 'bar', labels, count, 'Mejores', configDataBarChart);

                        } else {
                            console.log(response.message);
                        }
                    })
                    .fail(function(error) {
                        console.error('Error al obtener datos para el gráfico de mejores clientes:', error
                            .statusText, error.status);

                    });
                //Grafica REGISTRO DE CLIENTES
                function graficarRegCli(context, typeGraphic, label, count, title, inputData) {
                    let configChart = `{
                    "type": "${typeGraphic}",
                    "data": {
                        "labels": ${JSON.stringify(label)},
                        "datasets": [{
                            "label": "${title}",
                            "data": ${JSON.stringify(count)},
                          "backgroundColor": [
                                "rgba(0, 0, 0, 0)"
                            ],
                            "borderColor": [
                                "rgba(255, 0, 0, 1)"
                            ],
                            "borderWidth": 2
                        }]
                    }`;
                    // Iniciar en el punto 0
                    configChart += `
                    ,"options": {
                        "scales": {
                            "xAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }],
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        },
                        "legend": {
                        "display": false
                        }
                    }
                    `;
                    configChart += '}'; // Cierre del JSON
                    inputData.val(configChart);
                    // Crear el gráfico
                    let myChart = new Chart(context, JSON.parse(configChart));
                }
                //Grafica MEJORES DE CLIENTES
                function graficarMejClie(context, typeGraphic, label, count, title, inputData) {
                    let configChart = {
                        type: typeGraphic,
                        data: {
                            labels: label,
                            datasets: [{
                                label: title,
                                data: count,
                                backgroundColor: [
                                    "rgba(255, 0, 255, 0.2)",
                                    "rgba(255, 255, 0, 0.3)",
                                    "rgba(0, 255, 255, 0.2)",
                                    "rgba(0, 255, 0, 0.2)",
                                    "rgba(204, 153, 102, 0.2)",
                                    "rgba(255, 165, 0, 0.2)",
                                    "rgba(0, 128, 255, 0.2)",
                                    "rgba(128, 0, 128, 0.2)"
                                ],
                                borderColor: [
                                    "rgba(255, 0, 255, 1)",
                                    "rgba(255, 255, 0, 1)",
                                    "rgba(0, 255, 255, 1)",
                                    "rgba(0, 255, 0, 1)",
                                    "rgba(204, 153, 102, 1)",
                                    "rgba(255, 165, 0, 1)",
                                    "rgba(0, 128, 255, 1)"
                                ],
                                borderWidth: 1.5
                            }]
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        autoSkip: false
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function(value) {
                                            return new Intl.NumberFormat('es-AR', {
                                                style: 'currency',
                                                currency: 'ARS',
                                                minimumFractionDigits: 2
                                            }).format(value);
                                        }
                                    }
                                }]
                            },
                            legend: {
                                display: false
                            }
                        }
                    };
                    // Convertimos el objeto en JSON y lo almacenamos en inputData
                    inputData.val(JSON.stringify(configChart));
                    // Crear el gráfico
                    let myChart = new Chart(context, configChart);
                }
            });
        </script>

        <script>
            $(function() {
                function cargarYGraficar(url, canvasId, chartTitle, chartType, hideLabels = false, addDollarSymbol =
                    false) {
                    // Seleccionamos el contexto del canvas
                    const context = document.getElementById(canvasId).getContext("2d");

                    // Petición AJAX para obtener datos
                    $.get(url, function(response) {
                        response = JSON.parse(response);

                        // Si hay éxito en la petición
                        if (response.success) {
                            let labels = response.data[0];
                            let counts = response.data[1];

                            // Graficamos usando la función `graficar` y pasamos addDollarSymbol
                            graficar(context, chartType, labels, counts, chartTitle, hideLabels,
                                addDollarSymbol);
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
                                        "display": !
                                            hideLabels // Si hideLabels es verdadero, oculta las etiquetas en el eje X
                                    }
                                }],
                                "yAxes": [{
                                    "ticks": {
                                        "beginAtZero": true,
                                        "callback": function(value, index, values) {
                                            return addDollarSymbol ? '$' + value :
                                                value; // Agrega el símbolo de dólar solo si addDollarSymbol es true
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
                cargarYGraficar("/panel/graficos-productos", "barChartVentas", "Cantidad de Productos más vendidos",
                    "bar", true, false); // Primer gráfico: sin símbolo $
                cargarYGraficar("/panel/graficos-productos2", "barChartCompras", "Costos por mes", "line", false,
                    true); // Segundo gráfico: con símbolo $
            });
        </script>

        <script>
            $(function() {
                const barChart = document.getElementById('barChart').getContext('2d');
                const configDataBarChart = $('#config_barchart');
                // Peticion AJAX para extraer datos de la BD y graficar
                $.get('/panel/graficos-productos1', function(response) {
                        response = JSON.parse(response);
                        // Si hay exito en la petición
                        if (response.success) {
                            let labels = response.data[0];
                            let count = response.data[1];
                            // Para Graficar el Diagrama de Barras (BarChart)
                            graficar(barChart, 'bar', labels, count, 'Cantidad', configDataBarChart);
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
                            "rgba(255, 159, 64, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(75, 192, 192, 0.2)",  
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 99, 132, 0.2)"
                        ],
                        "borderColor": [
                            "rgba(255, 159, 64, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 99, 132, 1)"
                        ],
                        "borderWidth": 2
                    }]
                }`;
                    // Si es alguno de estos graficos, iniciarán en el punto 0
                    if (typeGraphic === 'bar' || typeGraphic === 'horizontalBar') {
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
    <!-- VENTAS POR MÉTODOS DE PAGO  -->
    @role('admin')
        <script>
            $(function() {
                const pieChart = document.getElementById('pieChart').getContext('2d');
                const configDataPieChart = $('#config_piechart')
                // Peticion AJAX para extraer datos de la BD y graficar
                $.get('/panel/graficos-ventasmetodos', function(response) {
                        response = JSON.parse(response);
                        // Si hay exito en la petición
                        if (response.success) {
                            let labels = response.data[0];
                            let count = response.data[1];
                            // Para Graficar el Diagrama de Barras (BarChart)
                            graficar(pieChart, 'pie', labels, count, 'Cantidad de Productos por Categoria',
                                configDataPieChart);
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
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",  
                            "rgba(255, 99, 132, 0.2)"
                        ],
                        "borderColor": [
                            "rgba(54, 162, 235, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 99, 132, 1)"
                        ],
                        "borderWidth": 2
                    }]
                }`;
                    // Si es alguno de estos graficos, iniciarán en el punto 0
                    if (typeGraphic === 'bar' || typeGraphic === 'horizontalBar') {
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
