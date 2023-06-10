@extends('layouts.app')
    @section('title')
        <title>Healing Streams | Profile</title>
    @endsection
    @section('styles')
        <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
    @endsection
    @section('breadcrump')
        <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div><!-- /.col -->
    @endsection
    @section('content')
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                @endif
                <div class="card card-default color-palette-box">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-user"></i>
                        Profile
                      </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('profile.update')}}" method="post" id="addNewForm" enctype='multipart/form-data'>@csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                                    <x-forms.input class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" title="First name" name="first_name" id="first_name" type="text" required="True"/>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
                                    <x-forms.input class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" title="Last name" name="last_name" id="last_name" type="text" required="False"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                                    <x-forms.input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" title="Email" name="email" id="email" type="email" required="True"/>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                                    <x-forms.input class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" title="Mobile" name="mobile" id="mobile" type="number" required="True"/>
                                </div>
                                <div class="col-lg-4 col-sm-4 col-md-12 col-xs-12">
                                    <x-forms.input class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" title="Image" name="image" id="image" type="file" required="False"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info" style="float:right;">Save</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                  </div><br>
            </div><!--/. container-fluid -->
        </section>
    @endsection
    @section('scripts')
        <!-- jquery-validation -->
        <script src="{{asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
        <script>
             $(function () {
                $('#addNewForm').validate({
                    rules: {
                        first_name: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        mobile: {
                            required: true
                        },
                    },
                    messages: {
                        first_name: {
                            required: "Please enter the first name."
                        },
                        email: {
                            required: "Please enter your email id."
                        },
                        mobile: {
                            required: "Please enter your mobile number."
                        },
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

            function prefillForm(){
                $('#first_name').val('{{Auth::user()->first_name}}');
                $('#last_name').val('{{Auth::user()->last_name}}');
                $('#email').val('{{Auth::user()->email}}');
                $('#mobile').val('{{Auth::user()->mobile}}');
            }
            prefillForm();
            $("#email").prop("readonly", true);
        </script>
    @endsection