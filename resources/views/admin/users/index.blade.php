@extends('layouts.app')
@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
@endsection
@section('title')
    <title>Healing Streams TV | Users</title>
@endsection
@section('breadcrump')
    <div class="col-sm-6">
        <h1 class="m-0">Users</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div><!-- /.col -->
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default color-palette-box">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-flag"></i>
                Users
              </h3>
                <button type="button" class="btn btn-outline-primary mr-1 mb-3 btn-sm" id="add-new" style="float:right;">
                    <i class="fa fa-fw fa-plus mr-1"></i> Add New
                </button>
            </div>
            <div class="card-body">
                <form id="filterfordatatable" class="form-horizontal" onsubmit="event.preventDefault();">
                    <div class="row ">
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="Search with first name">
                        </div>
                    </div>
                </form><br>
                <table class="table table-bordered table-striped" id="item-table">
                    <thead>
                        <tr>
                            <th class="nosort">#</th>
                            <th>{{ __('First name') }}</th>
                            <th>{{ __('Last name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Mobile') }}</th>
                            <th class="nosort">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
          </div><br>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Pop Out Block Modal -->
  <div class="modal fade" id="modal-block-popout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add / Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="block-content font-size-sm">
                <div class="form-group">
                    <label for="first_name">First name<span style="color:red">*</span></label>
                    <input type="text" placeholder="First name*" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" required autocomplete="name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input  placeholder="Last name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" autocomplete="name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email id<span style="color:red">*</span></label>
                    <input id="email" type="email" placeholder="Email id*" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile number<span style="color:red">*</span></label>
                    <input id="mobile" type="text" placeholder="Mobile number*" class="form-control @error('mobile') is-invalid @enderror" name="mobile" required autocomplete="mobile">
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-data" data-id=0>Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/toastr/toastr.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function drawTable()
        {
            var table = $('#item-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                // responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "pagingType": "full_numbers",
                "dom": "<'row'<'col-sm-12 col-md-12 right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    "url": '{{route("users.index")}}',
                    "data": function(d) {
                        var searchprams = $('#filterfordatatable').serializeArray();
                        var indexed_array = {};

                        $.map(searchprams, function(n, i) {
                            indexed_array[n['name']] = n['value'];
                        });
                        return $.extend({}, d, indexed_array);
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'name'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],

                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': ['nosort']
                }]

            });

            $.fn.DataTable.ext.pager.numbers_length = 7;
            $('#filterfordatatable').change(function() {
                table.draw();
            });
        }
        drawTable();
        // $(function () {
        //   $("#example1").DataTable({
        //     "responsive": true, "lengthChange": false, "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //   $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        //   });
        // });

        $('#add-new').click(function(){
            $('#first_name').val('');
            $('#last_name').val('');
            $('#email').val('');
            $('#mobile').val('');
            $('#modal-block-popout').modal('show');
        });

        $('#save-data').click(function(){
            var id=$('#save-data').attr('data-id');
            var first_name=$('#first_name').val();
            var last_name=$('#last_name').val();
            var email=$('#email').val();
            var mobile=$('#mobile').val();
            if(first_name=="" || email=="" || mobile=="")
            {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Kindly enter all details!',
                    autohide: true,
                    delay: 750,
                })
            }else{
                $.ajax({
                    url: "{{route('users.store')}}",
                    type:"post",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        id:id,
                        first_name:first_name,
                        last_name:last_name,
                        email:email,
                        mobile:mobile
                    },
                    success:function(response){
                        console.log(response);
                        if(response.success){
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Data inserted succesfully!',
                                autohide: true,
                                delay: 750,
                            })
                            $('#save-data').attr("data-id",0);
                            $('#modal-block-popout').modal('hide');
                            drawTable();
                        }else{
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Failed to insert data, kindly try again!',
                                autohide: true,
                                delay: 750,
                            })
                        }
                    },
                });
            }
            
        })

        function editData(id,first_name,last_name,email,mobile)
        {
            getCountries();
            $('#first_name').val(first_name);
            $('#last_name').val(last_name);
            $('#email').val(email);
            $('#mobile').val(mobile);
            $('#save-data').attr("data-id",id);
            $('#modal-block-popout').modal('show');
        }

        function deleteData(id)
        {
            swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            }).then((result) => {
                if (result) {
                    var url="{{route('users.destroy','ID')}}";
                    url=url.replace('ID',id);
                    $.ajax({
                        url: url,
                        type:"delete",
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success:function(response){
                            console.log(response);
                            if(response.success){
                                swal("Good job!", "You deleted the user!", "success");
                                drawTable();
                            }else{
                                swal("Oops!", "Failed to deleted the user!", "danger");
                            }
                        },
                    });
                }
            })
        }

        function generatePassword(id){
            var url="{{route('users.update','ID')}}";
            url=url.replace('ID',id);
            $.ajax({
                url: url,
                type:"put",
                data:{
                    "_token": "{{ csrf_token() }}",
                },
                success:function(response){
                    console.log(response);
                    if(response.success){
                        swal("Good job!", response.message, "success");
                        drawTable();
                    }else{
                        swal("Oops!", "Failed to deleted the state!", "danger");
                    }
                },
            });
        }

      </script>
@endsection