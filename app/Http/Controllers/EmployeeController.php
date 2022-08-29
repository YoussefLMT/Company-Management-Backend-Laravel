<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{

    public function getEmployees()
    {

        $employees = Employee::join('departments', 'employees.id', '=', 'departments.id')
               ->get(['employees.*', 'departments.name']);

        return response()->json([
            'status' => 200,
            'employees' => $employees
        ]);
    }
    
    public function addEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'job' => 'required',
            'salary' => 'required',
            'department_id' => 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            Employee::create([
                'first_name'=> $request->first_name,
                'last_name' => $request->last_name,
                'email'=> $request->email,
                'phone' => $request->phone,
                'job' => $request->job,
                'salary' => $request->salary,
                'department_id' => $request->department_id
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => "Employee added successfully",
            ]);
        }
    }
}
