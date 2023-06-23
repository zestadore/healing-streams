@extends('layouts.app')
    @section('title')
        <title>Healing Streams TV | Dashboard</title>
    @endsection
    @section('breadcrump')
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    @endsection
    @section('content')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Payments Gateways</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Countries</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total transactions today</span>
                          <span class="info-box-number">{{$paymentsCounts['totalTransactions']}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Stripe transactions today</span>
                          <span class="info-box-number">{{$paymentsCounts['stripeTransactions']}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Paypal transactions today</span>
                          <span class="info-box-number">{{$paymentsCounts['paypalTransactions']}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Kingspay transactions today</span>
                          <span class="info-box-number">{{$paymentsCounts['kingspayTransactions']}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
    @section('scripts')
        <script src="{{asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>
        <script>
            var stripeCount=parseInt('{{$paymentsCounts["stripe"]}}');
            var payPalCount=parseInt('{{$paymentsCounts["paypal"]}}');
            var kinspayCount=parseInt('{{$paymentsCounts["kingspay"]}}');
            var donutData        = {
                labels: [
                    'Stripe',
                    'Paypal',
                    'Kigspay',
                ],
                datasets: [
                    {
                    data: [stripeCount,payPalCount,kinspayCount],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
                    }
                ]
            }
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData        = donutData;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
            var barChart="{{$paymentsCounts['barChart']}}";
            barChart=JSON.parse(barChart.replace(/&quot;/g,'"'));
            var countries=[];
            var stripeBar=[];
            var paypalBar=[];
            var kingspayBar=[];
            $.each(barChart, function( index, value ) {
                countries.push(value.country);
                stripeBar.push(value.stripe_sum);
                paypalBar.push(value.paypal_sum);
                kingspayBar.push(value.kingspay_sum);
            });
            var areaChartData = {
                labels  : countries,
                datasets: [
                    {
                        label               : 'Stripe',
                        backgroundColor     : '#f56954',
                        borderColor         : '#f56954',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : '#f56954',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#f56954',
                        data                : stripeBar
                    },
                    {
                        label               : 'Paypal',
                        backgroundColor     : '#00a65a',
                        borderColor         : '#00a65a',
                        pointRadius         : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#00a65a',
                        data                : paypalBar
                    },
                    {
                        label               : 'Kingspay',
                        backgroundColor     : '#f39c12',
                        borderColor         : '#f39c12',
                        pointRadius         : false,
                        pointColor          : '#f39c12',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: '#f39c12',
                        data                : kingspayBar
                    },
                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

        </script>
    @endsection
    