<div class="modal modal-default" id="editModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Edit UOM</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="POST" action="" tabindex="1" id="editForm">
        @csrf
        {{method_field('PUT')}}
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-form-label">Hello:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group  {{ $errors->has('symbol') ? 'has-error' : '' }}">
                <label class="col-form-label">Symbol:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="symbol" name="symbol">
            </div>
            <div class="form-group  {{ $errors->has('unit') ? 'has-error' : '' }}">
                <label class="col-form-label">Unit:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="unit" name="unit">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="">Update</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>