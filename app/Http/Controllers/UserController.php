<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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



    public function modifyProfile(Request $request){

        $user = auth('sanctum')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $user->name = $request->name;
            $user->email = $request->email;
            if(!empty($request->password)){
              $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your profile is successfully updated',
            ]);
        }
    }
}
