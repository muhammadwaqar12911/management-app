<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin.customers', ['customers'=>Customer::latest()->get()]);
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
            'customer' => 'required|unique:customers,customer',
            'customer_type' => 'required',
            'customer_location' => 'required',
            'phone' => 'nullable',
            'note' => 'nullable',
        ]);
      
        $query=Customer::create([
            'customer'=>$request->customer,
            'customer_type'=>$request->customer_type,
            'customer_location'=>$request->customer_location,
            'phone'=>$request->phone,
            'note'=>$request->note,
        ]);
        if($query)
        {
            return redirect('customers')->with('success', 'Customer Added Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $request->validate([
            'customer' => 'required|unique:customers,customer,'.$customer->id,
            'customer_type' => 'required',
            'customer_location' => 'required',
            'phone' => 'nullable',
            'note' => 'nullable',
        ]);
        
        $query=Customer::find($customer->id)->update([
            'customer'=>$request->customer,
            'customer_type'=>$request->customer_type,
            'customer_location'=>$request->customer_location,
            'phone'=>$request->phone,
            'note'=>$request->note,
        ]);
        if($query)
        {
            return redirect('customers')->with('success', 'Customer Updated Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $query=Customer::where('id', $customer->id)->delete();
        if($query)
        {
            return redirect('customers')->with('success', 'Customer Deleted Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }
}
