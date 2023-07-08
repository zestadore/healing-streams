<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/loader.css')}}">
  @yield('styles')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div id="loader"></div>
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('assets/admin/images/bag-logo.png')}}" alt="BagLogo" height="100" width="100">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
  
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Hi, {{Auth::user()->first_name}} {{Auth::user()->last_name}}<p>{{strtoupper(Auth::user()->role)}} </p></span>
          <div class="dropdown-divider"></div>
          <a href="{{route('profile')}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('change.password')}}" class="dropdown-item">
            <i class="fas fa-pencil-alt mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript::void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fas fa-user-lock mr-2"></i> Logout
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="text-align: center;">
      <img src="{{asset('images/logo.png')}}" width=100%>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->image==null)
            <img src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{Auth::user()->image_path}}" class="img-circle elevation-2" alt="User Image" width=50 height=50>
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link {{ (request()->is('home*') || request()->is('home*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item {{ (request()->is('countries*')||request()->is('currencies*')||request()->is('payment-gatyeway*')||request()->is('regions*'))? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('countries*')||request()->is('currencies*')||request()->is('payment-gatyeway*')||request()->is('regions*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-tools"></i>
                  <p>
                    Masters
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('regions.index')}}" class="nav-link {{ (request()->is('regions*'))? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Regions</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('countries.index')}}" class="nav-link {{ (request()->is('countries*'))? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Countries</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('currencies.index')}}" class="nav-link {{ (request()->is('currencies*'))? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Currency</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('payment-gateway.index')}}" class="nav-link {{ (request()->is('payment-gateway*'))? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payment gateways</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item {{ (request()->is('stripe-payments*')||request()->is('paypal-payments*')||request()->is('kingspay-payments*'))? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('stripe-payments*')||request()->is('paypal-payments*')||request()->is('kingspay-payments*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    Payment Gateways
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item {{ (request()->is('stripe-payments*'))? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('stripe-payments*'))? 'active' : '' }}">
                      <i class="nav-icon fas fa-plus nav-icon"></i>
                      <p>
                        Stripe
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('payments.stripe','one-off')}}" class="nav-link {{ (request()->is('stripe-payments/one-off'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>One-off</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.stripe','monthly-subscription')}}" class="nav-link {{ (request()->is('stripe-payments/monthly-subscription'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Monthly (Subscription)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.stripe','pledge')}}" class="nav-link {{ (request()->is('stripe-payments/pledge'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pledge</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item {{ (request()->is('paypal-payments*'))? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('paypal-payments*'))? 'active' : '' }}">
                      <i class="nav-icon fas fa-plus nav-icon"></i>
                      <p>
                        Paypal
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('payments.paypal','one-off')}}" class="nav-link {{ (request()->is('paypal-payments/one-off'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>One-off</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.paypal','monthly-subscription')}}" class="nav-link {{ (request()->is('paypal-payments/monthly-subscription'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Monthly (Subscription)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.paypal','pledge')}}" class="nav-link {{ (request()->is('paypal-payments/pledge'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pledge</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item {{ (request()->is('kingspay-payments*'))? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('kingspay-payments*'))? 'active' : '' }}">
                      <i class="nav-icon fas fa-plus nav-icon"></i>
                      <p>
                        Kingspay
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('payments.kingspay','one-off')}}" class="nav-link {{ (request()->is('kingspay-payments/one-off'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>One-off</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.kingspay','monthly-subscription')}}" class="nav-link {{ (request()->is('kingspay-payments/monthly-subscription'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Monthly (Subscription)</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{route('payments.kingspay','pledge')}}" class="nav-link {{ (request()->is('kingspay-payments/pledge'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pledge</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('payments.this_month')}}" class="nav-link {{ (request()->is('this-months-payments*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    Pending For This Month
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('payments.monthly_automatic')}}" class="nav-link {{ (request()->is('monthly-automatics*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    Monthly Active
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('payments.pledge')}}" class="nav-link {{ (request()->is('pledge*'))? 'active' : '' }}">
                  <i class="nav-icon fas fa-money-bill"></i>
                  <p>
                    Pledge Active
                  </p>
                </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @yield('breadcrump')
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
        @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="Javascript::void(0)">Healing Streams</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('assets/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('assets/admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/admin/dist/js/pages/dashboard2.js')}}"></script>
<script>
  $('#loader').hide();
  $(document)
  .ajaxStart(function () {
      $('#loader').show();
  })
  .ajaxStop(function () {
      $('#loader').hide();
  });
</script>
@yield('scripts')
</body>
</html>
