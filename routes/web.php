<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\taskCantroller;
use App\Http\Controllers\sample;
use App\Http\middleware\s_Admin;
use App\Http\middleware\Admin;
use App\Http\middleware\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Login');
});



Route::middleware([User::class])->group(function(){
    Route::get('user_panel',[taskCantroller::class,'user_panel']);
    Route::get('user_home',[taskCantroller::class,'user_home']);
    Route::get('user_odders',[taskCantroller::class,'user_odders']);
    Route::get('user_pay',[taskCantroller::class,'user_pay']);
});




Route::middleware([Admin::class])->group(function(){
Route::get('demo',[taskCantroller::class,'demo']);
Route::post('/city',[taskCantroller::class,'submit_form1']);
Route::post('/client',[taskCantroller::class,'submit_form2']);
Route::post('/product',[taskCantroller::class,'submit_form3']);
Route::get('test',[taskCantroller::class,'test']);

});

Route::middleware([s_Admin::class])->group(function(){

    Route::post('/city',[taskCantroller::class,'submit_form1']);
    Route::post('/client',[taskCantroller::class,'submit_form2']);
    Route::post('/product',[taskCantroller::class,'submit_form3']);

Route::get('s_admin',[taskCantroller::class,'s_admin']);
Route::get('city',[taskCantroller::class,'city']);
Route::get('client',[taskCantroller::class,'client']);
Route::delete('/city_delete/{id}', [taskCantroller::class, 'city_destroy']);
Route::put('/clients/{id}', [taskCantroller::class, 'update']);
Route::delete('/clients_delete/{id}', [taskCantroller::class, 'clients_destroy']);
Route::get('/get-user-data/{username}', [taskCantroller::class, 'getUserData']);
Route::get('x', [taskCantroller::class, 'x']);
Route::get('data',[taskCantroller::class,'data']);
Route::get('product',[taskCantroller::class,'product']);
Route::get('/home1/{name}',[taskCantroller::class,'home1']);
Route::get('/findclient/{client}',[taskCantroller::class,'findclient']);
Route::get('/findcity/{city}',[taskCantroller::class,'findcity']);
Route::get('exceldata',[taskCantroller::class,'exceldata']);
Route::get('datatable/data', [taskCantroller::class, 'getData'])->name('datatable.data');
Route::get('export', [DataTableController::class, 'export'])->name('export.excel');
Route::put('/product_edit/{id}', [taskCantroller::class, 'product_update']);
Route::delete('/product_delete/{id}', [taskCantroller::class, 'product_destroy']);
Route::get('excel', [taskCantroller::class, 'excel']);
Route::put('/data_edit/{id}', [taskCantroller::class, 'data_update']);
Route::delete('/data_delete/{id}', [taskCantroller::class, 'data_destroy']);
Route::get('/master', [taskCantroller::class, 'master']);
Route::get('home', [taskCantroller::class, 'home']);
Route::get('bills', [taskCantroller::class, 'bills']);
Route::post('/clint_data', [taskCantroller::class, 'storeClientData']);
Route::get('info', [taskCantroller::class, 'info']);
Route::get('info_data/{id}/{name}', [taskCantroller::class, 'info_data']);
Route::get('payment', [taskCantroller::class, 'payment']);
Route::post('/payment_data', [taskCantroller::class, 'payment_data']);

Route::get('pay', [taskCantroller::class, 'pay']);
Route::delete('/pay_delete/{id}', [taskCantroller::class, 'pay_delete']);
Route::put('/pay_update/{id}', [taskCantroller::class, 'updatePayment']);
Route::get('/get-product-data-by-name/{name}', [taskCantroller::class, 'getProductByName']);
});




Route::get('/Register',[sample::class,'Register']);
Route::post('/register_data',[sample::class,'register_data']);
Route::get('Login',[sample::class,'Login']);
Route::post('/login_data',[sample::class,'login_data']);

Route::get('logout',[sample::class,'logout']);


Route::get('/index',[sample::class,'index']);
Route::post('/index_data',[sample::class,'index_data']);


//forgot password
Route::get('forgetpassword',[sample::class,'forgetpassword']);
Route::post('SendOTP', [sample::class, 'send_otp']);
Route::get('OTPForm', [sample::class, 'otp_form']);
Route::post('OTPVerification', [sample::class, 'verify_otp']);
Route::get('SetNewPassword', [sample::class, 'new_password']);
Route::post('UpdateNewPassword', [sample::class, 'update_new_password']);

//dowunlods

Route::get('pdf/{id}', [taskCantroller::class, 'pdf']);
Route::get('pdf_bills/{id}', [taskCantroller::class, 'pdf_bills']);

Route::get('xx', [taskCantroller::class, 'xx']);