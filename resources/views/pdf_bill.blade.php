<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .receipt-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-header h1 {
            margin: 0;
            font-size: 20px;
        }
        .receipt-header p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        .receipt-details, .receipt-summary {
            margin-bottom: 20px;
        }
        .receipt-details h3, .receipt-summary h3 {
            margin: 0 0 10px;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .receipt-details table, .receipt-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-details table th, .receipt-details table td,
        .receipt-summary table th, .receipt-summary table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .receipt-total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h1>Store Name</h1>
            <p>City:-{{$city}}</p>
            <p>Phone:{{$phone}}</p>
        </div>

        <div class="receipt-details">
            <h3>Customer Details</h3>
            <table>
                <tr>
                    <th>Name:</th>
                    <td>{{$name}}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{$date}}</td>
                </tr>
                
            </table>
        </div>

        <div class="receipt-summary">
            <h3>Order Summary</h3>
            <table>
                <thead>
                    <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Hours</th>
                    <th>Amount</th>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$product}}</td>
                        <td>{{$price}}</td>
                        <td>{{$hours}}</td>
                        <td>{{$amount}}</td>
                    </tr>
                   
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
        </div>
    </div>
</body>
</html>
