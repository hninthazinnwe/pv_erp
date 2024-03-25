<style>
    .accordion-toggle {
        background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
        cursor: pointer;
        display: block;
    }

    /* accordion-toggle {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    } */
</style>
<div class="modal modal-default" id="createModal" tabindex="-1" role="dialog"
  aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalScrollableTitle">Create Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <form method="POST" action="{{route('stocks.store')}}" tabindex="1" id="createForm">
        @csrf
        {{method_field('POST')}}
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label class="col-form-label">Name:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" >
            </div>
            <div class="form-group {{ $errors->has('barcode') ? 'has-error' : '' }}">
                <label class="col-form-label">Barcode:<span class="text-danger">*</span></label>
                <input type="text" class="form-control"name="barcode">
            </div>
            <div class="form-group  {{ $errors->has('buying_price') ? 'has-error' : '' }}">
                <label class="col-form-label">Buying Price:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="buying_price">
            </div>
            <div class="form-group  {{ $errors->has('selling_price') ? 'has-error' : '' }}">
                <label class="col-form-label">Selling Price:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="selling_price">
            </div>
            <div class="form-group">
                <label class="col-form-label">Wholesale Price:</label>
                <input type="text" class="form-control" name="wholesale_price">
            </div>
            <div class="form-group">
                <label class="col-md-4 col-form-label">UOM<span class="text-danger">*</span></label>
                <select class="multiple-select form-control" id="uom" style="width: 50%">
                    @foreach ($uoms as $uoms)
                    <option {{in_array($uoms->uuid, []) ? 'selected':''}} value="{{$uoms->uuid}}">{{$uoms->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="text" class="form-control" name="uomlist[]" id="uomlist" value ="{{$uom_barcode[0]}}" >
                <table class="table">
                    <thead>
                        <th>UOM</th>
                        <th>Barcode</th>
                        <th>IsDefault</th>
                        <th>Delete</th>
                    </thead>
                    <tbody id="uom_barcode">
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
  </div>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('.multiple-select').select2({
        placeholder: "--Select UOM--",
      });
      $('.hiddenDiv').hide();
      $('.removeRow').click(function(){
        debugger
        let self = $(this);
        self.remove();
      })
      $('#uom').change(function(){
            let uom_id = $('#uom').val();
            let uom_name = $('#uom option:selected').text();
            let uom_list = $('#uomlist').val();
            console.log(typeof(uom_list), uom_list);
            uom_list.push([uom_id,uom_name,'',false]);
            $('#uomList').val(uom_list);
            $('#uom_barcode').append(`<tr id="${uom_id}">
            <td>${uom_name}</td>
            <td> <input type="text" class="uom_barcode"> </td>
            <td><input type="radio" id="1" name="is_default" value="0"></td>
            <td class="removeRow"><button type="button" class="btn-sm btn-danger">Delete</button></td>
            </tr>`);
      })

      $('.uom_barcode').change(function() {
        debugger
            let uom_list = ('#uomList').val();
            barcode = this.val();
            uom_list.push([uom_id,uom_name,barcode,false]);
      })

      $('.accordion-toggle').click(function(){
        // debugger
            let s = $('.hiddenDiv').hasClass('show');
            if(s){
                $('.hiddenDiv').hide();
                $('.hiddenDiv').removeClass('show');
            }
            else {
                $('.hiddenDiv').show();
                $('.hiddenDiv').addClass('show');
            }
        
            if(show)
                divCollapse.addClass('show');
            else
                self.parent().addClass('shown');
        });
    });

</script>