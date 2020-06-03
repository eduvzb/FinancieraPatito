<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients', 'ClientController@index')
    ->name('clients.index');
Route::get('/clients/new', 'ClientController@create')
    ->name('clients.create');
Route::post('/clients', 'ClientController@store')
    ->name('clients.store');
Route::delete('/clients/{id}', 'ClientController@destroy')
    ->name('clients.destroy');
Route::get('/clients/import', 'ClientController@import')
    ->name('clients.import');    
Route::post('/clients/import/save', 'ClientController@save')
    ->name('clients.save');

//Route::delete(, 'ClientController@destroy')->name('clients.destroy');
Route::get('/loans', 'LoanController@index')->name('loans.index');
Route::get('/loans/new', 'LoanController@create')->name('loans.create');
Route::post('/loans', 'LoanController@store')->name('loans.store');
Route::delete('/loans/{id}', 'LoanController@destroy')->name('loans.destroy');
Route::get('/export-loans-excel', 'LoanController@exportExcel')->name('loans.exportExcel');

Route::get('/payments','PaymentController@index')->name('payments.index');
Route::get('/payments/{id}', 'PaymentController@show')->name('payments.show');
Route::get('/payments/pay/{id}', 'PaymentController@pay')->name('payments.pay');
Route::post('/payments/store/{id}', 'PaymentController@store')->name('payments.store'); 

Route::get('/users/edit', 'UserController@edit')->name('users.edit');


