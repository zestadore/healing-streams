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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="start_date">Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="end_date">Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <br><p> </p>
                    <button type="button" class="btn btn-info btn-sm" id="dashboardSearch">Search</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">One-off</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_oneoff">$1000</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_oneoff">10</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Pledge</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_pledge">$850</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_pledge">8</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Subscription</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_monthly">$1500</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_monthly">12</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped" id="one-off-region-table"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped" id="pledge-region-table"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped" id="monthly-region-table"></table>
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
        <script>
            function getData(){
                var startDate=$('#start_date').val();
                var endDate=$('#end_date').val();
                $.ajax({
                    url: "{{route('dashboard.data')}}",
                    type:"get",
                    data:{
                        "start_date": startDate,
                        "end_date": endDate
                    },
                    dataType:"json",
                    success:function(response){
                        var oneOff=response.oneOffPayments;
                        $('#total_oneoff').html(oneOff.payments);
                        $('#count_oneoff').html(oneOff.count);
                        var pledge=response.pledgePayments;
                        $('#total_pledge').html(pledge.payments);
                        $('#count_pledge').html(pledge.count);
                        var monthly=response.monthlyPayments;
                        $('#total_monthly').html(monthly.payments);
                        $('#count_monthly').html(monthly.count);
                        $('#one-off-region-table').html(response.regionOneOffPayments);
                        $('#monthly-region-table').html(response.regionMonthlyPayments);
                        $('#pledge-region-table').html(response.regionPledgePayments);
                    }
                });
            }
            getData();
            $('#dashboardSearch').click(function(){
                getData();
            })
        </script>
    @endsection
    