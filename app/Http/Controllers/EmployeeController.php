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

        $employees = Employee::join('departments', 'employees.department_id', '=', 'departments.id')
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



    public function getEmployee($id)
    {
        $employee = Employee::join('departments', 'employees.department_id', '=', 'departments.id')
        ->where('employees.id', '=', $id)
               ->get(['employees.*', 'departments.name']);

        if($employee){

            return response()->json([
                'status' => 200,
                'employee' => $employee,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Employee not found!',
            ]);

        }
    }



    public function updateEmployee(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'job' => 'required',
            'salary' => 'required',
            // 'department_id' => 'required',
        ]);


        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $employee = Employee::find($id);

            if($employee){

                $employee->first_name = $request->first_name;
                $employee->last_name = $request->last_name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->job = $request->job;
                $employee->salary = $request->salary;
                $employee->department_id = $request->department_id;
                $employee->save();
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Updated successully',
                ]);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'Employee not found!',
                ]);

            }
        }
    }



    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);

        if($employee){

            $employee->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Employee not found!',
            ]);

        }
    }
}
