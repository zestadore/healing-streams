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
                          <h3 class="card-title">Pledged</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td>$</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td>$</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Paid</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td>$</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td>$</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Pending</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Amount</th>
                                    <td>$</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td>$</td>
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
                            <table class="table table-stripped">
                                <tr>
                                    <th>Region</th>
                                    <th>Amount</th>
                                    <th>Partners</th>
                                </tr>
                                <tr>
                                    <th>Americas</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Region</th>
                                    <th>Amount</th>
                                    <th>Partners</th>
                                </tr>
                                <tr>
                                    <th>Americas</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-stripped">
                                <tr>
                                    <th>Region</th>
                                    <th>Amount</th>
                                    <th>Partners</th>
                                </tr>
                                <tr>
                                    <th>Americas</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$</td>
                                    <td> </td>
                                </tr>
                            </table>
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
        
    @endsection
    