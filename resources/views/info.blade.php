@extends('s_admin')

@section('content')

<!-- Include external CSS and JS libraries -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<div class="card">
  <div class="card-body">
    <!-- Tabs navigation -->
    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active tab-hover" id="ex1-tab-1" data-bs-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Profile</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link tab-hover" id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Tab 2</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link tab-hover" id="ex1-tab-3" data-bs-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Tab 3</a>
      </li>
    </ul>
    
    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
      <!-- Profile Tab -->
      <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Company Name</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="company-name">{{$clients->companyname}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Full Name</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="client-name">{{$clients->name}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Email Id</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="email">{{$clients->email}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Mobile</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="phone">{{$clients->phonenumber}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">District</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="district">{{$clients->distric}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Taluka</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="taluka">{{$clients->taluka}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">City</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="city">{{$clients->city}}</p></div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4"><p class="mb-0 font-weight-bold">Address</p></div>
                <div class="col-sm-8"><p class="text-muted mb-0" id="address">{{$clients->address}}</p></div>
              </div>
              <button class="btn btn-sm btn-primary edit-btn shadow-hover"
                      data-id="{{$clients->id}}"
                      data-companyname="{{$clients->companyname}}"
                      data-name="{{$clients->name}}"
                      data-email="{{$clients->email}}"
                      data-phone="{{$clients->phonenumber}}"
                      data-address="{{$clients->address}}"
                      data-city="{{$clients->city}}"
                      data-distric="{{$clients->distric}}"
                      data-taluka="{{$clients->taluka}}">
                <i class="fas fa-edit"></i> Edit
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tab 2 -->
      <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
      <div class="card">
        <div class="card-body">
            <div class="container mt-5">
                <h1 class="text-center mb-4">Billing Summary</h1>
                <div class="d-flex justify-content-end mb-3">
                    <label for="rowLimit">Rows</label>
                    <select id="rowLimit" class="form-select ml-2" style="width: 150px;">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="-1">All</option>
                    </select>
                </div>
                <table id="example" class="table table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Hours</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>{{ $bill->product_type }}</td>
                                <td>{{ $bill->date }}</td>
                                <td>{{ $bill->total_hours }}</td>
                                <td>{{ $bill->price }}</td>
                                <td>{{ $bill->total_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total:</th>
                            <th id="totalAmount" class="text-end"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
      </div>

      <!-- Tab 3 -->
      <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
        Tab 3 content
      </div>
    </div>
    <!-- Tabs content -->
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

<!-- Add custom styles for smooth transitions -->
<style>
  .tab-hover:hover {
    background-color: #f8f9fa;
    color: #007bff;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  .shadow-hover {
    transition: box-shadow 0.3s ease-in-out;
  }

  .shadow-hover:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .font-weight-bold {
    font-weight: 600;
  }

  .modal-content {
    transition: transform 0.3s ease-out;
  }

  .modal-content.show {
    transform: translateY(0);
  }

  body {
    background-color: #f8f9fa;
  }

  .dt-button {
    background-color: #34495e !important;
    color: #ecf0f1 !important;
    border: none;
    padding: 10px 15px;
    margin-right: 5px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .dt-button:hover {
    background-color: #2c3e50 !important;
  }

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
    transition: background-color 0.3s ease;
  }

  .table td {
    text-align: center;
    vertical-align: middle;
    padding: 10px;
  }

  .table tr:hover {
    background-color: #f2f2f2;
    color: #2c3e50;
    transition: background-color 0.3s ease, color 0.3s ease;
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
  <style>
  /* Base styles for nav-tabs */
  .nav-tabs .nav-link {
    color: #007bff; /* Default text color */
    background-color: transparent; /* Transparent background */
    border: 1px solid transparent; /* No visible border by default */
    border-radius: 0.5rem; /* Rounded corners for better aesthetics */
    transition: all 0.4s ease; /* Smoother and slower transitions */
  }

  /* Hover effect for tabs */
  .nav-tabs .nav-link:hover {
    background-color: #f1f3f5; /* Light background on hover */
    color: #0056b3; /* Darker blue text for hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    border-color: #dee2e6; /* Light gray border on hover */
    transform: translateY(-2px); /* Slight upward movement on hover */
  }

  /* Active tab styling */
  .nav-tabs .nav-link.active {
    color: #fff; /* White text for active tab */
    background-color: #34495e !important; /* Primary blue background */
    border-color:#34495e !important; /* Match border to background */
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4); /* Glow effect for active tab */
    transform: translateY(0); /* No hover movement for active tab */
  }

  /* Focused tab styling for accessibility */
  .nav-tabs .nav-link:focus {
    outline: none; /* Remove default outline */
    box-shadow: 0 0 0 4px rgba(7, 41, 77, 0.25); /* Focus ring for accessibility */
  }
</style>

<!-- Add Bootstrap 5 JS script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    // Initialize DataTable
    var table = $('#example').DataTable({
    dom: 'Bfrtip',
    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    pageLength: 10,
    buttons: [
        {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            title: '{{$clients->companyname}}',
            messageTop: 'Name: {{$clients->name}} - ' + new Date().toLocaleDateString(),
            messageBottom: 'Thank you for choosing {{$clients->companyname}}!',
            footer: true
        }
    ],
    drawCallback: function() {
        var api = this.api();
        // Calculate total for the "Amount" column
        var total = api
            .column(4, { page: 'current' }) // 4th column for "Amount"
            .data()
            .reduce(function(a, b) {
                return parseFloat(a) + parseFloat(b.replace(/[^0-9.-]+/g, '') || 0);
            }, 0);

        // Update the footer with the total
        $('#totalAmount').text(total.toFixed(2));
    }
});

// Change the row limit dynamically
$('#rowLimit').on('change', function() {
    var value = $(this).val();
    table.page.len(value).draw();
});

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
        success: function (response) {
          $('#editModal').modal('hide');
          location.reload();
        },
        error: function (response) {
          alert('Error saving changes.');
        }
      });
    });
  });
</script>

@endsection
