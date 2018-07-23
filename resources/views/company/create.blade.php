<div class="modal fade" id="myModalCreate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create company</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
<form  role="form" id="createForm">
    @csrf
    <div class="error"></div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" >
    </div>
    <div class="form-group">
        <label for="adress_line1">Adress 1:</label>
        <input type="text" class="form-control" id="adress_line1" name="adress_line1" >
    </div>
    <div class="form-group">
        <label for="adress_line2">Adress 2:</label>
        <input type="text" class="form-control" id="adress_line2" name="adress_line2" >
    </div>
    <div class="form-group">
        <label for="adress_line2">Logo:</label>
        <input type="file" class="form-control" id="logo" name="logo" >
    </div>
    <div class="form-group">
        <label for="zip">Zip:</label>
        <input type="text" class="form-control" id="zip" name="zip" >
    </div>
    <div class="form-group">
        <label for="province">Province:</label>
        <input type="text" class="form-control" id="province" name="province" >
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <input type="text" class="form-control" id="city" name="city">
    </div>
    <div class="form-group">
        <label for="country">Country:</label>
        <input type="text" class="form-control" id="country" name="country">
    </div>
    @if(Auth::user()->role==='user')
    <input type="hidden" name="owner_id" value="{{Auth::user()->id}}">
@else
    <div class="form-group">
        <label for="country">Owner company:</label>
        <select name="owner_id" id="owner_id" class="form-control">
            <option value="">Not selected</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" >{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    @endif
</form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="create" >Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

            </div>

        </div>
    </div>
</div>
</div>