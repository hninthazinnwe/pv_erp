<div class="modal modal-default" id="editModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="" tabindex="1" id="editForm">
        @csrf
        {{method_field('PUT')}}
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label class="col-form-label">Phone:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label class="col-form-label">email:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                <label class="col-form-label">Address:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>