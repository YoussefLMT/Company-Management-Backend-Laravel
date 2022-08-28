<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{

    public function getCustomers()
    {

        $customers = Customer::all();

        return response()->json([
            'status' => 200,
            'customers' => $customers,
        ]);
    }


    
    public function addCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()){

            return response()->json([
                'validation_err' => $validator->messages(),
            ]);

        }else{

            Customer::create([
                'first_name'=> $request->first_name,
                'last_name' => $request->last_name,
                'email'=> $request->email,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
    
            return response()->json([
                'status' => 200,
                'message' => "Customer added successfully",
            ]);
        }
    }
}
