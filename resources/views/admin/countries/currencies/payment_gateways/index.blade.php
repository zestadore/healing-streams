@extends('layouts.app')
@section('styles')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
@endsection
@section('title')
        <title>Healing Streams TV | Payment Gateways</title>
    @endsection
@section('breadcrump')
    <div class="col-sm-6">
        <h1 class="m-0">Currencies</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Payment Gateways</li>
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
                Payment Gateways
              </h3>
                <button type="button" class="btn btn-outline-primary mr-1 mb-3 btn-sm" id="add-new" style="float:right;">
                    <i class="fa fa-fw fa-plus mr-1"></i> Add New
                </button>
            </div>
            <div class="card-body">
                <form id="filterfordatatable" class="form-horizontal" onsubmit="event.preventDefault();">
                    <div class="row ">
                        <div class="col">
                            <select name="status_search" id="status_search" class="form-control">
                                <option value="">Search with status</option>
                                <option value=0>Inactive</option>
                                <option value=1>Active</option>
                            </select>
                        </div>
                    </div>
                </form><br>
                <table class="table table-bordered table-striped" id="item-table">
                    <thead>
                        <tr>
                            <th class="nosort">#</th>
                            <th>{{ __('Payment Gateways') }}</th>
                            <th>{{ __('Default') }}</th>
                            <th>{{ __('Status') }}</th>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add / Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="block-content font-size-sm">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="payment_gateway_id">Payment gateway <span style="color:red">*</span></label>
                            <select name="payment_gateway_id" id="payment_gateway_id" class="form-control">
                                <option value="">Select a payment gateway</option>
                                @foreach ($paymentGateways as $item)
                                    <option value="{{$item->id}}">{{$item->payment_gateway}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="is_default">Default <span style="color:red">*</span></label>
                            <select name="is_default" id="is_default" class="form-control">
                                <option value=0>Non default</option>
                                <option value=1>Default</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-switch mb-1">
                    <input type="checkbox" class="custom-control-input" id="example-switch-custom1" name="status" value=1 checked="true">
                    <label class="custom-control-label" for="example-switch-custom1">Active</label>
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
    <script src="{{asset('assets/admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function drawTable()
        {
            var url='{{route("country-currencies.payment-gateways.index",["CURRENCYID"])}}';
            url=url.replace("CURRENCYID","{{$currencyId}}");
            var table = $('#item-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                // responsive: true,
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
                        data: 'payment_gateway',
                        name: 'payment_gateway'
                    },
                    {
                        data: 'default',
                        name: 'default'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            if (data ==1) {
                                return "<span class='badge badge-success'>Active</span>";
                            }else{
                                return "<span class='badge badge-danger'>Inactive</span>";
                            }
                            
                        }
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

        $('#add-new').click(function(){
            $('#payment_gateway_id').val('');
            $('#is_default').val(0);
            $('#modal-block-popout').modal('show');
        });

        $('#save-data').click(function(){
            var id=$('#save-data').attr('data-id');
            var paymentGatewayId=$('#payment_gateway_id').val();
            var isDefault=$('#is_default').val();
            if($('#example-switch-custom1').prop("checked") == true){
                var status=1;
            }else{
                var status=0;
            }
            if(paymentGatewayId=="")
            {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Kindly enter all the details',
                    autohide: true,
                    delay: 750,
                })
            }else{
                var url="{{route('country-currencies.payment-gateways.store',['CURRENCYID'])}}";
                url=url.replace('CURRENCYID','{{$currencyId}}');
                $.ajax({
                    url: url,
                    type:"post",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        payment_gateway_id:paymentGatewayId,
                        id:id,
                        status:status,
                        is_default:isDefault
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

        function editData(id,status,payment_gateway_id,is_default)
        {
            $('#payment_gateway_id').val(payment_gateway_id);
            $('#is_default').val(is_default);
            $('#save-data').attr("data-id",id);
            if(status==0){
                $("#example-switch-custom1").prop('checked', false);
            }else{
                $("#example-switch-custom1").prop('checked', true);
            }
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
                    var url="{{route('country-currencies.payment-gateways.destroy',['CURRENCYID','ID'])}}";
                    url=url.replace('CURRENCYID','{{$currencyId}}');
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
                                swal("Good job!", "You deleted the payment gateway!", "success");
                                drawTable();
                            }else{
                                swal("Oops!", "Failed to deleted the payment gateway!", "danger");
                            }
                        },
                    });
                }
            })
        }
      </script>
@endsection