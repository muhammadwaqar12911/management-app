<?php

namespace App\Http\Controllers;

use App\Models\Runner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RunnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin.runners', ['runners'=>Runner::latest()->get()]);
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
            'runner' => 'required|unique:runners,runner',
        ]);
      
        $query=Runner::create([
            'runner'=>$request->runner,
        ]);
        if($query)
        {
            return redirect('runners')->with('success', 'Runner Added Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Runner $runner): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Runner $runner): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Runner $runner): RedirectResponse
    {
        $request->validate([
            'runner' => 'required|unique:runners,runner,'.$runner->id,
        ]);
        
        $query=Runner::find($runner->id)->update([
            'runner'=>$request->runner,
        ]);
        if($query)
        {
            return redirect('runners')->with('success', 'Runner Updated Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Runner $runner): RedirectResponse
    {
        $query=Runner::where('id', $runner->id)->delete();
        if($query)
        {
            return redirect('runners')->with('success', 'Runner Deleted Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }
}
