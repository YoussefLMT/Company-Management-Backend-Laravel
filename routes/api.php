<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentsController;

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


Route::get('departments', [DepartmentsController::class, 'getDepartments']);
Route::post('add-department', [DepartmentsController::class, 'addDepartments']);
Route::get('get-department/{id}', [DepartmentsController::class, 'getDepartment']);
Route::put('update-department/{id}', [DepartmentsController::class, 'updateDepartments']);
Route::delete('delete-department/{id}', [DepartmentsController::class, 'deleteDepartments']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
