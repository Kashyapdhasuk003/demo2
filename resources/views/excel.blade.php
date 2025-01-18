<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="col-md-8">
        <h2 class="text-center">Bill Form</h2>
        <p id="currentDate" class="text-center text-muted"></p>
        <form>
            <table class="table table-bordered" id="billTable">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Starting Time</th>
                        <th>Ending Time</th>
                        <th>Total Hours</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="billRows">
                    <tr>
                        <td><input type="text" name="products[0][product_name]" class="form-control product-name" required></td>
                        <td><input type="number" name="products[0][price]" class="form-control price" required></td>
                        <td><input type="time" name="products[0][start_time]" class="form-control start-time" required></td>
                        <td><input type="time" name="products[0][end_time]" class="form-control end-time" required></td>
                        <td><input type="number" class="form-control total-hours" readonly></td>
                        <td><input type="number" class="form-control total-amount" readonly></td>
                        <td><input type="text" class="form-control date" readonly></td>
                        <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" id="addRow" class="btn btn-primary">Add Row</button>
            <hr>
            <div class="form-group">
                <label for="grandTotal"><b>Grand Total:</b></label>
                <input type="number" id="grandTotal" class="form-control" readonly>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set the current date
    const currentDateElement = document.getElementById('currentDate');
    const today = new Date().toLocaleDateString();
    currentDateElement.textContent = `Date: ${today}`;

    let rowIndex = 1;

    // Add new row
    document.getElementById('addRow').addEventListener('click', function() {
        let lastRow = document.querySelector('#billRows tr:last-child');

        let lastProductName = lastRow ? lastRow.querySelector('.product-name').value : '';
        let lastPrice = lastRow ? lastRow.querySelector('.price').value : '';
        let lastStartTime = lastRow ? lastRow.querySelector('.start-time').value : '';
        let lastEndTime = lastRow ? lastRow.querySelector('.end-time').value : '';

        let row = `<tr>
            <td><input type="text" name="products[${rowIndex}][product_name]" class="form-control product-name" value="${lastProductName}" required></td>
            <td><input type="number" name="products[${rowIndex}][price]" class="form-control price" value="${lastPrice}" required></td>
            <td><input type="time" name="products[${rowIndex}][start_time]" class="form-control start-time" value="${lastStartTime}" required></td>
            <td><input type="time" name="products[${rowIndex}][end_time]" class="form-control end-time" value="${lastEndTime}" required></td>
            <td><input type="number" class="form-control total-hours" readonly></td>
            <td><input type="number" class="form-control total-amount" readonly></td>
            <td><input type="text" class="form-control date" value="${today}" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>`;
        document.getElementById('billRows').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    });

    // Calculate total hours and amount dynamically
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('start-time') || event.target.classList.contains('end-time') || event.target.classList.contains('price')) {
            let row = event.target.closest('tr');
            let startTime = row.querySelector('.start-time').value;
            let endTime = row.querySelector('.end-time').value;
            let price = parseFloat(row.querySelector('.price').value) || 0;

            if (startTime && endTime) {
                let totalHours = calculateTimeDifference(startTime, endTime);
                row.querySelector('.total-hours').value = totalHours.toFixed(2);
                row.querySelector('.total-amount').value = (totalHours * price).toFixed(2);
            }

            calculateGrandTotal();
        }
    });

    // Remove row
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('removeRow')) {
            event.target.closest('tr').remove();
            calculateGrandTotal();
        }
    });

    // Calculate grand total
    function calculateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.total-amount').forEach(function(totalInput) {
            grandTotal += parseFloat(totalInput.value || 0);
        });
        document.getElementById('grandTotal').value = grandTotal.toFixed(2);
    }

    // Calculate time difference in hours
    function calculateTimeDifference(startTime, endTime) {
        let [startHours, startMinutes] = startTime.split(':').map(Number);
        let [endHours, endMinutes] = endTime.split(':').map(Number);

        let start = startHours + startMinutes / 60;
        let end = endHours + endMinutes / 60;

        return end - start > 0 ? end - start : 0; // Ensure no negative values
    }
});
</script>

</body>
</html>
