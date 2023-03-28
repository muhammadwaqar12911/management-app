@extends('admin.master')

@section('title')
  Sales
@endsection

@section('page-content')
<h2 class="mt-4">Sales</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ url('sales') }}">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" value="{{$start_date}}" id="start_date" required>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" value="{{$end_date}}" id="end_date" required>
            <button type="submit">Filter</button>
        </form><br>
        <table id="datatablesSimple">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Item</th>
                      <th>Item Type</th>
                      <th>Orders</th>
                      <th>Quantity Sold</th>
                      <th>Total Amount</th>
                  </tr>
              </thead>
            <tbody>
                    @if(count($items))
                    @foreach($items as $i)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$i->item}}
                      </td>
                      <td>
                        {{$i->item_type}}
                      </td>
                      <td>
                        {{count($i->order_items)}}
                      </td>
                      <td>
                        {{$i->order_items_sum_quantity}}
                      </td>
                      <td>
                        {{number_format($i->order_items_sum_sub_total, 2, '.', ',')}}
                      </td>
                    </tr>
                    @endforeach
                    @endif
              </tbody>
              <tfooter>
                    <tr>
                      <th colspan="4" class="text-center">
                      Total :
                      </th>
                      <th>
                        {{$items->sum('order_items_sum_quantity')}}
                      </th>
                      <th>
                        {{number_format($items->sum('order_items_sum_sub_total'), 2, '.', ',')}}
                      </th>
                    </tr>
              </tfooter>
        </table>
    </div>
</div>
@endsection
