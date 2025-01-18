@extends('s_admin')
@section('content')
<style>
    /* General Page Styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        color: #2c3e50;
        transition: background-color 0.3s ease;
    }

    .card {
        margin: 20px auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
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
        transition: background-color 0.3s ease;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Add Button */
    #bn {
        display: inline-block;
        margin: 10px 0;
        padding: 10px 20px;
        margin-left: 80%;
        background-color: rgb(17, 89, 178);
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    #bn:hover {
        background-color: #218838;
        transform: scale(1.05);
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

    /* Modal Transitions */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.fade.in .modal-dialog {
        transform: translate(0, 0);
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="mt-5">
            <h3>Client Information</h3>
            <button type="submit" id="bn" data-toggle="modal" data-target="#form3">+ Add Product</button>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $city)
                        <tr id="client-row-{{$city->id}}">
                            <td>{{$city->id}}</td>
                            <td class="client-name">{{$city->product_name}}</td>
                            <td class="client-number">{{$city->product_price}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-btn" 
                                        data-id="{{$city->id}}" 
                                        data-name="{{$city->product_name}}" 
                                        data-number="{{$city->product_price}}">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-client-id" name="id">
                    <div class="form-group">
                        <label for="edit-name">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-number">Price</label>
                        <input type="text" class="form-control" id="edit-number" name="product_price" required>
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

<!-- Add Product Modal -->
<div class="modal fade" id="form3" tabindex="-1" role="dialog" aria-labelledby="form3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form3">Enter Product Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('product')}}" method="POST" id="addProductForm">
                    @csrf
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="text" class="form-control" id="product_price" name="product_price" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="addProductForm" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // Edit Product
        $(document).on('click', '.edit-btn', function () {
            const clientId = $(this).data('id');
            const name = $(this).data('name');
            const number = $(this).data('number');
            
            $('#edit-client-id').val(clientId);
            $('#edit-name').val(name);
            $('#edit-number').val(number);

            $('#editModal').modal('show');
        });

        // Edit Product Form Submit
        $('#edit-client-form').on('submit', function (e) {
            e.preventDefault();
            const clientId = $('#edit-client-id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: `/product_edit/${clientId}`,
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function () {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        // Delete Product
        $(document).on('click', '.delete-btn', function () {
            const clientId = $(this).data('id');
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: `/product_delete/${clientId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $(`#client-row-${clientId}`).fadeOut('slow');
                        alert('Product deleted successfully.');
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });

        // Add Product Form Submit
        $('#addProductForm').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{url('product')}}",
                data: $('#addProductForm').serialize(),
                type: 'POST',
                success: function () {
                    $('#addProductForm')[0].reset();
                    $('#form3').modal('hide');
                    location.reload();
                },
                error: function () {
                    alert('Error occurred while adding product.');
                }
            });
        });

    });
</script>
@endsection
