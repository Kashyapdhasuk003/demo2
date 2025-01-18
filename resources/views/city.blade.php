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
        margin-left:90%;
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
    #city{
        text-decoration: none;
        color:black;
    }
    #city:hover{
        color:blue;
    }
</style>
<div class="card">
  <div class="card-body">
 
<div class="mt-5">
    <h3>City Information</h3>
    
        <button type="submit" id="bn" data-toggle="modal" data-target="#form1">+ Add City</button>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $city)
                <tr id="client-row-{{$city->id}}">
                    <td> {{$city->id}} </a></td>
                    <td>
                    <a href="{{url('findcity')}}/{{ $city->city }}" id="city"> {{ $city->city }}</a>
                    </td>

                    <td>
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
<div>
</div>
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
<script>
    $(document).ready(function () {

        $('#addCityForm').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: "{{url('city')}}",
        data: $('#addCityForm').serialize(),
        type: 'POST',
        success: function (result) {
            $('#addCityForm')[0].reset();
            $('#dataContainer').html(`<p>${result.message}</p>`);  // Note: Ensure 'result' is used, not 'response'
            location.reload();  // This will reload the page after a successful request
        },
        error: function (xhr, status, error) {
            console.error("Error: ", error);
        }
    });
});



        $(document).on('click', '.delete-btn', function () {
    const clientId = $(this).data('id');
    if (confirm('Are you sure you want to delete this client?')) {
        $.ajax({
            url: `/city_delete/${clientId}`,  
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
