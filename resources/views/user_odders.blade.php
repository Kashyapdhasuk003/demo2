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
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Total hours</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $city)
                    <td>{{$city->product_type}}</td>
                    <td>{{$city->price}}</td>
                    <td>{{$city->date}}</td>
                    <td>{{$city->total_hours}}</td>
                    <td>{{$city->total_amount}}</td>
                    <td>
                    <a href="{{url('pdf_bills')}}/{{$city->id}}" class="btn btn-sm btn-success delete-btn">
                    <i class="fas fa-download"></i>Download</a>
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


@endsection
