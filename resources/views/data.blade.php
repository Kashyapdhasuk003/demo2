@extends('s_admin')
@section('content')
<style>
     .card {
        margin: 20px auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
       
    }

    .card-body {
        padding: 20px;
    }
    /* Table Styles */
    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    .table th {
        background-color: #34495e;
        color: #ecf0f1;
        text-align: center;
        padding: 12px;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
    }

    .table tr:hover {
        background-color: #f2f2f2;
        color: #2c3e50;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd;
    }

    @media (max-width: 768px) {
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }

    /* dropdown */

   /* Dropdown Styles */


/* Dropdown menu */


</style>
<div class="card">
  <div class="card-body">
 
<div class="mt-5">
    <h3>Client Information</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $city)
                <tr id="client-row-{{$city->id}}">
                    <td>
                    <div class="three-dot-menu">
        <i class="fas fa-ellipsis-h" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{url('info_data')}}/{{$city->id}}/{{$city->name}}">Info.</a>
            <a class="dropdown-item" href="#">menu1</a>
            <a class="dropdown-item" href="#">menu1</a>
        </div>
    </div>
                    </td>
                    <td>{{$city->companyname}}</td>
                    <td>{{$city->name}}</td>
                    <td>{{$city->email}}</td>
                    <td>{{$city->phonenumber}}</td>
                    <td>{{$city->address}}</td>
                    <td>{{$city->city}}</td>
                    <td>{{$city->distric}}</td>
                    <td>
                        <button class="btn btn-sm btn-primary edit-btn"
                                data-id="{{$city->id}}"
                                data-companyname="{{$city->companyname}}"
                                data-name="{{$city->name}}"
                                data-email="{{$city->email}}"
                                data-phone="{{$city->phonenumber}}"
                                data-address="{{$city->address}}"
                                data-city="{{$city->city}}"
                                data-distric="{{$city->distric}}"
                                data-taluka="{{$city->taluka}}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{$city->id}}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="edit-client-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-client-id" name="id">
                    <div class="form-group">
                        <label for="edit-companyname">Company Name</label>
                        <input type="text" class="form-control" id="edit-companyname" name="companyname" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-phone">Phone</label>
                        <input type="text" class="form-control" id="edit-phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-address">Address</label>
                        <input type="text" class="form-control" id="edit-address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-city">City</label>
                        <input type="text" class="form-control" id="edit-city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-distric">District</label>
                        <input type="text" class="form-control" id="edit-distric" name="distric" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-taluka">Taluka</label>
                        <input type="text" class="form-control" id="edit-taluka" name="taluka" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Populate Edit Modal
        $(document).on('click', '.edit-btn', function () {
            $('#edit-client-id').val($(this).data('id'));
            $('#edit-companyname').val($(this).data('companyname'));
            $('#edit-name').val($(this).data('name'));
            $('#edit-phone').val($(this).data('phone'));
            $('#edit-address').val($(this).data('address'));
            $('#edit-city').val($(this).data('city'));
            $('#edit-distric').val($(this).data('distric'));
            $('#edit-taluka').val($(this).data('taluka'));

            $('#editModal').modal('show');
        });

        // Submit Edit Form
        $('#edit-client-form').on('submit', function (e) {
            e.preventDefault();
            const clientId = $('#edit-client-id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: `/data_edit/${clientId}`,
                type: 'PUT',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: formData,
                success: function () {
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function () {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        // Delete Client
        $(document).on('click', '.delete-btn', function () {
            const clientId = $(this).data('id');
            if (confirm('Are you sure you want to delete this client?')) {
                $.ajax({
                    url: `/data_delete/${clientId}`,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function () {
                        $(`#client-row-${clientId}`).remove();
                        alert('Client deleted successfully.');
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });
                    
        const dropdownToggle = document.getElementById('dropdownToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');
    
    // Toggle dropdown visibility on click
    dropdownToggle.addEventListener('click', function() {
        const isVisible = dropdownMenu.style.display === 'block';
        
        // Toggle visibility
        dropdownMenu.style.display = isVisible ? 'none' : 'block';
    });
    
    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
    });
</script>
@endsection
