<div class="btn-group">
    <a class="btn btn-sm btn-info" href="Javascript::void(0);" onclick="editData('{{$id}}','{{$first_name}}','{{$last_name}}','{{$email}}','{{$mobile}}');"><i class="fa fa-fw fa-pencil-alt"></i> Edit</a>
    <a class="btn btn-sm btn-warning" href="javascript::void(0)"
        onclick="deleteData('{{$id}}')">
        <i class="fa fa-fw fa-times"></i> Delete</a>
    <a class="btn btn-sm btn-primary" href="javascript::void(0)"
        onclick="generatePassword('{{$id}}')">
        <i class="fa fa-fw fa-edit"></i> Generate Password</a>
</div>