<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin.users', ['users'=>User::whereNot('id', 1)->latest()->get()]);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ]);
      
        $query=User::create([
            'name'=>$request->name,         
            'email'=>$request->email,         
            'phone'=>$request->phone,
            'password'=>$request->password,
        ]);
        if($query)
        {
            return redirect('users')->with('success', 'User Added Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
            'password' => 'required',
        ]);
        
        $query=User::find($id)->update([
            'name'=>$request->name,         
            'email'=>$request->email,         
            'phone'=>$request->phone,
            'password'=>$request->password,
        ]);
        if($query)
        {
            return redirect('users')->with('success', 'User Updated Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $query=User::where('id', $id)->delete();
        if($query)
        {
            return redirect('users')->with('success', 'User Deleted Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }
}
