<x-layout>
    <x-content>
        @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        @stop
        @section('content')
        <div class="mb-3 d-flex justify-content-between">
            <h1>
                <a class="btn btn-warning" href="">Back</a>
                All Customers
            </h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                Create Customer
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
                                    <th>Phone</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Address</th>
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
            @include('backend.customer.create')

            @include('backend.customer.edit')

            @include('backend.partials.delete')
        </div>
        @stop
        
        @section('scripts')
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
        <script>
 
            $(document).ready(function() {
                window.deleteData = function(uuid) {
                    var url = "{{ route('customers.destroy', ':uuid') }}";
                    url = url.replace(':uuid', uuid);
                    const form = document.getElementById("deleteForm");
                    form.setAttribute("action", url);
                }

                window.editData = function(uuid) {
                    var editUrl = "{{ route('customers.edit', ':uuid') }}";
                    var updateUrl = "{{ route('customers.update', ':uuid') }}";
                    editUrl = editUrl.replace(':uuid', uuid);
                    updateUrl = updateUrl.replace(':uuid', uuid);
                    const form = document.getElementById("editForm");
                    form.setAttribute("action", updateUrl);

                    $.ajax({
                        url: editUrl,
                        type: "GET",
                        data:{}, //id:rowId
                        success: function (data) {
                            console.log('------customer', data)
                            $('#name').val(data.name);
                            $('#phone').val(data.phone);
                            $('#contact_person').val(data.contact_person);
                            $('#dob').val(data.dob);
                            $('#deposit_amt').val(data.deposit_amount);
                            $('#email').val(data.email);
                            $('#address').val(data.address);
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
                    ajax: "{{ route('customers.index') }}",
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
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'contact_person',
                            name: 'contact_person'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'address',
                            name: 'address'
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
                $('#myTable').show();

            });
        </script>
        @endsection
    </x-content>
</x-layout>