@extends('user_panel')
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
                            <td>{{ $city->name }}</td>
                            <td>{{ $city->city }}</td>
                            <td>{{ $city->phone }}</td>
                            <td>{{ $city->due_payment }}</td>
                            <td>{{ $city->date }}</td>
                            <td>{{ $city->received_payment }}</td>
                            <td>
                            <a href="{{url('pdf')}}/{{$city->id}}" class="btn btn-sm btn-success delete-btn">
                            <i class="fas fa-download"></i>Download</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
