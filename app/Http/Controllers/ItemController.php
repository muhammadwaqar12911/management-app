<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('admin.items', ['items'=>Item::latest()->get()]);
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
            'item' => 'required|unique:items,item',
            'item_type' => 'required',
            'item_note' => 'nullable',
        ]);
      
        $query=Item::create([
            'item'=>$request->item,
            'item_type'=>$request->item_type,
            'item_note'=>$request->item_note,
        ]);
        if($query)
        {
            return redirect('items')->with('success', 'Item Added Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        $request->validate([
            'item' => 'required|unique:items,item,'.$item->id,
            'item_type' => 'required',
            'item_note' => 'nullable',
        ]);
        
        $query=Item::find($item->id)->update([
            'item'=>$request->item,
            'item_type'=>$request->item_type,
            'item_note'=>$request->item_note,
        ]);
        if($query)
        {
            return redirect('items')->with('success', 'Item Updated Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        $query=Item::where('id', $item->id)->delete();
        if($query)
        {
            return redirect('items')->with('success', 'Item Deleted Successfully');
        }
        else
        {
            return back()->with('fail', 'Something Went Wrong!');
        }
    }
}
