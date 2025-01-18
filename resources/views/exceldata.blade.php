@extends('s_admin')

@section('content')
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

   <script>
   $(document).ready(function() {
    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        pageLength: 10,
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'Billing Summary',
                messageTop: 'Generated on: ' + new Date().toLocaleDateString(),
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

    $('#rowLimit').on('change', function() {
        var value = $(this).val();
        table.page.len(value).draw();
    });
});

    </script> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
