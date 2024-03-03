<div class="modal modal-default" id="editModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Create Customer</h4>
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
              <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
              <label class="col-form-label">Date Of Birth:<span class="text-danger">*</span></label>
              <input type="date" name="dob" placeholder="dd-mm-yyyy" name="dob" id="dob">  
          </div>
          <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
              <label class="col-form-label">Phone:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="phone" id="phone">
          </div>
          <div class="form-group {{ $errors->has('contact_person') ? 'has-error' : '' }}">
              <label class="col-form-label">Contact Person:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="contact_person" id="contact_person">
          </div>
          <div class="form-group {{ $errors->has('deposit_amt') ? 'has-error' : '' }}">
              <label class="col-form-label">Deposit Amount:<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="deposit_amt" id="deposit_amt">
          </div>
          <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              <label class="col-form-label">Email:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="email" id="email">
          </div>
          <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
              <label class="col-form-label">Address:<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="address" id="address">
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
