<?php

namespace App\Http\Controllers;


use App\Services\Poster;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\register;
use App\Models\Bill;
use App\Models\Password_Token;
use Session;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Models\Clint;
use App\Models\User;

class sample extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
 
    public function index()
    {
        return view('index');
    }

    public function index_data(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:255',
            'city'=>'required|string|max:255',
        ]);
 
         $this->clientService->reg($validated); //reg function name
    }
   
     public function Register(Request $request)
    {
          
        return view('Register');   
    }
    public function register_data(Request $request)
    {
        $validated =$request->validate([
            'companyname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email', 
            'phonenumber' => 'required|numeric|digits:10', 
            'distric' => 'required|string|max:50',
            'taluka' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'password' => 'required|numeric', 
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'number' => $validated['phonenumber'],
            'password' =>($validated['password']),
            
            
        ]);

        $this->clientService->register($validated);
        return view('Login');
    }
    public function Login()
    {
        return view('Login');
    }
    public function login_data(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]
        );
        $emailOrPhone = $request['email']; 
$pass = $request['password'];


$row = User::where('email', $emailOrPhone)
    ->orWhere('number', $emailOrPhone)
    ->first();

if (!empty($row)) {
    if ($row->password == $pass && $row->roll == "User") {
        session()->flash('success', "Welcome, {$emailOrPhone}");
        session(['user_email' => $row->email]); 
        return redirect('user_home'); 
    } 
     elseif($row->password == $pass && $row->roll == "Admin")
     {
         session()->flash('success', "Welcome, {$emailOrPhone}");
         session(['admin_email' => $row->email]);
         return redirect('demo');
     }
       
     elseif($row->password == $pass && $row->roll == "Super_Admin")
     {
         session()->flash('success', "Welcome, {$emailOrPhone}");
         session(['s_admin_email' => $row->email]);
         return redirect('home');
     }

    else {
        session()->flash('error', 'Incorrect Password');
        return redirect('Login')->withErrors(['password' => 'The password is incorrect.']);
    }
} else {
    return redirect('Login')->withErrors(['email' => 'The email or phone number is not registered.']);
}         
    }



    //forgot password
    public function forgetpassword()
    {
        return view('forgetpassword');
    }
    public function send_otp(Request $req)
{
    $this->delete_token();

    $em = $req->email;

    $result = register::where('email', $em)->first();
    if (empty($result)) {
        session()->flash('error', 'Email id is not registered. Please enter a registered email address.');
        return redirect('forgotpassword');
    }

    $existingToken = Password_Token::where('email', $em)->first();
    if ($existingToken) {
        session()->flash('warning', 'A password reset link has already been sent to your mail. Please check.');
        return redirect()->route('OTPForm');
    }

    try {
        date_default_timezone_set("Asia/Kolkata");
        $otp = mt_rand(100000, 999999);
        $data = register::where('email', $em)->first();
        $data2 = ['name' => $data->name, 'email' => $em, 'otp' => $otp];

        Mail::Send('f_send_mail', ["data3" => $data2], function ($message) use ($data2) {
            $message->to($data2['email'], $data2['name'])->subject('Password Reset');
            $message->from('bhaktiparakhiya030@gmail.com', 'bhakti parakhiya');
        });

        \Log::info('Mail sent successfully to ' . $em);

        $expiry_time = Carbon::now()->addMinutes(2);
        $token_ins = new Password_Token();
        $token_ins->email = $em;
        $token_ins->otp = $otp;
        $token_ins->expiry_time = $expiry_time;

        session()->put('forgot_em', $em);

        if ($token_ins->save()) {
            \Log::info('Token saved successfully for email: ' . $em);
            session()->flash('success', 'Password reset token sent to your registered email address.');
            return redirect()->route('OTPForm');
        } else {
            \Log::error('Failed to save token: ' . json_encode($token_ins));
            session()->flash('error', 'We encountered an issue saving the token. Please try again.');
            return redirect('forgotpassword');
        }
    } catch (Exception $ex) {
        \Log::error('Mail Exception: ' . $ex->getMessage());
        session()->flash('error', 'We encountered an error while sending the password reset token.');
        return redirect('OTPForm');
    }
}

    public function delete_token()
    {
        session()->remove('error');
        date_default_timezone_set("Asia/Kolkata");
        $current_time = Carbon::now();
        Password_Token::where('expiry_time', '<', $current_time)->delete();
    }
    public function check_token_expiry()
    {
        $result = Password_Token::where('email', session()->get('forgot_em'))->first();
        if (empty($result)) {
            session()->flash('error', 'OTP Expired');
            return redirect('forgotpassword');
        }
    }
    public function otp_form(Request $r)
    {
        $this->delete_token();
        $this->check_token_expiry();
        return view('otp_form');
    }
    public function verify_otp(Request $req)
    {
        $this->delete_token();
        $this->check_token_expiry();

        $otp = $req->otp;
        $result = Password_Token::where('email', session()->get('forgot_em'))->first();
        if ($result->otp == $otp) {
            return redirect('SetNewPassword');
        } else {
            session()->flash('error', 'Incorrect OTP');
            return view('otp_form');
        }
    }
    public function new_password()
    {
        $this->delete_token();
        $this->check_token_expiry();

        return view('new_password');
    }

    public function update_new_password(Request $request)
    {
        $updt = register::where('email', session()->get('forgot_em'))->update(array('password' => $request->pswd));
        if ($updt) {
            password_token::where('email', session()->get('forgot_em'))->delete();
            session()->remove('forgot_em');
            session()->flash('success', 'Password updated successfully');
            return redirect('Login');
        } else {
            session()->flash('error', 'Error in resetting password');
            return redirect('Login');
        }
    } 




    //clint
    public function index1()
    {
        $std = bill::all();
        return view('clint', compact('std'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'std' => 'required|array',
            'std.*.product_type' => 'required|string',  
            'std.*.price' => 'required|numeric',
            'std.*.date' => 'required|date',
            'std.*.start_time' => 'required',
            'std.*.end_time' => 'required',  
            'std.*.total_hours' => 'required|numeric',
            'std.*.total_amount' => 'required|numeric',
        ]);
        $this->clientService->clint($validated['std']);        
        return redirect()->route('std.repeater')->with('success', 'Data saved successfully!');
    }
    
    public function clint1()
    {
        return view('clint1');
    }
    public function clint_data(Request $request)
    {
      
        $validated = $request->validate([
            'std' => 'required|array',
            'std.*.product_type' => 'required|string',
            'std.*.price' => 'required|numeric',
            'std.*.date' => 'required|date',
            'std.*.start_time' => 'required',
            'std.*.end_time' => 'required',
            'std.*.total_hours' => 'required|numeric',
            'std.*.total_amount' => 'required|numeric',
        ]);

     
        foreach ($validated['std'] as $item) {
            Bill::create([
                'product_type' => $item['product_type'],
                'price' => $item['price'],
                'date' => $item['date'],
                'start_time' => $item['start_time'],
                'end_time' => $item['end_time'],
                'total_hours' => $item['total_hours'],
                'total_amount' => $item['total_amount'],
            ]);
        }
        return redirect()->route('clint1')->with('success', 'Data saved successfully!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('Login');
    }
}



