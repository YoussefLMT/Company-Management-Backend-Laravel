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

    
}
