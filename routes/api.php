<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;

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


});


Route::get('departments', [DepartmentController::class, 'getDepartments']);
Route::post('add-department', [DepartmentController::class, 'addDepartment']);
Route::get('get-department/{id}', [DepartmentController::class, 'getDepartment']);
Route::put('update-department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('delete-department/{id}', [DepartmentController::class, 'deleteDepartment']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
