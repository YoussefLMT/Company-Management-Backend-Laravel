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



    public function getCustomer($id)
    {
        $customer = Customer::find($id);

        if($customer){

            return response()->json([
                'status' => 200,
                'customer' => $customer,
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Customer not found!',
            ]);

        }
    }



    public function updateCustomer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);


        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'validation_err' => $validator->messages(),
            ]);

        }else{

            $customer = Customer::find($id);

            if($customer){

                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->save();
        
                return response()->json([
                    'status' => 200,
                    'message' => 'Updated successully',
                ]);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => 'Customer not found!',
                ]);

            }
        }
    }



    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);

        if($customer){

            $customer->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Deleted successfully',
            ]);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'Customer not found!',
            ]);

        }
    }
}
