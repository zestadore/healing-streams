@extends('layouts.app')
    @section('title')
        <title>Healing Streams TV | Dashboard</title>
    @endsection
    @section('breadcrump')
        <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
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
                        <label for="start_date" style="color:orange;">FROM DATE</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="end_date" style="color:orange;">TO DATE</label>
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
                    <div class="card" style="background:#7393B3;">
                        {{-- <div class="card-header">
                          <h3 class="card-title">ONE-OFF</h3>
                        </div> --}}
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td colspan="2" style="color:rgb(176, 55, 7);"><b>ONE-OFF</b></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_oneoff">$1000</td>
                                </tr>
                                <tr>
                                    <th>Partners</th>
                                    <td id="count_oneoff">10</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card" style="background:#A9A9A9;">
                        {{-- <div class="card-header">
                          <h3 class="card-title">PLEDGE</h3>
                        </div> --}}
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td style="color:rgb(104, 15, 58);"><b>PLEDGE</b></td>
                                    <td style="color:rgb(104, 15, 58);"><b>Pending</b></td>
                                    <td style="color:rgb(104, 15, 58);"><b>Paid</b></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_pledge_promised">$850</td>
                                    <td id="total_pledge_paid">$850</td>
                                </tr>
                                <tr>
                                    <th>Partners</th>
                                    <td id="count_pledge_promised">8</td>
                                    <td id="count_pledge_paid">8</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card" style="background:#C0C0C0;">
                        {{-- <div class="card-header">
                          <h3 class="card-title">SUBSCRIPTION</h3>
                        </div> --}}
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <td colspan="2" style="color:purple;"><b>SUBSCRIPTION</b></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td id="total_monthly">$1500</td>
                                </tr>
                                <tr>
                                    <th>Partners</th>
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
                    <div class="card" style="background:#7393B3;">
                        <div class="card-body">
                            <table class="table table-stripped" id="one-off-region-table"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card" style="background:#A9A9A9;">
                        <div class="card-body">
                            <table class="table table-stripped" id="pledge-region-table"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card" style="background:#C0C0C0;">
                        <div class="card-body">
                            <table class="table table-stripped" id="monthly-region-table"></table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            {{-- <div class="row">
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
            </div> --}}
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
                        $('#total_pledge_paid').html(pledge.payments );
                        $('#count_pledge_paid').html(pledge.count );
                        pledge=response.pledgePromisePayments;
                        $('#total_pledge_promised').html(pledge.payments );
                        $('#count_pledge_promised').html(pledge.count );
                        var monthly=response.monthlyPayments;
                        $('#total_monthly').html(monthly.payments);
                        $('#count_monthly').html(monthly.count);
                        $('#one-off-region-table').html(response.regionOneOffPayments);
                        $('#monthly-region-table').html(response.regionMonthlyPayments);
                        $('#pledge-region-table').html(response.regionPledgePayments);
                        appendPledgePromise(response.regionPledgePromised);
                    }
                });
            }
            getData();
            $('#dashboardSearch').click(function(){
                getData();
            })

            function appendPledgePromise(promised){
                var id="";
                var html="";
                var element="";
                $.each(promised, function( key, value ) {
                    id=value.region
                    element=$("#pledge-region-table" ).find('#pledge_count_'+id);
                    html=$(element).html();
                    // html=html+'(Pd)/'+value.count+'(Prsd)';
                    html=html+''+value.count;
                    $(element).html(html);
                    element=$("#pledge-region-table" ).find('#pledge_amount_'+id);
                    html=$(element).html();
                    // html=html+'(Pd)/'+value.payments+'(Prsd)';
                    // html=html+'/'+value.payments;
                    $(element).html(html);
                });
            }
        </script>
    @endsection
    