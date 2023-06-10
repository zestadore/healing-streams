@extends('layouts.app')
@section('styles')
    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/toastr/toastr.min.css')}}">
@endsection
@section('breadcrump')
    <div class="col-sm-6">
        <h1 class="m-0">Countries</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Countries</li>
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
                Countries
              </h3>
                <button type="button" class="btn btn-outline-primary mr-1 mb-3 btn-sm" id="add-new" style="float:right;">
                    <i class="fa fa-fw fa-plus mr-1"></i> Add New
                </button>
            </div>
            <div class="card-body">
                <form id="filterfordatatable" class="form-horizontal" onsubmit="event.preventDefault();">
                    <div class="row ">
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="Search with country">
                        </div>
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
                            <th>{{ __('Country') }}</th>
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
                    <label for="country">Country <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
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
                    "url": '{{route("countries.index")}}',
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
                        data: 'country',
                        name: 'country'
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
            $('#country').val('');
            $('#modal-block-popout').modal('show');
        });

        $('#save-data').click(function(){
            var id=$('#save-data').attr('data-id');
            var country=$('#country').val();
            if($('#example-switch-custom1').prop("checked") == true){
                var status=1;
            }else{
                var status=0;
            }
            if(country=="")
            {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Kindly enter country',
                    autohide: true,
                    delay: 750,
                })
            }else{
                $.ajax({
                    url: "{{route('countries.store')}}",
                    type:"post",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        country:country,
                        id:id,
                        status:status
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

        function editData(id,country,status)
        {
            $('#country').val(country);
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
                    var url="{{route('countries.destroy','ID')}}";
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
                                swal("Good job!", "You deleted the country!", "success");
                                drawTable();
                            }else{
                                swal("Oops!", "Failed to deleted the country!", "danger");
                            }
                        },
                    });
                }
            })
        }
      </script>
@endsection