<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function dashboard()
    {
        $today=Order::whereDate('created_at', Carbon::today())->get();
        $this_month=Order::whereMonth('created_at', Carbon::today())->get();
        $this_year=Order::whereYear('created_at', Carbon::today())->get();
        $all_the_time=Order::all();
        
        $processing=Order::where('status', 'processing')->get();
        $confirmed=Order::where('status', 'confirmed')->get();
        $on_hold=Order::where('status', 'on_hold')->get();
        $cancelled=Order::where('status', 'cancelled')->get();
        return view('admin.dashboard')->with([
            'today'=>$today,
            'this_month'=>$this_month,
            'this_year'=>$this_year,
            'all_the_time'=>$all_the_time,
            'processing'=>$processing,
            'confirmed'=>$confirmed,
            'on_hold'=>$on_hold,
            'cancelled'=>$cancelled,
        ]);
    }
}
