<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PayrollController;


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


Route::view('department','departments.index')->name('department.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('employee',EmployeeController::class);
Route::resource('contract',ContractController::class);
Route::resource('station',StationController::class);
Route::resource('bank',BankController::class);
Route::resource('unit',UnitController::class);
Route::resource('qualification',QualificationController::class);

Route::resource('category',CategoryController::class);
Route::resource('payroll',PayrollController::class);
Route::get('payroll/search/employees',[PayrollController::class,'getEmployees'])->name('payroll.getemployees');
Route::get('employee/changestatus/{id}',[EmployeeController::class,'changeStatus'])->name('employee.changestatus');
Route::get('contract/terminate/{id}',[ContractController::class,'terminate'])->name('contract.terminate');






