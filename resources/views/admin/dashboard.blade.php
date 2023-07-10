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
            {{-- <form action="{{route('home')}}">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="start_date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select name="currency" id="currency" class="form-control">
                                @foreach ($currencies as $currency)
                                    <option value="{{$currency->id}}" @if ($currency->currency=="USD")
                                        @selected(true)
                                    @endif>{{$currency->currency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <br><p> </p>
                        <button type="submit" class="btn btn-info btn-sm" id="dashboardSearch">Search</button>
                    </div>
                </div>
            </form> --}}
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
                                    <td id="total_expecting">$1000</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_expecting">10</td>
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
                                    <td id="total_paid">$850</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_paid">8</td>
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
                                    <td id="total_pending">$1500</td>
                                </tr>
                                <tr>
                                    <th>Number of partners</th>
                                    <td id="count_pending">12</td>
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
                                    <td>$1000</td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$900</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$3000</td>
                                    <td>18</td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$2200</td>
                                    <td>14</td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$3400</td>
                                    <td>20</td>
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
                                    <td>$2800</td>
                                    <td>13</td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$7000</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$4600</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$5230</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$6540</td>
                                    <td>30</td>
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
                                    <td>$5000</td>
                                    <td>21</td>
                                </tr>
                                <tr>
                                    <th>Europe</th>
                                    <td>$4320</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <th>Africa</th>
                                    <td>$4360</td>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <th>Asia</th>
                                    <td>$5210</td>
                                    <td>27</td>
                                </tr>
                                <tr>
                                    <th>Oceania</th>
                                    <td>$4390</td>
                                    <td>24</td>
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
    