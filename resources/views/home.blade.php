@extends('s_admin')

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
                <span class="count-numbers">{{$city}}</span>
                <span class="count-name">City</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-counter success">
                <i class="fas fa-cogs"></i>
                <span class="count-numbers">{{$product}}</span>
                <span class="count-name">Product</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-counter info">
                <i class="fa fa-users-cog"></i>
                <span class="count-numbers">{{$users}}</span>
                <span class="count-name">Users</span>
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
<script>
    
    var ctx1 = document.getElementById('donutChart').getContext('2d');
    var donutChart = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['City', 'Product', 'Users'],
            datasets: [{
                label: 'Metrics',
                data: [{{$city}}, {{$product}}, {{$users}}],
                backgroundColor: ['#5c6bc0', '#81c784', '#26c6da'],
                borderColor: ['#3f51b5', '#66bb6a', '#00acc1'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#f8f9fa',
                    bodyColor: '#495057',
                    borderColor: '#007bff',
                    borderWidth: 1
                }
            }
        }
    });

  
    var ctx2 = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['City', 'Product', 'Users'],
            datasets: [{
                label: 'Metrics',
                data: [{{$city}}, {{$product}}, {{$users}}],
                backgroundColor: ['#5c6bc0', '#81c784', '#26c6da'],
                borderColor: ['#3f51b5', '#66bb6a', '#00acc1'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 1000
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#f8f9fa',
                    bodyColor: '#495057',
                    borderColor: '#007bff',
                    borderWidth: 1
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
        }
    });
</script>

@endsection
