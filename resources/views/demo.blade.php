<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

    <style>
        /* Base Styles */
        body {
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
            background-color: #ecf0f1;
            color: #2c3e50;
            margin-top: 60px;
            transition: all 0.3s ease;
            scroll-behavior: smooth; /* Enable smooth scrolling */
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background: linear-gradient(135deg, #2c3e50, #1a252f);
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.7);
            transition: width 0.3s ease-in-out;
        }

        .sidebar img {
            display: block;
            margin: 0 auto 30px;
            width: 60px;
        }

        .sidebar-header {
            font-size: 18px;
            color: #ecf0f1;
            text-transform: uppercase;
            font-weight: bold;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            background-color: #34495e;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #ecf0f1;
            text-decoration: none;
            padding: 15px 20px;
            font-size: 16px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease, transform 0.3s ease;
            gap: 10px;
        }

        .sidebar a i {
            font-size: 20px;
            color: #bdc3c7;
            transition: color 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #f1c40f;
            border-left: 4px solid #f1c40f;
            transform: translateX(5px);
        }

        .sidebar a:hover i {
            color: #f1c40f;
        }

        .sidebar .active {
            background: rgba(255, 255, 255, 0.1);
            font-weight: bold;
            color: #f39c12;
            border-left: 4px solid #f39c12;
        }

        .sidebar .active i {
            color: #f39c12;
        }

        /* Navbar Styles */
        .top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
            background: linear-gradient(135deg, #2c3e50, #1a252f);
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
            transition: left 0.3s ease-in-out;
        }

        .top-navbar .navbar-brand {
            color: #ecf0f1;
            font-weight: bold;
            font-size: 22px;
        }

        .top-navbar .nav-link {
            color: #ecf0f1;
            padding: 8px 15px;
            font-size: 16px;
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        .top-navbar .nav-link:hover {
            color: #f1c40f;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .top-navbar .dropdown-menu {
            background: linear-gradient(135deg, #2c3e50, #1a252f);
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .top-navbar .dropdown-item {
            color: #ecf0f1;
            padding: 10px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .top-navbar .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #f1c40f;
        }

        .top-navbar .nav-item .nav-link img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            transition: transform 0.3s ease-in-out;
        }

        .top-navbar .nav-item .nav-link:hover img {
            transform: scale(1.1);
            cursor: pointer;
        }

        /* Content Area Styles */
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #ecf0f1;
            min-height: 100vh;
            transition: all 0.3s ease;
            padding-top: 60px; /* Space for navbar */
        }

        .content h1 {
            color: #2c3e50;
        }

        /* Content Area Fixed Positioning for Smaller Screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
                padding-top: 20px;
            }

            .content {
                margin-left: 0;
                padding-top: 80px; /* Space for navbar */
            }

            .top-navbar {
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark top-navbar">
<form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="home">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('logout')}}">Logout</a>
            </li>
            
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <img src="https://via.placeholder.com/100" alt="Logo">
    <div class="sidebar-header">Navigation</div>
    <a href="{{url('home')}}" class="active">
        <i class="fas fa-home"></i> Home
    </a>
    <a href="{{url('master')}}">
        <i class="fas fa-database"></i> Master
    </a>
    <a href="{{url('bills')}}">
        <i class="fas fa-file-invoice"></i> Bills
    </a>
    <a href="{{url('data')}}">
        <i class="fas fa-chart-line"></i> Data
    </a>
    
    <a href="{{url('payment')}}">
    <i class="fas fa-credit-card"></i>Payment
    </a>
</div>

<!-- Content Area -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
