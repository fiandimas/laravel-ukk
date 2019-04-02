<?php

use App\Models\Cost;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin','AdminController@index');
Route::get('/admin/logout',function(){
    Session::flush();
    return redirect('admin/login');
});
Route::get('/admin/level','LevelController@index')->name('admin.level');
Route::get('/admin/admin','AdminController@admin')->name('admin.admin');
Route::get('/admin/admin/add','AdminController@add')->name('admin.add');
Route::post('/admin/admin','AdminController@create')->name('admin.create');
Route::get('/admin/admin/{id}','AdminController@edit')->name('admin.edit');
Route::get('/admin/admin/delete/{id}','AdminController@delete')->name('admin.delete');
Route::put('/admin/admin/{id}','AdminController@update')->name('admin.update');
Route::delete('/admin/delete/{id}','AdminController@delete')->name('admin.delete');

Route::get('/admin/cost','CostController@index')->name('cost');
Route::post('/admin/cost','CostController@create')->name('cost.create');
Route::get('/admin/cost/{id}','CostController@edit')->name('cost.edit');
Route::put('/admin/cost/{id}','CostController@update')->name('cost.update');
Route::delete('/admin/cost/{id}','CostController@delete')->name('cost.delete');

Route::get('/admin/customer','CustomerController@customer')->name('customer');
Route::get('/admin/customer/add','CustomerController@add')->name('customer.add');
Route::post('/admin/customer','CustomerController@create')->name('customer.create');
Route::get('/admin/customer/{id}','CustomerController@edit')->name('customer.edit');
Route::put('/admin/customer/{id}','CustomerController@update')->name('customer.update');
Route::delete('/admin/customer/{id}','CustomerController@delete')->name('customer.delete');

Route::get('/admin/usage','UsageController@index')->name('usage');
Route::get('/admin/usage/add','UsageController@add')->name('usage.add');
Route::get('/admin/usage/{id}','UsageController@detail')->name('usage.detail');
Route::post('/admin/usage','UsageController@create')->name('usage.create');
Route::get('/admin/bill/{id}','BillController@detail')->name('bill.detail');

Route::get('/admin/payment','PaymentController@index')->name('payment');
Route::put('/admin/payment/accept/{id}','PaymentController@accept');
Route::put('/admin/payment/reject/{id}','PaymentController@reject');

Route::get('/admin/history','HistoryController@index')->name('history');

Route::post('/admin/month/usage/','UsageController@getMonthUsage');

Route::get('/admin/login', function(){
    return view('admin.auth.login');
});

Route::post('/admin/login','AdminController@login')->name('admin.login');

Route::get('/','CustomerController@index');
Route::get('/login', function(){
    if(Session::get('login')){
        return redirect('/');
    }else{
        return view('customer.auth.login');
    }
})->name('login');
Route::get('/register',function(){
    if(Session::get('login')){
        return redirect('/');
    }else{
        $cost = Cost::all();
        return view('customer.auth.register', compact('cost'));
    }
})->name('register');
Route::get('/bill','BillController@index')->name('bill.customer');
Route::post('/login','CustomerController@login')->name('customer.login');
Route::post('/register','CustomerController@create')->name('customer.register');
Route::post('/bill/pay','BillController@pay')->name('bill.pay');
Route::get('/logout', function(){
    Session::flush();
    return redirect('/login');
});