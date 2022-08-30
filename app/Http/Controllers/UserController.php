<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function getProfile()
    { 
        $user = auth('sanctum')->user();

        if($user){

            return response()->json([
                'status' => 200,
                'user' => $user,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'User not found!',
            ]);
        }
    }
}
