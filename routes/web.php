<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\DepartmentController;


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


Route::view('department','departments.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('employee',EmployeeController::class);
Route::resource('contract',ContractController::class);
Route::resource('station',StationController::class);
Route::resource('bank',BankController::class);
Route::resource('unit',UnitController::class);
Route::resource('qualification',QualificationController::class);





