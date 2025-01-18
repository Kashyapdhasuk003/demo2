@extends('s_admin')
@section('content')
<style>
  .card-header {
    background-color: #34495e;
    color: white;
    font-size: 1.25rem;
    text-align: center;
    padding: 0.75rem 1rem;
    border-radius: 8px 8px 0 0;
  }

  .list-group {
    list-style: none;
    margin: 0;
    padding: 0;
    border-radius: 0 0 8px 8px;
  }

  .list-group a {
    display: block;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: #333;
    font-size: 1.15rem;
    transition: all 0.3s ease;
    border-bottom: 1px solid #ddd;
  }

  .list-group a:hover {
    color: #f39c12;
    background-color: #ecf0f1;
    transform: translateX(5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
</style>

<div class="card mt-4" style="width: 18rem;">
  <div class="card-header">
    Master
  </div>
  <ul class="list-group list-group-flush">
    <a href="{{url('city')}}">Add City</a>
    <a href="{{url('client')}}">Add Client</a>
    <a href="{{url('product')}}">Add Product</a>
    <a href="{{url('pay')}}">pay</a>
  </ul>
</div>
@endsection
