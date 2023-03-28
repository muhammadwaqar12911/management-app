<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Runner;

class RunnerController extends Controller
{
    public function index(string $search = null)
    {
        if($search)
        {
            return response()->json([
                'status'=>true,
                'data'=>Runner::where('runner', 'LIKE', '%'. $search .'%')->latest()->get(),
                'message'=>'Runner',
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>Runner::latest()->get(),
            'message'=>'Runner',
        ]);
    }
}
