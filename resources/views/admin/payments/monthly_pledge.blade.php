@extends('layouts.app')
@section('styles')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
@endsection
@section('title')
        <title>Healing Streams TV | Payments</title>
    @endsection
@section('breadcrump')
    <div class="col-sm-6">
        <h1 class="m-0">Payments</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Payments</li>
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
                <i class="fas fa-inr"></i>
                Payments
              </h3>
                {{-- <button type="button" class="btn btn-outline-primary mr-1 mb-3 btn-sm" id="add-new" style="float:right;">
                    <i class="fa fa-fw fa-plus mr-1"></i> Add New
                </button> --}}
            </div>
            <div class="card-body">
                <form id="filterfordatatable" class="form-horizontal" onsubmit="event.preventDefault();">
                    <div class="row ">
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="Search with first name">
                        </div>
                        <div class="col">
                            <select name="payment_search" id="payment_search" class="form-control">
                                <option value="">Search with payment gateway</option>
                                @foreach ($gateways as $item)
                                    <option value="{{$item->id}}">{{$item->payment_gateway}}</option>
                                @endforeach
                            </select>
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
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('Country') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Date created') }}</th>
                            <th>{{ __('Payment date') }}</th>
                            <th>{{ __('Payment gateway') }}</th>
                            <th>{{ __('Resend mail') }}</th>
                            {{-- <th>{{ __('status') }}</th> --}}
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
            var url="";
            var choice="{{$choice}}";
            if(choice=="monthly"){
                url="{{route('payments.monthly_automatic')}}";
            }else{
                url="{{route('payments.pledge')}}";
            }
            var table = $('#item-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "pagingType": "full_numbers",
                "dom": "<'row'<'col-sm-12 col-md-12 right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    "url": url,
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
                        data: 'email_id',
                        name: 'email_id'
                    },
                    {
                        data: 'phone_no',
                        name: 'phone_no'
                    },
                    {
                        data: 'partnership_categories',
                        name: 'partnership_categories'
                    },
                    {
                        data: 'country',
                        name: 'country'
                    },
                    {
                        data: 'currency',
                        name: 'currency'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'date_created',
                        name: 'date_created'
                    },
                    {
                        data: 'initialized',
                        name: 'initialized'
                    },
                    {
                        data: 'payment_gateway',
                        name: 'payment_gateway'
                    },
                    {
                        data: 'mail',
                        name: 'mail'
                    },
                    // {
                    //     data: 'status',
                    //     name: 'status'
                    // },
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

        function resendMail(id){
            var url="{{route('mail.resend',['ID','CHOICE'])}}";
            url=url.replace('ID',id);
            url=url.replace('CHOICE','{{$choice}}');
            $.ajax({
                url: url,
                type:"get",
                success:function(response){
                    if(response.success){
                        swal("Good job!", "Mail forwarded successfully!!", "success");
                    }else{
                        swal("Oops!", "Failed to forward the mail!", "danger");
                    }
                },
            });
        }

      </script>
@endsection