@extends('s_admin')
@section('content')
<style>
    /* General Page Styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #2c3e50;
    }

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

    
    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    .table th {
        background-color:#34495e;
        color: #fff;
        text-align: center;
        padding: 12px;
        border: 1px solid #ddd;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        border: 1px solid #ddd;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    /* Add Button */
    #bn {
        display: inline-block;
        margin: 10px 0;
        padding: 10px 20px;
        margin-left:80%;
        background-color:rgb(17, 89, 178);
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #bn:hover {
        background-color: #218838;
    }

    /* Smooth Modal Transitions */
    .modal.fade {
        transition: opacity 0.5s ease;
    }

    /* Responsive Table */
    .table-responsive {
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        #bn {
            margin: 10px auto;
            display: block;
        }
    }

    #client{
        text-decoration: none;
        color:black;
    }
    #client:hover{
        color:blue;
    }

    /* Toast Notification */
    .toast {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .toast.show {
        opacity: 1;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="mt-5">
            <h3>Client Information</h3>
            <button type="submit" id="bn" data-toggle="modal" data-target="#form2">+ Add Client</button>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $city)
                        <tr id="client-row-{{$city->id}}">
                            <td>{{$city->id}}</td>
                            <td class="client-name"><a href="{{URL::to('/')}}/findclient/{{$city->name}}" id="client">{{$city->name}}</a></td>
                            <td class="client-number">{{$city->Mo_Number}}</td>
                            <td class="client-city">{{$city->city}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" 
                                        data-id="{{$city->id}}" 
                                        data-name="{{$city->name}}" 
                                        data-number="{{$city->Mo_Number}}" 
                                        data-city="{{$city->city}}">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-client-id" name="id">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-number">Number</label>
                        <input type="text" class="form-control" id="edit-number" name="Mo_Number" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-city">City</label>
                        <input type="text" class="form-control" id="edit-city" name="city" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Client Modal -->
<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="form2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form2">Enter Client Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('client')}}" method="post" id="addClientForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Client Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City Name</label>
                        <select id="city" name="city" class="form-control" required>
                            <option value="">Select City</option>
                            @foreach($v as $row)
                            <option value="{{$row->city}}">{{$row->city}}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#form1">Add City</button>
                    </div>
                    <div class="form-group">
                        <label for="number">Mobile Number</label>
                        <input type="text" class="form-control" id="number" name="number" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
                </form>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast" id="toast"></div>

<script>
    $(document).ready(function () {

        // Edit Client Button Click
        $(document).on('click', '.edit-btn', function () {
            const clientId = $(this).data('id');
            const name = $(this).data('name');
            const number = $(this).data('number');
            const city = $(this).data('city');

            $('#edit-client-id').val(clientId);
            $('#edit-name').val(name);
            $('#edit-number').val(number);
            $('#edit-city').val(city);

            $('#editModal').modal('show');
        });

        // Edit Client Form Submit
        $('#edit-client-form').on('submit', function (e) {
            e.preventDefault();
            const clientId = $('#edit-client-id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: `/clients/${clientId}`,
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#editModal').modal('hide');
                    showToast('Client updated successfully!');
                    location.reload();
                },
                error: function () {
                    showToast('Something went wrong. Please try again.', true);
                }
            });
        });

        // Delete Client Button Click
        $(document).on('click', '.delete-btn', function () {
            const clientId = $(this).data('id');
            if (confirm('Are you sure you want to delete this client?')) {
                $.ajax({
                    url: `/clients_delete/${clientId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        $(`#client-row-${clientId}`).remove();
                        showToast('Client deleted successfully!');
                    },
                    error: function () {
                        showToast('Something went wrong. Please try again.', true);
                    }
                });
            }
        });

        // Add Client Form Submit
        $('#addClientForm').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{url('client')}}",
                data: $('#addClientForm').serialize(),
                type: 'POST',
                success: function () {
                    $('#addClientForm')[0].reset();
                    showToast('Client added successfully!');
                    location.reload();
                },
                error: function () {
                    showToast('Error occurred while adding client.', true);
                }
            });
        });

        // Show Toast Notification
        function showToast(message, isError = false) {
            const toast = $('#toast');
            toast.text(message);
            toast.removeClass('show');
            if (isError) toast.addClass('bg-danger');
            else toast.removeClass('bg-danger').addClass('bg-success');
            toast.addClass('show');
            setTimeout(() => toast.removeClass('show'), 3000);
        }
    });
</script>

@endsection
