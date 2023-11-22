@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('actualPage', 'Home')
@section('button', 'Período')
@section('link', route('notasfiscais.index'))
@section('content')
    <script src="{{asset('back/src/plugins/apexcharts/apexcharts.min.js')}}"></script>

    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="{{asset('back/vendors/images/logo1.svg')}}" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <div class="pd-ltr-20">
    <div class="row">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart10"></div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="card-box height-100-p pd-20">
                    <div id="chart11"></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var data = {!! json_encode($data) !!}; // Obtenha os dados completos do PHP

        // Crie um objeto para armazenar a soma por mês
        var dataPorMes = {};

        // Variável para armazenar o total pendente
        var totalPendente = 0;

        // Itere sobre os dados originais e some os valores de "Pago" e "Pendente" por mês
        data.forEach(function (item) {
            var mesAno = item.mes; // Mantenha a data no formato original

            if (!dataPorMes[mesAno]) {
                dataPorMes[mesAno] = 0;
            }
            dataPorMes[mesAno] += parseFloat(item.pago) + parseFloat(item.pendente); // Somar valores de Pago e Pendente

            // Adicione o valor pendente à variável totalPendente
            totalPendente += parseFloat(item.pendente);
        });

        // Crie um array de objetos no formato esperado pelo ApexCharts
        var seriesData = Object.keys(dataPorMes).map(function (mesAno) {
            return dataPorMes[mesAno];
        });

        // Defina o valor do eixo Y fora do loop
        var options10 = {
            series: [{
                name: 'Faturamento',
                data: seriesData // Use os valores somados por mês
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false,
                }
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'category',
                categories: Object.keys(dataPorMes) // Use as chaves (meses) como categorias
            },
            yaxis: {
                min: 0,
                title: {
                    text: 'Faturamento por mês',
                },
                labels: {
                    formatter: function () {
                        // Use a variável totalPendente como valor para o eixo Y
                        return 'R$ ' + totalPendente.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                    }
                }
            },
            title: {
                text: 'Faturamento por Mês',
                align: 'left',
                style: {
                    fontSize: "16px",
                    color: '#666'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return 'R$ ' + val.toLocaleString('pt-BR', { minimumFractionDigits: 2 });
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart10"), options10);
        chart.render();
    </script>







    <script>
        var data = {!! json_encode($data) !!};

        var meses = data.map(function (item) {
            return item.mes;
        });

        var valoresPagos = data.map(function (item) {
            return parseFloat(item.pago);
        });

        var valoresPendentes = data.map(function (item) {
            return parseFloat(item.pendente);
        });

        var options11 = {
            series: [{
                name: 'Pago',
                data: valoresPagos
            }, {
                name: 'Pendente',
                data: valoresPendentes
            }],
            chart: {
                height: 350,
                type: 'bar',
                stacked: true,
                toolbar: {
                    show: false,
                },
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                },
            },
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                categories: meses,
            },
            yaxis: {
                min: 0,
                title: {
                    text: 'Valores por mês',
                },
                labels: {
                    formatter: function (value) {
                        return 'R$ ' + value.toLocaleString('pt-BR');
                    },
                },
            },
            title: {
                text: 'Relação Pago vs. Pendente por Mês',
                align: 'left',
                style: {
                    fontSize: '16px',
                    color: '#666',
                },
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return 'R$ ' + val.toLocaleString('pt-BR', {
                            minimumFractionDigits: 2,
                        });
                    },
                },
            },
        };

        var chart11 = new ApexCharts(document.querySelector("#chart11"), options11);
        chart11.render();
    </script>
@endsection

