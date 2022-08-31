<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Department;

class StatisticsController extends Controller
{
    
    public function getTotalVisitsCount(){

        $employeesCount = Employee::all()->count();
        $customersCount = Customer::all()->count();
        $departmentsCount = Department::all()->count();

        return response()->json([
            'status' => 200,
            'employeesCount' => $employeesCount,
            'customersCount' => $customersCount,
            'departmentsCount' => $departmentsCount,
        ]);
    }
}
