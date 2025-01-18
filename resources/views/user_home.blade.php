@extends('user_panel')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">


<style>
   body {
       font-family: 'Roboto', sans-serif;
   }

   .card-counter {
       box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
       margin: 10px;
       padding: 25px 15px;
       background: linear-gradient(135deg, #f0f0f0, #ffffff);
       height: 120px;
       border-radius: 12px;
       position: relative;
       overflow: hidden;
       transition: all 0.3s ease-in-out;
   }

   .card-counter:hover {
       transform: scale(1.05);
       box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
   }

   .card-counter.primary {
       background: linear-gradient(135deg, #5c6bc0, #3f51b5);
       color: white;
   }

   .card-counter.danger {
       background: linear-gradient(135deg, #e57373, #f44336);
       color: white;
   }

   .card-counter.success {
       background: linear-gradient(135deg, #81c784, #66bb6a);
       color: white;
   }

   .card-counter.info {
       background: linear-gradient(135deg, #26c6da, #00acc1);
       color: white;
   }

   .card-counter i {
       font-size: 4em;
       opacity: 0.8;
       transition: all 0.3s ease-in-out;
   }

   .card-counter:hover i {
       opacity: 1;
   }

   .card-counter .count-numbers {
       position: absolute;
       top: 20px;
       right: 35px;
       font-size: 36px;
       font-weight: bold;
   }

   .card-counter .count-name {
       position: absolute;
       top: 65px;
       right: 35px;
       font-size: 18px;
       font-style: italic;
       text-transform: uppercase;
       opacity: 0.7;
   }

   .chart-container {
       margin-top: 30px;
       margin-bottom: 30px;
       width: 100%;
       height: 400px;
   }
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />


<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card-counter primary">
                <i class="fa fa-city"></i>
                <span class="count-numbers"> ₹{{$due_payment}}</span>
                <span class="count-name">Due payment</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-counter success">
                <i class="fas fa-cogs"></i>
                <span class="count-numbers"> ₹{{$payed}}</span>
                <span class="count-name">Payed</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-counter info">
                <i class="fa fa-users-cog"></i>
                <span class="count-numbers">{{$odder}}</span>
                <span class="count-name">Odders</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="chart-container">
                <canvas id="donutChart"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endsection
