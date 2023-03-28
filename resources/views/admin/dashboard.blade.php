@extends('admin.master')

@section('title')
  Dashboard
@endsection

@section('page-content')
<h1 class="mt-4"></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row mx-4">
    <div class="col-md-12"><h3>Orders</h3></div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-calendar-alt text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>Today</b><br>
                <b>{{count($today)}}</b><br><br>
                {{$today->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-calendar-alt text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>This Month</b><br>
                <b>{{count($this_month)}}</b><br><br>
                {{$this_month->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-calendar-alt text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>This Year</b><br>
                <b>{{count($this_year)}}</b><br><br>
                {{$this_year->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-calendar-alt text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>All Time</b><br>
                <b>{{count($all_the_time)}}</b><br><br>
                {{$all_the_time->sum('total')}} Rs.
            </div>
        </div>
    </div>
</div>
<div class="row mx-4">
    <div class="col-md-12"><h3>Orders</h3></div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-chart-line text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>Processing</b><br>
                <b>{{count($processing)}}</b><br><br>
                {{$processing->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-check text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>Confirmed</b><br>
                <b>{{count($confirmed)}}</b><br><br>
                {{$confirmed->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-pause text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>On Holds</b><br>
                <b>{{count($on_hold)}}</b><br><br>
                {{$on_hold->sum('total')}} Rs.
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card mb-4 p-4 shadow" style="border-radius: 10px;">
            <div class="card-body">
                <i class="fas fa-times text-white p-3 bg-primary" style="border-radius: 10px;"></i><br>
                <b>Cancelled</b><br>
                <b>{{count($cancelled)}}</b><br><br>
                {{$cancelled->sum('total')}} Rs.
            </div>
        </div>
    </div>
</div>
@endsection
