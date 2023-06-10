<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Healing Streams TV | Login Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
  <style>
    @media (max-width: 1000px)
    {
        .register-page{
            height:auto!important;
        }
    }
  </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center" style="background:rgba(11, 11, 11, 0.582);">
            <a href="Javascript::void()" class="h1"><img src="{{asset('images/logo.png')}}" width=100%></a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
      
            <form action="{{ route('login') }}" id="loginForm" method="post">@csrf
                <x-forms.input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" title="Username [ Email ]" name="email" id="email" type="email" required="True"/>
                <x-forms.input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" title="Password" name="password" id="password" type="password" required="True"/>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-8">
                        {{-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> --}}
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mb-1" style="float:right;">
              <a href="forgot-password.html">I forgot my password</a>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
    $(function () {
  $('#loginForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
