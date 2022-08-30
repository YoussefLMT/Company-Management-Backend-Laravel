<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;

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


// Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [AuthController::class, 'logOut']);

    Route::get('get-profile', [UserController::class, 'getProfile']);

});


Route::get('departments', [DepartmentController::class, 'getDepartments']);
Route::post('add-department', [DepartmentController::class, 'addDepartment']);
Route::get('get-department/{id}', [DepartmentController::class, 'getDepartment']);
Route::put('update-department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('delete-department/{id}', [DepartmentController::class, 'deleteDepartment']);


Route::get('customers', [CustomerController::class, 'getCustomers']);
Route::post('add-customer', [CustomerController::class, 'addCustomer']);
Route::get('get-customer/{id}', [CustomerController::class, 'getCustomer']);
Route::put('update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('delete-customer/{id}', [CustomerController::class, 'deleteCustomer']);


Route::get('employees', [EmployeeController::class, 'getEmployees']);
Route::post('add-employee', [EmployeeController::class, 'addEmployee']);
Route::get('get-employee/{id}', [EmployeeController::class, 'getEmployee']);
Route::put('update-employee/{id}', [EmployeeController::class, 'updateEmployee']);
Route::delete('delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
