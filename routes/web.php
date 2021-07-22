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
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;


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
Route::get('payroll/search',[PayrollController::class,'showSearchForm'])->name('payroll.search');
Route::get('payroll/search/employees',[PayrollController::class,'getEmployees'])->name('payroll.getemployees');
Route::get('payroll/getrecords',[PayrollController::class,'getPayrollRecords'])->name('payroll.getrecords');
Route::get('employee/changestatus/{id}',[EmployeeController::class,'changeStatus'])->name('employee.changestatus');
Route::get('contract/terminate/{id}',[ContractController::class,'terminate'])->name('contract.terminate');

Route::resource('category',CategoryController::class);
Route::resource('employee',EmployeeController::class);
Route::resource('contract',ContractController::class);
Route::resource('station',StationController::class);
Route::resource('bank',BankController::class);
Route::resource('unit',UnitController::class);
Route::resource('qualification',QualificationController::class);
Route::resource('payroll',PayrollController::class);
Route::resource('user',UserController::class);
Route::resource('permission',PermissionController::class);
Route::resource('role',RoleController::class);
// axios requests
Route::get('/getallpermission',[PermissionController::class,'getAllPermission']);
Route::post('/postRole',[RoleController::class,'store'])->name('postRole');
Route::get('/getAllRoles',[RoleController::class,'getAll']);
Route::get('/getAllUsers',[UserController::class,'getAll']);
Route::get('/getAllPermissions',[PermissionController::class,'getAll']);
Route::post('/account/create',[UserController::class,'store']);
Route::put('/account/update/{id}',[UserController::class,'update']);
Route::delete('/delete/user/{id}',[UserController::class,'delete']);
Route::get('/search/user',[UserController::class,'search']);




