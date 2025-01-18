<?php

namespace App\Http\Controllers;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\YourDataExport; // Create this export class
use Yajra\DataTables\DataTables;
use App\Models\City;
use App\Models\ClientBill;
use App\Models\Product;
use App\Models\User;
use App\Models\Client;
use App\Models\register;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;


class taskCantroller extends Controller
{


    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }



    public function demo()
    {
        $clients = $this->clientService->getCity();
        $c1=$this->clientService->getClient();
        return view('demo',compact('clients','c1'));
    }

    public function submit_form1 (Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            
        ]);

        
          $this->clientService->createCity($validated);
    }

    public function submit_form2 (Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'city'=>'required|string|max:255',
            'number'=>'required|string|max:10',
        ]);
 
         $this->clientService->createClient($validated);
               
        
    }

    public function submit_form3 (Request $request)
    {
        $validated = $request->validate([
            'product_name'=>'required|string|max:255',
            'product_price'=>'required|numeric',
        ]);

         $this->clientService->createProduct($validated);

         
    }
    public function test()
    {
        return view('test');
    } 

    public function s_admin()
    {
        return view('s_admin');
    }

    public function city()
    {
        $clients = $this->clientService->get_City();
        return view('city',compact('clients'));
    }

    public function city_destroy($id)
    {
        $city = City::find($id);
    
        if ($city) {
            $city->delete();
            return response()->json(['message' => 'Client deleted successfully.']);
        }
    
        return response()->json(['message' => 'Client not found.'], 404);
    }

    public function client()
    {
        $clients = $this->clientService->get_client();
        $v = $this->clientService->get_City();
        return view('client',compact('clients','v'));
    }

    public function clients_destroy($id)
{
    $client = Client::findOrFail($id);
    $client->delete();
    return response()->json(['success' => true]);
}

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return response()->json(['success' => true]);
    }

    public function product()
    {
        $clients = $this->clientService->getProducts();
        return view('product',compact('clients'));
    }

    public function product_destroy($id){
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully.']);

    }
}

public function product_update(Request $request, $id)
{
    $client = Product::findOrFail($id);
    $client->update($request->all());
    return response()->json(['success' => true]);
}

 public function excel()
 {
    return view('excel');
 }
 public function data()
 {
    $clients = $this->clientService->get_data();
   
    return view('data',compact('clients'));
 }

 public function data_destroy($id){
    $product = register::find($id);
    if ($product) {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);

}
}

public function data_update(Request $request, $id)
{
$client = register::findOrFail($id);
$client->update($request->all());
return response()->json(['success' => true]);
}

public function master()
{
    return view('master');
}

public function home()
{
    $city = $this->clientService->home_city();
    $product = $this->clientService->home_product();
    $users = $this->clientService->home_users();
    return view('home',compact('city','product','users'));
}
public function home1($name)
 {
    $clients=register::where('name',$name)->get();
    return view('data',compact('clients'));
}

public function findcity($client)
 {
    $clients = $this->clientService->find_city($client);
    return view('data', compact('clients'));
 }

 public function findclient($client)
 {
    $clients = $this->clientService->find_client($client);
    return view('data', compact('clients'));
 }

public function exceldata()
{
   $bills=ClientBill::all();
   return view('exceldata', compact('bills'));
}

public function x()
{
    $users = Client::all();
    return view('x', compact('users'));
}


public function getUserData($username)
{
    $user = Client::where('name', $username)->first();
    if ($user) {
        return response()->json([
            'city' => $user->city,
            'Mo_Number' => $user->Mo_Number
        ]);
    }
    return response()->json(['error' => 'User not found'], 404);
}

public function bills()
{
    $users = Client::all();
    $products = Product::all();
    return view('bills', compact('users','products'));
}

public function storeClientData(Request $request)
{
    $data = $request->all();

    foreach ($data['std'] as $billData) {
        ClientBill::create([
            'user_name' => $request->user, 
            'city' => $request->city,
            'mo_number' => $request->Mo_Number,
            'product_type' => $billData['product_type'],
            'price' => $billData['price'],
            'date' => $billData['date'],
            'start_time' => $billData['start_time'],
            'end_time' => $billData['end_time'],
            'total_hours' => $billData['total_hours'],
            'total_amount' => $billData['total_amount'],
        ]);
    }


    $total = ClientBill::where('user_name', $request->user)->sum('total_amount');

   
    Client::where('name', $request->user)
        ->update(['due_payment' => $total]);

    return redirect()->back()->with('success', 'Client data has been saved.');
}


public function info()
{
   return view('info');
}

public function info_data($id,$name)
{
    $clients = $this->clientService->get_info($id);
    $bills = $this->clientService->get_bills($name);
    return view('info', compact('clients','bills'));
}

public function payment()
{
    $clients =Client ::all(); 
    return view('payment', compact('clients'));
}
public function payment_data(Request $request)
{
   
    $validated = $request->validate([
        'client_name' => 'required',
        'city' => 'required',
        'mobile' => 'required',
        'due_payment' => 'required',
        'date' => 'required',
        'received_payment' => 'required', 
    ]);

    $this->clientService->get_payment($validated);
    return redirect('payment');
}

public function pay()
{
    $clients = $this->clientService->get_pay();
    return view('pay', compact('clients'));
}
public function pay_delete( $id)
{
    
    $product = Payment::find($id);
    if ($product) {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully.']);
}
}
public function updatePayment(Request $request, $id)
{
    $email = session('s_admin_email');
    $row = User::where('email', $email)->first();

    $client = Payment::findOrFail($id);
    $num = $client->due_payment - $request->received_payment;

    // Update fields
    $client->received_payment = $request->received_payment;
    $client->due_payment = $num;
    $client->updated_by = $row->name;
    $client->updated_at = now(); 
    $client->save();
    Client::where('name', $client->name,)
    ->update(['due_payment' => $num]);


    return response()->json(['message' => 'Payment updated successfully.']);
}
public function getProductByName($name)
{
    $product = Product::where('product_name', $name)->first();

    if ($product) {
        return response()->json(['price' => $product->product_price]);
    }

    return response()->json(['error' => 'Product not found'], 404);
}

public function pdf($id)
{
    $client = Payment::find($id);
    $data = [
        'name' =>$client->name,
        'city' =>$client->city,
        'phone' =>$client->phone,
        'due_payment'=>$client->due_payment,
        'date'=>$client->date,
        'received_payment'=>$client->received_payment,
    ];

    $pdf = Pdf::loadView('pdf_template', $data);
    return $pdf->download('example.pdf');
}

 public function user_panel()
 {
    return view('user_panel');
 }

 public function user_home()
 {
    $due_payment = $this->clientService->user_due_paymeent();
    $payed = $this->clientService->user_payed();
    $odder = $this->clientService->user_odder();
    return view('user_home',compact('due_payment','payed','odder'));
 }
 public function user_odders()
 {
    $clients = $this->clientService->get_user_odder();
    return view('user_odders',compact('clients'));
 }
 public function user_pay()
 {
    $clients = $this->clientService->get_user_pay();
    return view('user_pay',compact('clients'));
 }

 public function pdf_bills($id)
{
    $client = ClientBill::find($id);
    $data = [
        'name' =>$client->user_name,
        'city' =>$client->city,
        'phone' =>$client->mo_number,
         'product'=>$client->product_type,
         'price'=>$client->price,
        'date'=>$client->date,
        'hours'=>$client->total_hours,
        'amount'=>$client->total_amount,
       
    ];

    $pdf = Pdf::loadView('pdf_bill', $data);
    return $pdf->download('example.pdf');
}
public function xx()
{
    return view('xx');
}
}
