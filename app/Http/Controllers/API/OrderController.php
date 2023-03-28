<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $validator=Validator::make($request->all(),[
        //     'user_id' => 'required|exists:users,id',
        // ]);
        // if($validator->fails()){
        //     $errors=array('error'=>$validator->errors());
        //     return response()->json($errors,202);
        // }
        $all=Order::with('order_items.item')->with('user')->with('customer')->with('runner')->latest()->get();
        $processing=Order::with('order_items.item')->with('user')->with('customer')->with('runner')->where('status', 'processing')->latest()->get();
        $completed=Order::with('order_items.item')->with('user')->with('customer')->with('runner')->where('status', 'completed')->latest()->get();
        $on_hold=Order::with('order_items.item')->with('user')->with('customer')->with('runner')->where('status', 'on_hold')->latest()->get();
        $cancelled=Order::with('order_items.item')->with('user')->with('customer')->with('runner')->where('status', 'cancelled')->latest()->get();
        $data=[
            'all'=>$all,
            'processing'=>$processing,
            'completed'=>$completed,
            'on_hold'=>$on_hold,
            'cancelled'=>$cancelled,
        ];
        return response()->json([
            'status'=>true,
            'orders'=>$data,
            'message'=>'Orders',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'runner_id' => 'required|exists:runners,id',
            'area' => 'nullable',
            // 'created_by' => 'required',
            'status' => 'required',
            'note' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required|integer',
            'items.*.rate' => 'required|integer',
            'items.*.unit' => 'required',
            'items.*.packing' => 'required',
        ]);
        if($validator->fails()){
            $errors=array('error'=>$validator->errors());
            return response()->json($errors,202);
        }
        
        $total=0;
        foreach($request->items as $item)
        {
            $total+=$item['quantity']*$item['rate'];
        }
        
        $query=Order::create([
            'user_id'=>$request->user_id,
            'customer_id'=>$request->customer_id,         
            'order_date'=>$request->order_date,         
            'delivery_date'=>$request->delivery_date,
            'runner_id'=>$request->runner_id,
            'area'=>$request->area,
            // 'created_by'=>$request->created_by,
            'total'=>$total,
            'status'=>$request->status,
            'note'=>$request->note,
        ]);
        if($query)
        {
            foreach($request->items as $item)
            {
                $sub_total=$item['quantity']*$item['rate'];
                $query->order_items()->create([
                    'item_id'=>$item['item_id'],
                    'quantity'=>$item['quantity'],
                    'rate'=>$item['rate'],
                    'unit'=>$item['unit'],
                    'packing'=>$item['packing'],
                    'sub_total'=>$sub_total,
                ]);
            }
            $query->order_items=$query->order_items;
            return response()->json([
                'status'=>true,
                'order'=>$query,
                'message'=>'Order Added Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>false,
                'message'=>'Something Went Wrong!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->order_items->item=$order->order_items->item;
        return response()->json([
            'status'=>true,
            'order'=>$order,
            'message'=>'Order',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'runner_id' => 'required|exists:runners,id',
            'area' => 'nullable',
            // 'created_by' => 'required',
            'status' => 'required',
            'note' => 'nullable',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required|integer',
            'items.*.rate' => 'required|integer',
            'items.*.unit' => 'required',
            'items.*.packing' => 'required',
        ]);
        if($validator->fails()){
            $errors=array('error'=>$validator->errors());
            return response()->json($errors,202);
        }
        
        $total=0;
        foreach($request->items as $item)
        {
            $total+=$item['quantity']*$item['rate'];
        }
        
        $query=Order::find($order->id)->update([
            'customer_id'=>$request->customer_id,         
            'order_date'=>$request->order_date,         
            'delivery_date'=>$request->delivery_date,
            'runner_id'=>$request->runner_id,
            'area'=>$request->area,
            // 'created_by'=>$request->created_by,
            'total'=>$total,
            'status'=>$request->status,
            'note'=>$request->note,
        ]);
        if($query)
        {
            $order->order_items->each->delete();
            foreach($request->items as $item)
            {
                $sub_total=$item['quantity']*$item['rate'];
                $order->order_items()->create([
                    'item_id'=>$item['item_id'],
                    'quantity'=>$item['quantity'],
                    'rate'=>$item['rate'],
                    'unit'=>$item['unit'],
                    'packing'=>$item['packing'],
                    'sub_total'=>$sub_total,
                ]);
            }
            $order->order_items=$order->order_items;
            return response()->json([
                'status'=>true,
                'order'=>$order,
                'message'=>'Order Updated Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>false,
                'message'=>'Something Went Wrong!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        $query=Order::where('id', $order->id)->delete();
        if($query)
        {
            return response()->json([
                'status'=>true,
                'message'=>'Order Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=>false,
                'message'=>'Something Went Wrong!',
            ]);
        }
    }
}
