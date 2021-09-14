<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\QualificationController;
use App\Http\Controllers\API\StationController;
use App\Http\Controllers\API\UnitController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ContractController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PayrollController;

use App\Http\Controllers\API\{
    EmployeetypesController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('payroll/pending',[PayrollController::class,'pending']);
Route::get('payroll/approve/{paycode}',[PayrollController::class,'approve']);
Route::get('payslip/getrecords',[PayrollController::class,'getpayslip']);

Route::apiResources([
    'stations'=>StationController::class,
    'units'=>UnitController::class,
    'banks'=>BankController::class,
    'employees'=>EmployeeController::class,
    'contracts'=>ContractController::class,
    'departments'=>DepartmentController::class,
    'qualifications'=>QualificationController::class,
    'categories'=>CategoryController::class,
    'employeetypes'=>EmployeetypesController::class,
]);
