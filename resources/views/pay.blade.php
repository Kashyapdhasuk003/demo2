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

    /* Table Styles */
    .table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
    }

    .table th {
        background-color: #34495e;
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

    /* Buttons */
    .btn {
        margin: 0 2px;
    }

    .btn-primary,
    .btn-danger {
        font-size: 14px;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="mt-5">
            <h3>City Information</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Due Payment</th>
                            <th>Date</th>
                            <th>Received</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $city)
                        <tr id="client-row-{{$city->id}}">
                            <td>{{ $city->id }}</td>
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->city }}</td>
                            <td>{{ $city->phone }}</td>
                            <td>{{ $city->due_payment }}</td>
                            <td>{{ $city->date }}</td>
                            <td>{{ $city->received_payment }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $city->id }}" data-received="{{ $city->received_payment }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $city->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                               <a href="{{url('pdf')}}/{{$city->id}}">click</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Received Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="clientId">
                    <div class="form-group">
                        <label for="receivedPayment">Received Payment</label>
                        <input type="number" id="receivedPayment" class="form-control" required>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group d-flex align-items-center mb-3">
          <label for="input1" class="me-2">Created</label>
          <input type="text" class="form-control me-2" id="input1" placeholder="{{$city->created_by}}" readonly>
          <input type="text" class="form-control" id="input2" placeholder="{{$city->created_at}}" readonly>
        </div>
        <div class="form-group d-flex align-items-center">
          <label for="input3" class="me-2">Updated</label>
          <input type="text" class="form-control me-2" id="input3" placeholder="{{$city->updated_by}}" readonly>
          <input type="text" class="form-control" id="input4" placeholder="{{$city->updated_at}}" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        // Edit button click handler
        $(document).on('click', '.edit-btn', function () {
            const clientId = $(this).data('id');
            const receivedPayment = $(this).data('received');
            $('#clientId').val(clientId);
            $('#receivedPayment').val(receivedPayment);
            $('#editModal').modal('show');
        });

        // Edit form submission handler
        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            const clientId = $('#clientId').val();
            const receivedPayment = $('#receivedPayment').val();

            $.ajax({
                url: `/pay_update/${clientId}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    received_payment: receivedPayment
                },
                success: function (response) {
                    $('#editModal').modal('hide');
                    $(`#client-row-${clientId} td:nth-child(7)`).text(receivedPayment);
                    alert('Received payment updated successfully.');
                    location.reload();
                },
                error: function () {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-btn', function () {
            const clientId = $(this).data('id');
            if (confirm('Are you sure you want to delete this client?')) {
                $.ajax({
                    url: `/pay_delete/${clientId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $(`#client-row-${clientId}`).remove();
                        alert('Client deleted successfully.');
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });
      

    });
</script>
@endsection
