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

            Department::create([
                'name'=> $request->name,
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => 'Department added successfully',
            ]);
        }
    }



    public function getDepartment($id)
    {
        $department = Department::find($id);

        if($department){

            return response()->json([
                'status' => 200,
                'department' => $department,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Department not found!',
            ]);

        }
    }



    public function updateDepartment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
        ]);


        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $department = Department::find($id);

            if($department){

                $department->name = $request->name;
                $department->save();
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Updated successully',
                ]);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'Department not found!',
                ]);

            }

            
        }
    }


}
