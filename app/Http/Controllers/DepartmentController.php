<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
    
    public function getDepartments()
    {

        $departments = Department::all();

        return response()->json([
            'status' => 200,
            'departments' => $departments,
        ]);
    }


    public function AddDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $department = Department::create([
                'name'=> $request->name,
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => 'Department added successfully',
            ]);
        }
    }


}
