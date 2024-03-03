<div class="modal modal-default" id="createModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Create User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="{{route('users.store')}}" tabindex="1" id="createForm">
        @csrf
        {{method_field('POST')}}
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
                <label class="col-form-label">Role<span class="text-danger">*</span></label>
                <select class="form-control selectpicker" name="role_id" style="width: 75%">
                    @foreach ($roles as $role)
                    <option value="{{$role->uuid}}" @if($role->uuid == '') selected @endif>{{$role->description}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="col-form-label">Locations<span class="text-danger">*</span></label>
                <select class="multiple-select form-control" name="locations[]" multiple="multiple" style="width: 75%">
                    @foreach ($locations as $location)
                    <option {{in_array($location->uuid, []) ? 'selected':''}} value="{{$location->uuid}}">{{$location->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              <label class="col-form-label">Email:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="email">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{asset('/js/select2.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('.selectpicker').select2({
        allowClear: true
      });
      $('.multiple-select').select2();
    });

</script>