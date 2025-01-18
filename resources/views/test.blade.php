<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar and Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

    <style>
    /* Sidebar styles */
    .sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        background: linear-gradient(135deg, #2c3e50, #1a252f);
        padding-top: 20px;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.7);
        transition: all 0.3s ease-in-out;
    }

    .sidebar img {
        display: block;
        margin: 0 auto;
        padding:;
        width: 60px; /* Adjust the size of your logo */
        margin: 0 auto 30px; /* Center the logo and add some space below */
    }

    .sidebar a {
        display: block;
        color: #ecf0f1;
        text-decoration: none;
        padding: 15px 20px;
        font-size: 16px;
        border-left: 4px solid transparent;
        transition: all 0.3s;
        position: relative;
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #f1c40f;
        border-left: 4px solid #f1c40f;
        text-decoration: none;
        transform: translateX(5px);
    }

    .sidebar .active {
        background: rgba(255, 255, 255, 0.1);
        font-weight: bold;
        color: #f39c12;
        border-left: 4px solid #f39c12;
    }

    /* Sidebar header */
    .sidebar-header {
        font-size: 18px;
        color: #ecf0f1;
        text-transform: uppercase;
        font-weight: bold;
        padding: 15px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        background-color: #34495e;
    }

    /* Content area styles */
    .content {
        margin-left: 250px;
        padding: 20px;
        background-color: #ecf0f1;
        min-height: 100vh;
        transition: margin-left 0.3s ease-in-out;
    }

    .content h1 {
        color: #2c3e50;
    }

    /* Top navbar styles */
    .top-navbar {
        position: fixed;
        top: 0;
        left:17.5%;
        width: 82%;
        background: linear-gradient(135deg, #2c3e50, #1a252f);
        padding: 10px 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .top-navbar .navbar-brand {
        color: #ecf0f1;
        font-weight: bold;
        font-size: 22px;
    }

    .top-navbar .nav-link {
        color: #ecf0f1;
        padding: 8px 15px;
        font-size: 16px;
    }

    .top-navbar .nav-link:hover {
        color: #f1c40f;
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Dropdown Menu Styles */
    .top-navbar .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        background: linear-gradient(135deg, #2c3e50, #1a252f);
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .top-navbar .nav-item.dropdown .dropdown-toggle {
        color: #ecf0f1;
    }

    .top-navbar .nav-item.dropdown .dropdown-menu .dropdown-item {
        color: #ecf0f1;
        padding: 10px 15px;
        font-size: 16px;
        background-color: transparent;
        border-left: 4px solid transparent;
        transition: all 0.3s;
    }

    .top-navbar .nav-item.dropdown .dropdown-menu .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #f1c40f;
        border-left: 4px solid #f1c40f;
    }

    /* Profile image hover effect */
    .top-navbar .nav-item .nav-link img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        transition: transform 0.3s ease-in-out;
    }

    .top-navbar .nav-item .nav-link:hover img {
        transform: scale(1.1);
        cursor: pointer;
    }

    /* Body styles */
    body {
        overflow-x: hidden;
        font-family: 'Arial', sans-serif;
        background-color: #ecf0f1;
        color: #2c3e50;
        margin-top: 60px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            box-shadow: none;
            padding-top: 20px;
        }

        .content {
            margin-left: 0;
        }

        .top-navbar {
            padding: 10px;
        }
    }
</style>

</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark top-navbar">
        <a class="navbar-brand" href="#">My App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="https://via.placeholder.com/100" alt="Logo">
        <div class="sidebar-header">
            Navigation
        </div>
        <a href="#" class="active">Home</a>
        <a href="#" data-toggle="modal" data-target="#form1">Add City</a>
        <a href="#" data-toggle="modal" data-target="#form2">Add Client</a>
        <a href="#" data-toggle="modal" data-target="#form3">Add Product</a>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div class="container">
            
        </div>
    </div>




<!-- Modals -->
<!-- Add City Modal -->
<div class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="form1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form1">Enter City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('city')}}" method="POST" id="addCityForm">
                    @csrf
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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



 <!-- Modal 3 - Add City -->
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
                    <form action="{{url('product')}}" method="POST" id="addProductForm" >
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Price</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" required>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#addCityForm').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{url('city') }}",
                    data: $('#addCityForm').serialize(),
                    type: 'POST',
                    success: function (result) {
                        $('#addCityForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error: ", error);
                    }
                });
            });

            $('#addClientForm').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{url('client') }}",
                    data: $('#addClientForm').serialize(),
                    type: 'POST',
                    success: function (result) {
                        $('#addClientForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error: ", error);
                    }
                });
            });

            $('#addProductForm').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{url('product') }}",
                    data: $('#addProductForm').serialize(),
                    type: 'POST',
                    success: function (result) {
                        $('#addProductForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error: ", error);
                    }
                });
            });
        });
    </script>
</body>
</html>


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