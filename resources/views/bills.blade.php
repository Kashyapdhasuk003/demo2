@extends('s_admin')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #form-table {
            width: 100%;
        }
        .container-full {
            width: 100%;
            padding: 0;
        }
        .result-table {
            margin-top: 20px;
        }
    </style>
<div class="card">
    <div class="card-body">
        <div class="container-full mt-4">
            <h2 class="text-center">Client</h2>
            <form id="billForm" method="post" action="{{ url('/clint_data') }}">
                @csrf
                <div class="mb-3">
                    <label for="user" class="form-label">Select User</label>
                    <select id="user" name="user" class="form-select">
                        <option value="">Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" id="city" class="form-control" name="city" readonly>
                </div>
                <div class="mb-3">
                    <label for="Mo_Number" class="form-label">Number</label>
                    <input type="text" id="Mo_Number" class="form-control" name="Mo_Number" readonly>
                </div>
                <table class="table table-bordered" id="form-table">
                    <thead>
                        <tr>
                            <th>Product Type</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Total Hours</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="billRows">
                        <tr>
                            <td>
                                <select name="std[0][product_type]" class="form-select product-type">
                                    <option value="">Select a product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="std[0][price]" class="form-control price" placeholder="Price" ></td>
                            <td><input type="date" name="std[0][date]" class="form-control date" value="{{ now()->format('Y-m-d') }}"></td>
                            <td><input type="time" name="std[0][start_time]" class="form-control start-time"></td>
                            <td><input type="time" name="std[0][end_time]" class="form-control end-time"></td>
                            <td><input type="text" name="std[0][total_hours]" class="form-control total-hours" placeholder="Total Hours" readonly></td>
                            <td><input type="text" name="std[0][total_amount]" class="form-control total-amount" placeholder="Total Amount" readonly></td>
                            <td><button type="button" class="btn btn-success add-row">+</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let index = 1;

    // Add new row
    $('#billRows').on('click', '.add-row', function () {
        const newRow = $('#billRows tr:first').clone();
        newRow.find('input, select').each(function () {
            const input = $(this);
            const name = input.attr('name');
            input.attr('name', name.replace(/\d+/, index));
            input.val(''); // Clear all input fields
        });

        // Set current date for the new row's date field
        newRow.find('input[name*="date"]').val('{{ now()->format('Y-m-d') }}');
        
        newRow.find('.add-row').removeClass('add-row').addClass('remove-row').text('-');
        $('#billRows').append(newRow);
        index++;
    });

    // Remove row
    $('#billRows').on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
    });

    // Fetch product price when product type is selected
    $('#billRows').on('change', '.product-type', function () {
        const row = $(this).closest('tr');
        const productName = $(this).val();

        if (productName) {
            $.ajax({
                url: `/get-product-data-by-name/${productName}`,
                type: 'GET',
                success: function (data) {
                    row.find('.price').val(data.price);
                    row.find('.total-hours').val('');
                    row.find('.total-amount').val('');
                },
                error: function () {
                    alert('Failed to fetch product data.');
                },
            });
        } else {
            row.find('.price').val('');
        }
    });

    // Calculate total hours and total amount
    $('#billRows').on('input', '.start-time, .end-time, .price', function () {
        const row = $(this).closest('tr');
        const startTime = row.find('.start-time').val();
        const endTime = row.find('.end-time').val();
        const price = parseFloat(row.find('.price').val()) || 0;

        if (startTime && endTime && validateTime(startTime, endTime)) {
            const totalHours = calculateTimeDifference(startTime, endTime);
            const totalAmount = totalHours * price;

            row.find('.total-hours').val(totalHours.toFixed(2));
            row.find('.total-amount').val(totalAmount.toFixed(2));
        } else {
            row.find('.total-hours').val('');
            row.find('.total-amount').val('');
        }
    });

    // Function to calculate time difference in hours
    function calculateTimeDifference(startTime, endTime) {
        const [startHours, startMinutes] = startTime.split(':').map(Number);
        const [endHours, endMinutes] = endTime.split(':').map(Number);
        const start = startHours + startMinutes / 60;
        const end = endHours + endMinutes / 60;
        return end - start;
    }

    // Validate that start time is before end time
    function validateTime(startTime, endTime) {
        const [startHours, startMinutes] = startTime.split(':').map(Number);
        const [endHours, endMinutes] = endTime.split(':').map(Number);
        const start = startHours * 60 + startMinutes;
        const end = endHours * 60 + endMinutes;
        return end > start;
    }

    // Fetch user data for city and mobile number
    $('#user').change(function () {
        const username = $(this).val();
        if (username) {
            $.ajax({
                url: `/get-user-data/${username}`,
                type: 'GET',
                success: function (data) {
                    $('#city').val(data.city);
                    $('#Mo_Number').val(data.Mo_Number);
                },
                error: function () {
                    alert('Failed to fetch user data.');
                },
            });
        } else {
            $('#city').val('');
            $('#Mo_Number').val('');
        }
    });
});
</script>

@endsection
