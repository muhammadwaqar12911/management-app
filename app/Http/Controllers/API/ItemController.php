<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(string $search = null)
    {
        if($search)
        {
            return response()->json([
                'status'=>true,
                'data'=>Item::where('item', 'LIKE', '%'. $search .'%')->latest()->get(),
                'message'=>'Products',
            ]);
        }
        return response()->json([
            'status'=>true,
            'data'=>Item::latest()->get(),
            'message'=>'Items',
        ]);
    }
}
