@extends('adminlte::page')

@section('title', 'Inicio')
@section('plugins.Chartjs', true)


@section('content_header')
    
@stop

@section('content')
@role('admin')
<h1><b>Panel Estadistico</b></h1>
<div class="card">
    <div class="container-fluid pt-2">
        <div class="row">

            <!-- REGISTRO DE CLIENTES -->
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Registro de Clientes  <i class="fa fa-users" aria-hidden="true"></i></strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" ></canvas>
                        </div>
                    </div>
            </div>
            <!-- MEJORES CLIENTES -->
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Mejores Clientes  <i class="fa fa-users" aria-hidden="true"></i></strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" ></canvas>
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
</div>
@endrole
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
        $(document).ready(function() {
            const lineChart = document.getElementById('lineChart').getContext('2d');
            const barChart = document.getElementById('barChart').getContext('2d');

            const configDataLineChart = $('#config_linechart');
            const configDataBarChart = $('#config_barchart');

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get("{{ route('graficos-clientes') }}", function(response) {
                    response = JSON.parse(response);
                    // Si hay éxito en la petición
                    if (response.success && response.data.length === 2) {
                        let labels = response.data[0];
                        let count = response.data[1];

                        graficarRegCli(lineChart, 'line', labels, count,'Cantidad de clientes por mes',configDataLineChart);
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
                    if (response.success ) {
                        let labels = response.data[0];
                        let count = response.data[1];

                        graficarMejClie(barChart, 'bar', labels, count,'Mejores',configDataBarChart);

                    } else {
                        console.log(response.message);
                    }
                })
                .fail(function(error) {
                    console.error('Error al obtener datos para el gráfico de mejores clientes:', error.statusText, error.status);

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

@stop


