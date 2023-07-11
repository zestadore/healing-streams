<div class="btn-group">
    <a class="btn btn-sm btn-info" href="Javascript::void(0);" onclick="editData('{{Crypt::encrypt($id)}}','{{$status}}','{{$payment_gateway_id}}','{{$is_default}}');"><i class="fa fa-fw fa-pencil-alt"></i> Edit</a>
    <a class="btn btn-sm btn-warning" href="javascript::void(0)"
        onclick="deleteData('{{$id}}')">
        <i class="fa fa-fw fa-times"></i> Delete</a>
</div>