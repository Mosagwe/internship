<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\{
    EmployeetypesController,
    ContractController,
    DepartmentController,
    QualificationController,
    StationController,
    UnitController,
    BankController,
    EmployeeController,
    CategoryController,
    PayrollController,
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
Route::get('contracts/expired',[ContractController::class,'expiredContracts']);

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
