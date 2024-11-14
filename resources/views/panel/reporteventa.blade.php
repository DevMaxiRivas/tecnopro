@extends('adminlte::page')

@section('title', 'Reportes de Menús')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Reportes de Ventas</small></h1>
@endsection

@section('content')
    <div id="card-filter" class="card my-3">
        <div class="card-header d-flex align-items-center bd-highlight">
            <h3 class="card-title mr-auto bd-highlight">
                <i class="fas fa-filter"></i> Filtros
            </h3>
        </div>

        <div class="card-body">

            <form id="form-filter">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="font-weight-bold">
                            Rango de fechas de servicio
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input id="date_range" name="date_range" type="text" class="form-control" placeholder="Seleccione su rango de fechas">
                            <input id="start_date" name="start_date" type="hidden">
                            <input id="end_date" name="end_date" type="hidden">
                        </div>
                    </div>
                </div>

                <button id="filter-submit" class="btn btn-success" type="submit">
                    <i class="fas fa-check-circle"></i> Filtrar
                </button>

                {{-- <button id="filter-clear" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Limpiar
                </button> --}}
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-5">
            <div class="card">
                <div class="card-header d-flex align-items-center bd-highlight">
                    <h3 class="card-title mr-auto bd-highlight">
                        <i class="fas fa-file-pdf mr-1"></i> Ganancias
                    </h3>

                    <div class="bd-highlight">
                        <a id="button-filter" href="#" class="btn btn-sm btn-primary" role="button" title="Filtros">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-filter mr-0 mr-md-1"></i> 
                                <span id="text-button-filter" class="d-none d-md-block">
                                    Ocultar Filtros
                                </span>
                            </div>
                        </a>
                    </div>
                </div>

                <div id="card-table" class="card-body table-responsive">

                    {{-- <div id="buttons-reports" class="d-flex" style="gap: 5px;">
                        <form id="form-report-pdf" action="#" method="POST" target="_blank">
                            @csrf
                            <input id="data-pdf" name="data-pdf" type="hidden">
                            <button id="button-report-pdf" class="btn btn-secondary" title="Descargar PDF" type="button">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-file-pdf mr-0 mr-md-1"></i> 
                                    <span class="d-none d-md-block">Descargar PDF</span>
                                </div>
                            </button>
                        </form>
                        
                        <form id="form-report-excel" action="#" method="POST">
                            @csrf
                            <input id="data-excel" name="data-excel" type="hidden">
                            <button id="button-report-excel" class="btn btn-secondary" title="Descargar Excel" type="button">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-file-excel mr-0 mr-md-1"></i> 
                                    <span class="d-none d-md-block">Descargar Excel</span>
                                </div>
                            </button>
                        </form>
                    </div>

                    <table id="report-cost-table" class="table table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Nro de Menú
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Menú
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Precio de Venta
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Costo de Elaboración
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Cantidad de Consumidores
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Ventas Recaudadas
                                </th>
                                <th scope="col" class="font-weight-bold text-left text-md-center">
                                    Fecha de Servicio
                                </th>
                            </tr>
                        </thead>
                    </table> --}}

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Registro de Clientes  <i class="fa fa-users" aria-hidden="true"></i></strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/daterangepicker/daterangepicker.css') }}" />

    <style>
        .content-header {
            padding-bottom: 0;
        }
    </style>
@endsection

@section('js')
    {{-- <script src="{{ asset('js/functions.js') }}"></script> --}}
    <script src="{{ asset('js/moment-js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker/daterangepicker.min.js') }}"></script> 

    <script>
        $(document).ready(function() {

            let initDate = moment().format('MM/YYYY');
            let start_date = $('#start_date');
            let end_date = $('#end_date');

            let table;

            console.log(initDate);
            setStartAndEndDate(initDate);

            $(document).on('click', '#button-filter', function(e) {
                e.preventDefault();

                let card_filter = $('#card-filter');
                let text_button_filter = $('#text-button-filter');

                if (card_filter.is(":visible")) {
                    card_filter.hide('fast');
                    text_button_filter.text('Mostrar filtros');
                } else {
                    card_filter.show('fast');
                    text_button_filter.text('Ocultar filtros');
                }
            });

            $(document).on('submit', '#form-filter', function(e) {
                e.preventDefault();

                // if(table) $("#report-cost-table tbody").remove();

                let parameters = $(this).serialize();
                console.log(parameters);
                // initDatatable(parameters);

                const lineChart = document.getElementById('lineChart').getContext('2d');

                $.post("/panel/ganancias", parameters, function(response) {
                    response = JSON.parse(response);
                    // Si hay éxito en la petición

                    console.log(response);
                    /*if (response.success && response.data.length === 2) {
                        let labels = response.data[0];
                        let count = response.data[1];

                        graficar(lineChart, 'line', labels, count,'Cantidad de ganancias por mes',configDataLineChart);
                    } else {
                        console.log(response.message);
                    }*/
                })
                .fail(function(error) {
                    console.log(error.statusText, error.status);
                });
            });

            function graficar(context, typeGraphic, label, count, title, inputData) {
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

            $('#date_range').daterangepicker({
                showDropdowns: true,
                startDate: initDate,
                //endDate: moment(initDate).startOf('hour').add(48, 'hour'),
                minYear: 2022,
                maxYear: parseInt(moment().format('YYYY')),
                locale: {
                    cancelLabel: 'Cancelar',
                    applyLabel: 'Guardar',
                    format: 'MM/YYYY',
                    separator: " - ",
                    daysOfWeek: [
                        "Lu",
                        "Ma",
                        "Mie",
                        "Ju",
                        "Vi",
                        "Sa",
                        "Do"
                    ],
                    monthNames: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                }
            }, function(start, end, label) {
                setStartAndEndDate(start.format('YYYY-MM'), end.format('YYYY-MM'));
            });

            function setStartAndEndDate(start, end = null) {
                start_date.val(start);
                end_date.val(end ? end : start);
            }
        });
    </script>
@endsection