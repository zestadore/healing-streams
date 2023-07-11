<div class="btn-group">
    <a class="btn btn-sm btn-info" href="Javascript::void(0);" onclick="editData('{{Crypt::encrypt($id)}}','{{$status}}','{{$currency_id}}','{{$is_default}}');"><i class="fa fa-fw fa-pencil-alt"></i> Edit</a>
    <a class="btn btn-sm btn-info" href="{{route('country-currencies.payment-gateways.index',[Crypt::encrypt($id)])}}"><i class="fa fa-fw fas fa-donate"></i> Payment Gateways</a>
    <a class="btn btn-sm btn-warning" href="javascript::void(0)"
        onclick="deleteData('{{$id}}')">
        <i class="fa fa-fw fa-times"></i> Delete</a>
</div>