<?php
namespace App\Repository;

interface ClientRepo
{
    public function createCity(array $data);

    public function createClient(array $data);
    public function getCity();
    public function get_City();
    

    public function getClient();
    public function get_Client();
    
    public function createProduct(array $data);
    public function getProducts();

    public function register(array $data);
    public function get_data();

    public function find_city($city);
    public function find_client($client);
    
    public function get_info($id);
    public function get_bills($name);

    public function get_payment(array $data);

    public function home_city();
    public function home_product();
    public function home_users();
 
    public function get_pay();

    public function user_due_paymeent();
    public function user_payed();
    public function user_odder();
    public function get_user_odder();
    public function get_user_pay();

}