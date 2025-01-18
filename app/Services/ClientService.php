<?php

namespace App\Services;

use App\Models\City;
use App\Models\Client;
use App\Models\Product;
use App\Models\register;
use App\Models\ClientBill;
use App\Models\User;
use App\Models\Payment;
use App\Repository\ClientRepo;


class ClientService implements ClientRepo
{
    public function createCity(array $data)
    {
        
        return City::create($data);
    }

      public function createClient(array $data)
      {
        return Client::create([
          'name' => $data['name'],
          'city' => $data['city'],
          'Mo_Number' => $data['number'],

        ]);
      }

      public function getCity()
      {
        return City::all();
      }
    
      public function createProduct(array $data)
      {
        return Product::create([
          'product_name' => $data['product_name'],
          'product_price' => $data['product_price'],
        ]);

}

  public function getClient()
  {
    return Client::all();
  }
  public function get_Client()
  {
    return Client::all();
  }
  public function get_City()
  {
    return City::all();
  }

  public function getProducts()
  {
    return Product::all();
  }

  public function register(array $data)
  {
    return register::create([
      'companyname'=>$data['companyname'],
      'name' => $data['name'],
      'email'=>$data['email'],
      'phonenumber'=>$data['phonenumber'],
      'distric'=>$data['distric'],
      'taluka'=>$data['taluka'],
      'city' => $data['city'],
      'address'=>$data['address'],
      'password'=>$data['password'],
    ]);
       
    
  }

  public function get_data()
  {
    return register::all();
  }

  public function find_city($city)
  {
    return register::where('city', $city)->get();
    
  }

  public function find_client($client)
  {
    return register::where('name', $client)->get();
  }

  public function get_info($id)
  {
    return register::find($id);
  }

  public function get_bills($name)
  {
    return ClientBill::where('user_name',$name)->get();
  }
 
  public function home_city()
  {
    return City::count();
  }
  public function home_product()
  {
    return Product::count();
  }
  public function home_users()
  {
    return register::count();
  }

  public function get_payment(array $data)
{
  
    $email = session('s_admin_email');
  
    $row = User::where('email', $email)->first();

    $num = $data['due_payment'] - $data['received_payment'];

    // Create a new payment record
    $pay= Payment::create([
        'name' => $data['client_name'],
        'city' => $data['city'],
        'phone' => $data['mobile'],
        'due_payment' =>$num,
        'date' => $data['date'],
        'received_payment' => $data['received_payment'],
        'created_by' => $row->name,
    ]);
     
    Client::where('name', $data['client_name'],)
    ->update(['due_payment' => $num]);

    return $pay;
}


public function get_pay()
{
  return Payment::all();
}

public function user_due_paymeent()
{
          $email = session('user_email');
          $row= User::where('email', $email)->first();
          $name=$row->name;
          $due_payment=Client::where('name', $name)->first()->due_payment;
     return $due_payment;
}
    public function user_payed()
    {
      $email = session('user_email');
          $row= User::where('email', $email)->first();
          $name=$row->name;
      return Payment::where('name', $name)->sum('received_payment');
    }
    public function user_odder()
    {
      $email = session('user_email');
      $row= User::where('email', $email)->first();
      $name=$row->name;
       return ClientBill::where('user_name', $name)->count('user_name');
    }
    public function get_user_odder()
    {
      $email = session('user_email');
      $row= User::where('email', $email)->first();
      $name=$row->name;
       return ClientBill::where('user_name', $name)->get();
    }
    public function get_user_pay()
    {
      $email = session('user_email');
      $row= User::where('email', $email)->first();
      $name=$row->name;
      return Payment::where('name', $name)->get();

    }
}
