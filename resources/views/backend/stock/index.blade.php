<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Stocks
            </h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Stock
            </button>
        </div>
        <div class="pb-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Barcode</th>
                                    <th>Buying Price</th>
                                    <th>Selling Price</th>
                                    <th>Wholesale Price</th>
                                    <th>UOM</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
        @include('backend.stock.create')

        @include('backend.stock.edit')

        @include('backend.partials.delete')
        </div>
        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
 
            $(document).ready(function() {
                $(document).ready(function() {
                window.deleteData = function(uuid) {
                    var url = "{{ route('stocks.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    const form = document.getElementById("deleteForm");
                    form.setAttribute("action", url);
                }

                window.editData = function(uuid) {
                    var editUrl = "{{ route('stocks.edit', ':uuid') }}";
                    var updateUrl = "{{ route('stocks.update', ':uuid') }}";
                    editUrl = editUrl.replace(':uuid', uuid);
                    updateUrl = updateUrl.replace(':uuid', uuid);
                    const form = document.getElementById("editForm");
                    form.setAttribute("action", updateUrl);

                    $.ajax({
                        url: editUrl,
                        type: "GET",
                        data:{}, //id:rowId
                        success: function (data) {
                            console.log('Data------:', data.role.uuid);
                            $('#name').val(data.name);
                            $('#selectpicker').val(data.role.uuid).trigger('change');
                            let loc = data.locations.map((x) => x.uuid );
                            $('#multiple-select').val(loc).trigger('change');
                            $('#email').val(data.email);
                        },
                        error: function (data) {
                            console.log('Error------:', data);
                        }                
                    })
                }

                var table = $('#myTable').DataTable({
                    "columnDefs": [
                            { "width": "150px", "targets": 7 }
                        ],
                    processing: false,
                    serverSide: false,
                    autoWidth: false,
                    ajax: "{{ route('stocks.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'barcode',
                            name: 'barcode'
                        },
                        {
                            data: 'buying_price',
                            name: 'buying_price'
                        },
                        {
                            data: 'selling_price',
                            name: 'selling_price'
                        },
                        {
                            data: 'wholesale_price',
                            name: 'wholesale_price'
                        },
                        {
                            data: 'uom',
                            name: 'uom'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className:'text-center'
                        },
                    ],
                    "bDestroy": true
                });
                $('#myTable').show()
            });
        </script>
        @endsection
    </x-content>
</x-layout>