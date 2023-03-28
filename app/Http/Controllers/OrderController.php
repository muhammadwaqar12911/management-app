<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use App\Models\Runner;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\OrdersExport;
use Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin.orders', ['orders'=>Order::latest()->get(),'users'=>User::whereNot('id', 1)->latest()->get(),  'items'=>Item::latest()->get(), 'customers'=>Customer::latest()->get(), 'runners'=>Runner::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required',
            'customer_id' => 'required',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'runner_id' => 'required',
            'area' => 'nullable',
            // 'created_by' => 'required',
            'status' => 'required',
            'note' => 'nullable',
            'item_id.*' => 'required|min:1',
            'quantity.*' => 'required|min:1',
            'rate.*' => 'required|min:1',
            'unit.*' => 'required|min:1',
            'packing.*' => 'required|min:1',
        ]);
        $total=0;
        foreach($request->item_id as $key=>$value)
        {
            $total+=$request->quantity[$key]*$request->rate[$key];
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
            foreach($request->item_id as $key=>$value)
            {
                $sub_total=$request->quantity[$key]*$request->rate[$key];
                $query->order_items()->create([
                    'item_id'=>$value,
                    'quantity'=>$request->quantity[$key],
                    'rate'=>$request->rate[$key],
                    'unit'=>$request->unit[$key],
                    'packing'=>$request->packing[$key],
                    'sub_total'=>$sub_total,
                ]);
            }
            return redirect('orders')->with('success', 'Order Added Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required',
            'customer_id' => 'required',
            'order_date' => 'required',
            'delivery_date' => 'required',
            'runner_id' => 'required',
            'area' => 'nullable',
            // 'created_by' => 'required',
            'status' => 'required',
            'note' => 'nullable',
            'item_id.*' => 'required|min:1',
            'quantity.*' => 'required|min:1',
            'rate.*' => 'required|min:1',
            'unit.*' => 'required|min:1',
            'packing.*' => 'required|min:1',
        ]);
        $total=0;
        foreach($request->item_id as $key=>$value)
        {
            $total+=$request->quantity[$key]*$request->rate[$key];
        }
        $query=Order::find($order->id)->update([
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
            $order->order_items->each->delete();
            foreach($request->item_id as $key=>$value)
            {
                $sub_total=$request->quantity[$key]*$request->rate[$key];
                $order->order_items()->create([
                    'item_id'=>$value,
                    'quantity'=>$request->quantity[$key],
                    'rate'=>$request->rate[$key],
                    'unit'=>$request->unit[$key],
                    'packing'=>$request->packing[$key],
                    'sub_total'=>$sub_total,
                ]);
            }
            return redirect('orders')->with('success', 'Order Updated Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): RedirectResponse
    {
        $query=Order::where('id', $order->id)->delete();
        if($query)
        {
            return redirect('orders')->with('success', 'Order Deleted Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function download(Request $request)
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function sales(Request $request): Response
    {
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        if(!($start_date && $end_date)) 
        {
            $start_date=date('Y-m-01');
            $end_date=date('Y-m-d');
        }
        $items=Item::whereHas('order_items', function ($query) use ($start_date, $end_date) {
            $query->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        })->withSum('order_items', 'sub_total')->withSum('order_items', 'quantity')->latest()->get();
        return response()->view('admin.sales', ['items'=>$items, 'start_date'=>$start_date, 'end_date'=>$end_date]);
    }
}
