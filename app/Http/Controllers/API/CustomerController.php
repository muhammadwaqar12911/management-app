<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(string $search = null)
    {
        if($search)
        {
            return response()->json([
                'status'=>true,
                'data'=>Customer::where('customer', 'LIKE', '%'. $search .'%')->latest()->get(),
                'message'=>'Customer',
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>Customer::latest()->get(),
            'message'=>'Customer',
        ]);
    }
}
