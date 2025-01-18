@extends('s_admin') 

@section('content')
<div class="card">
  <div class="card-body">
 
<div class="container mt-5">
    <h2 class="mb-4">Payment Form</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('payment_data') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <select id="client_name" name="client_name" class="form-select" required>
                <option value="" disabled selected>Select a client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->name }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City Name</label>
            <input type="text" id="city" class="form-control" name="city" readonly>
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile Number</label>
            <input type="text" id="mobile" class="form-control" name="mobile" readonly>
        </div>

        <div class="mb-3">
            <label for="due_payment" class="form-label">Due Payment</label>
            <input type="text" id="due_payment" class="form-control" name="due_payment" readonly>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="received_payment" class="form-label">Received Payment</label>
            <input type="number" id="received_payment" name="received_payment" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
</div>
</div>
<script>
    const clients = @json($clients);

    document.getElementById('client_name').addEventListener('change', function() {
        const client = clients.find(c => c.name === this.value);

        document.getElementById('city').value = client?.city || '';
        document.getElementById('mobile').value = client?.Mo_Number || '';
        document.getElementById('due_payment').value = client?.due_payment || '';
    });
</script>

<style>
    /* Container and card styling */
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 25px;
    }

    h2 {
        font-size: 30px;
        color: #343a40;
        font-weight: 600;
        margin-bottom: 30px;
    }

    /* Form labels */
    .form-label {
        font-size: 15px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
    }

    /* Form inputs and select */
    .form-select, .form-control {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #ced4da;
        height: 45px;
        padding-left: 15px;
        font-size: 16px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        outline: none;
    }

    /* Button */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 8px;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-3px);
    }

    /* Success alert */
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 20px;
        margin-bottom: 25px;
        border-radius: 10px;
        font-size: 16px;
        transition: opacity 0.3s ease;
    }

    .alert-success.hide {
        opacity: 0;
        visibility: hidden;
    }

    /* Margin spacing */
    .mb-3 {
        margin-bottom: 25px;
    }

    /* Input fields focus effect */
    .form-select:focus, .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
    }

</style>

@endsection
