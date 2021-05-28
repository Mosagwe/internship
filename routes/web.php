<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\API\ContractsController;

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
    return view('auth.login');

});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('employee',EmployeeController::class);
Route::resource('contract',ContractController::class);

Route::get('getEmployees',[EmployeeController::class,'getEmployees']);
Route::post('/api/test',[ContractsController::class,'store']);

Route::resource('ticket',\App\Http\Controllers\TicketController::class);



