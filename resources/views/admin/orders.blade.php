@extends('admin.master')

@section('title')
  Orders
@endsection
@section('head')
	<script type="text/javascript">
    function addItem() {
			var itemsContainer = document.getElementById("items");
			var newItem = document.createElement("div");
			newItem.innerHTML = '<hr><div class="row"><div class="col-md-6">'+
                                      '<select class="form-select mb-2" onchange="itemFunc()" name="item_id[]" required>'+
                                      '@if($items)'+
                                      '<option value="">select item</option>'+
                                      '@foreach($items as $i)'+
                                      '<option value="{{$i->id}}" data-type="{{$i->item_type}}">{{$i->item}}</option>'+
                                      '@endforeach'+
                                      '@else'+
                                      '<option value="">no item found</option>'+
                                      '@endif'+
                                    '</select>'+
                                    '<select class="form-select mb-2" name="packing[]" required><option value="">Select Packing</option><option value="50 gms">50 Gms</option><option value="100 gms">100 Gms</option><option value="250 gms">250 Gms</option><option value="500 gms">500 Gms</option><option value="1 ltr">1 Lts</option><option value="5 ltr">5 Lts</option><option value="20 ltr">20 Lts</option></select>'+
                                    '<input type="number" min="1" name="quantity[]" class="form-control mb-2 my-2" placeholder="Quantity" required>'+
                                  '</div><div class="col-md-6">'+
                                    '<input type="text" readonly required name="item_type[]" class="form-control mb-2" placeHolder="Item Type">'+
                                    '<select class="form-select mb-2" name="unit[]" required>'+
                                      '<option value="">Select Unit</option>'+
                                      '<option value="kgs">Kgs</option>'+
                                      '<option value="lts">Itr</option>'+
                                    '</select>'+
                                    '<input type="text" name="rate[]" class="form-control mb-2 my-2" placeholder="Rate" required>'+
                                    '<button type="button" class="my-2" style="float:right;" onclick="removeItem(this)">Remove</button>'+
                                  '</div>'+
                                '</div>';
			itemsContainer.appendChild(newItem); // add the new item to the items container
		}

		function removeItem(button) {
			var itemsContainer = document.getElementById("items");
			var item = button.parentNode.parentNode.parentNode; // get the parent item div of the button
			itemsContainer.removeChild(item); // remove the item div from the items container
		}

    function addItem2(id) {
			var itemsContainer = document.getElementById("items2"+id);
			var newItem = document.createElement("div"); 
			newItem.innerHTML = '<hr><div class="row"><div class="col-md-6">'+
                                      '<select class="form-select mb-2" onchange="itemFunc()" name="item_id[]" required>'+
                                      '@if($items)'+
                                      '<option value="">select item</option>'+
                                      '@foreach($items as $i)'+
                                      '<option value="{{$i->id}}" data-type="{{$i->item_type}}">{{$i->item}}</option>'+
                                      '@endforeach'+
                                      '@else'+
                                      '<option value="">no item found</option>'+
                                      '@endif'+
                                    '</select>'+
                                    '<select class="form-select mb-2" name="packing[]" required><option value="">Select Packing</option><option value="50 gms">50 Gms</option><option value="100 gms">100 Gms</option><option value="250 gms">250 Gms</option><option value="500 gms">500 Gms</option><option value="1 ltr">1 Lts</option><option value="5 ltr">5 Lts</option><option value="20 ltr">20 Lts</option></select>'+
                                    '<input type="number" min="1" name="quantity[]" class="form-control mb-2 my-2" placeholder="Quantity" required>'+
                                  '</div><div class="col-md-6">'+
                                    '<input type="text" readonly required name="item_type[]" class="form-control mb-2" placeHolder="Item Type">'+
                                    '<select class="form-select mb-2" name="unit[]" required>'+
                                      '<option value="">Select Unit</option>'+
                                      '<option value="kgs">Kgs</option>'+
                                      '<option value="lts">Itr</option>'+
                                    '</select>'+
                                    '<input type="text" name="rate[]" class="form-control mb-2 my-2" placeholder="Rate" required>'+
                                    '<button type="button" data-id="'+id+'" class="my-2" style="float:right;" onclick="removeItem2(this)">Remove</button>'+
                                  '</div>'+
                                '</div>';
			itemsContainer.appendChild(newItem); // add the new item to the items container
		}

		function removeItem2(button) {
			var itemsContainer = document.getElementById("items2"+button.getAttribute("data-id"));
			var item = button.parentNode.parentNode.parentNode; // get the parent item div of the button
			itemsContainer.removeChild(item); // remove the item div from the items container
		}
</script>
@endsection

@section('page-content')
<h2 class="mt-4">Orders</h2>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-3"></div>
    @if(Session::get('fail'))
    <div class="col-md-6">
        <div class="alert bg-danger text-center" style="color: white;">
            {{Session::get('fail')}}
        </div>
    </div>
    @endif
    @if ($errors->any())
    <div class="col-md-6">
        <div class="alert bg-danger text-center" style="color: white;">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    </div>
    @endif
    @if(Session::get('success'))
    <div class="col-md-6">
        <div class="alert bg-success text-center" style=" color: white;">
            {{Session::get('success')}}
        </div>
    </div>
    @endif 
    <div class="col-md-3"></div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <button class="btn text-white bg-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add Order
        </button>
        <a class="btn text-white bg-primary mx-2" style="float: right;" href="{{url('download')}}">
          Download
        </a>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="post" action="{{url('orders')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body p-4">
                          <div class="form-group row">
                              <label>User :</label>
                              <select class="form-select mb-2" name="user_id" required>
                                @if(count($users))
                                @foreach($users as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                                @endforeach
                                @else
                                <option value="">no user found</option>
                                @endif
                              </select>
                          </div>
                          <div class="form-group row">
                              <label>Order Date :</label>
                              <input type="date" value="{{date('Y-m-d')}}" name="order_date" class="form-control mb-2" placeholder="Order Date" required="">
                          </div>
                          <div class="form-group row">
                              <label>Delivery Date :</label>
                              <input type="date" value="{{date('Y-m-d')}}" name="delivery_date" class="form-control mb-2" placeholder="Delivery Date" required="">
                          </div>
                          <div class="form-group row">
                              <label>Runner :</label>
                              <select class="form-select mb-2" id="runner" name="runner_id" required>
                                @if(count($runners))
                                <option value="">select runner</option>
                                @foreach($runners as $r)
                                <option value="{{$r->id}}">{{$r->runner}}</option>
                                @endforeach
                                @else
                                <option value="">no runner found</option>
                                @endif
                              </select>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-4 p-1">
                              <label>Customer :</label>
                              <select class="form-select mb-2" id="customer" name="customer_id" required>
                                @if(count($customers))
                                <option value="">select customer</option>
                                @foreach($customers as $c)
                                <option value="{{$c->id}}" data-type="{{$c->customer_type}}" data-location="{{$c->customer_location}}">{{$c->customer}}</option>
                                @endforeach
                                @else
                                <option value="">no customer found</option>
                                @endif
                              </select>
                            </div>
                            <div class="col-md-4 p-1">
                              <label>Custoemr Type :</label>
                              <input type="text" placeHolder="Customer Type" readonly name="customer_type" id="customer_type" class="form-control">
                            </div>
                            <div class="col-md-4 p-1">
                              <label>Customer Location :</label>
                              <input type="text" placeHolder="Customer Location" readonly name="customer_location" id="customer_location" class="form-control">
                            </div>
                          </div>
                          <div class="form-group row">
                              <label>Area :</label>
                              <input type="text" name="area" class="form-control mb-2" placeholder="Area">
                          </div>
                          <div class="form-group row">
                              <label>Status :</label>
                              <select class="form-select mb-2" name="status" required>
                                <option value="new">New</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                                <option value="cancelled">Cancelled</option>
                              </select>
                          </div>
                          <div class="form-group row">
                              <label>Note :</label>
                              <textarea name="note" class="form-control mb-2" placeholder="Optional"></textarea>
                          </div>
                          <div class="form-group row">
                              <label>Items :</label>
                              <div id="items">
                                <div class="row">
                                  <div class="col-md-6">
                                    <select class="form-select mb-2" onchange="itemFunc()" name="item_id[]" required>
                                      @if(count($items))
                                      <option value="">select item</option>
                                      @foreach($items as $i)
                                      <option value="{{$i->id}}" data-type="{{$i->item_type}}">{{$i->item}}</option>
                                      @endforeach
                                      @else
                                      <option value="">no item found</option>
                                      @endif
                                    </select>
                                    <select class="form-select mb-2" name="packing[]" required>
                                      <option value="">Select Packing</option>
                                      <option value="50 gms">50 Gms</option>
                                      <option value="100 gms">100 Gms</option>
                                      <option value="250 gms">250 Gms</option>
                                      <option value="500 gms">500 Gms</option>
                                      <option value="1 ltr">1 Lts</option>
                                      <option value="5 ltr">5 Lts</option>
                                      <option value="20 ltr">20 Lts</option>
                                    </select> 
                                    <input type="number" min="1" name="quantity[]" class="form-control mb-2" placeholder="Quantity" required>
                                  </div>
                                  <div class="col-md-6">
                                    <input type="text" readonly required name="item_type[]" class="form-control mb-2" placeHolder="Item Type">
                                    <select class="form-select mb-2" name="unit[]" required>
                                      <option value="">Select Unit</option>
                                      <option value="kgs">Kgs</option>
                                      <option value="lts">Itr</option>
                                    </select>
                                    <input type="text" name="rate[]" class="form-control mb-2" placeholder="Rate" required>
                                  </div>
                                </div>
                              </div>
                              <button type="button" class="mt-2 w-25 mx-2" onclick="addItem()">Add Item</button>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <input type="submit" name="upload" id="upload" class="btn text-white bg-primary" value="Upload">
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Runner</th>
                      <th>Customer</th>
                      <th>Total Amount</th>
                      <th>Order Date</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
            <tbody>
                    @if($orders!=null)
                    @foreach($orders as $o)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$o->user->name}}
                      </td>
                      <td>
                        {{$o->runner->runner}}
                      </td>
                      <td>
                        {{$o->customer->customer}}
                      </td>
                      <td>
                        {{number_format($o->total, 2, '.', ',')}}
                      </td>
                      <td>
                        {{$o->order_date}}
                      </td>
                      <td>
                        {{$o->status}}
                      </td>
                      <td>
                        <a href="" data-bs-toggle="modal" title="view" style="color:gray; text-decoration: none;" data-bs-target="#view{{$o->id}}">
                          <i class="fas fa-eye"></i>
                        </a>
                        <div class="modal fade" id="view{{$o->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">View Order</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="form-group row">
                                        <label>User :</label>
                                        <input type="text" name="user" class="form-control mb-2" readonly="" value="{{$o->user->name}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Order Date :</label>
                                        <input type="date" name="order_date" class="form-control mb-2" readonly="" value="{{$o->order_date}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Delivery Date :</label>
                                        <input type="date" name="delivery_date" class="form-control mb-2" readonly="" value="{{$o->delivery_date}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Runner :</label>
                                        <input type="text" name="runner" class="form-control mb-2" readonly="" value="{{$o->runner->runner}}">
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-md-4 p-1">
                                        <label>Customer :</label>
                                        <input type="text" name="customer" class="form-control mb-2" readonly="" value="{{$o->customer->customer}}">
                                      </div>
                                      <div class="col-md-4 p-1">
                                        <label>Customer Type:</label>
                                        <input type="text" name="customer_type" class="form-control mb-2" readonly="" value="{{$o->customer->customer_type}}">
                                      </div>
                                      <div class="col-md-4 p-1">
                                        <label>Location :</label>
                                        <input type="text" name="customer_location" class="form-control mb-2" readonly="" value="{{$o->customer->customer_location}}">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label>Customer Phone :</label>
                                        <input type="text" name="phone" class="form-control mb-2" readonly="" value="{{$o->customer->phone}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Customer Note :</label>
                                        <input type="text" name="note" class="form-control mb-2" readonly="" value="{{$o->customer->note}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Area :</label>
                                        <input type="text" name="area" class="form-control mb-2" readonly="" value="{{$o->area}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Total Amount:</label>
                                        <input type="text" min="0" name="total" class="form-control mb-2" readonly="" value="{{number_format($o->total, 2, '.', ',')}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Status :</label>
                                        <select class="form-select mb-2" name="status" disabled>
                                          <option value="{{$o->status}}">{{$o->status}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label>Note :</label>
                                        <textarea name="note" readonly class="form-control mb-2" placeholder="Optional">{{$o->note}}</textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label>Items :</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="datatablesSimple" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Item</th>
                                                            <th>Item Type</th>
                                                            <th>Item Note</th>
                                                            <th>Quantity</th>
                                                            <th>Rate</th>
                                                            <th>Unit</th>
                                                            <th>Packing</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($o->order_items as $oi)
                                                        <tr>
                                                          <td>
                                                              {{$loop->iteration}}
                                                          </td>
                                                          <td>
                                                              {{$oi->item->item}}
                                                          </td>
                                                          <td>
                                                              {{$oi->item->item_type}}
                                                          </td>
                                                          <td>
                                                              {{$oi->item->item_note}}
                                                          </td>
                                                          <td>
                                                              {{$oi->quantity}}
                                                          </td>
                                                          <td>
                                                              {{$oi->rate}}
                                                          </td>
                                                          <td>
                                                              {{$oi->unit}}
                                                          </td>
                                                          <td>
                                                              {{$oi->packing}}
                                                          </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                          </div>
                        </div>
                        &nbsp&nbsp&nbsp
                        <a href="" data-bs-toggle="modal" title="edit" style="text-decoration: none;" data-bs-target="#edit{{$o->id}}">
                          <i class="fas fa-edit"></i>
                        </a>
                        <div class="modal fade" id="edit{{$o->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form method="post" action="{{url('orders', $o->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="form-group row">
                                            <label>User :</label>
                                            <select class="form-select mb-2" name="user_id" required>
                                              @foreach($users as $u)
                                              <option value="{{$u->id}}" <?php if($o->user_id==$u->id) echo('selected')?>>{{$u->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label>Order Date :</label>
                                            <input type="date" name="order_date" value="{{$o->order_date}}" class="form-control mb-2" required="">
                                        </div>
                                        <div class="form-group row">
                                            <label>Delivery Date :</label>
                                            <input type="date" name="delivery_date" value="{{$o->delivery_date}}" class="form-control mb-2" required="">
                                        </div>
                                        <div class="form-group row">
                                            <label>Runner :</label>
                                            <select class="form-select mb-2" id="runner{{$o->id}}" name="runner_id" required>
                                              @foreach($runners as $r)
                                              <option value="{{$r->id}}" <?php if($o->runner_id==$r->id) echo('selected')?>>{{$r->runner}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-md-4 p-1">
                                            <label>Customer :</label>
                                            <select class="form-select mb-2" onchange="customerFunc({{$o->id}})" id="customer{{$o->id}}" name="customer_id" required>
                                              @foreach($customers as $c)
                                              <option value="{{$c->id}}" data-type="{{$c->customer_type}}" data-location="{{$c->customer_location}}" <?php if($o->customer_id==$c->id) echo('selected')?>>{{$c->customer}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-md-4 p-1">
                                            <label>Customer Type:</label>
                                            <input type="text" name="customer_type" id="customer_type{{$o->id}}" class="form-control mb-2" required readonly="" value="{{$o->customer->customer_type}}">
                                          </div>
                                          <div class="col-md-4 p-1">
                                            <label>Location :</label>
                                            <input type="text" name="customer_location" id="customer_location{{$o->id}}" class="form-control mb-2" required readonly="" value="{{$o->customer->customer_location}}">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label>Area :</label>
                                            <input type="text" name="area" value="{{$o->area}}" class="form-control mb-2" placeholder="Area">
                                        </div>
                                        <div class="form-group row">
                                            <label>Status :</label>
                                            <select class="form-select mb-2" name="status" required>
                                              <option value="new" <?php if($o->status=='new') echo('selected')?>>New</option>
                                              <option value="processing" <?php if($o->status=='processing') echo('selected')?>>Processing</option>
                                              <option value="completed" <?php if($o->status=='completed') echo('selected')?>>Completed</option>
                                              <option value="on_hold" <?php if($o->status=='on_hold') echo('selected')?>>On Hold</option>
                                              <option value="cancelled" <?php if($o->status=='cancelled') echo('selected')?>>Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label>Note :</label>
                                            <textarea name="note" class="form-control mb-2" placeholder="Optional">{{$o->note}}</textarea>
                                        </div>
                                        <div class="form-group row">
                                            <label>Items :</label>
                                            <div id="items2{{$o->id}}">
                                              @foreach($o->order_items as $oi)
                                              <div><hr>
                                                <div class="row">
                                                  <div class="col-md-6">
                                                    <label>Item :</label>
                                                    <select class="form-select mb-2" onchange="itemFunc()" name="item_id[]" required>
                                                      @foreach($items as $i)
                                                      <option value="{{$i->id}}" data-type="{{$i->item_type}}" <?php if($i->id==$oi->item_id) echo('selected')?>>{{$i->item}}</option>
                                                      @endforeach
                                                    </select>
                                                    <label>Packing</label>
                                                    <select class="form-select mb-2" name="packing[]" required>
                                                      <option value="50 gms" <?php if($oi->packing=='50 gms') echo('selected')?>>50 Gms</option>
                                                      <option value="100 gms" <?php if($oi->packing=='100 gms') echo('selected')?>>100 Gms</option>
                                                      <option value="250 gms" <?php if($oi->packing=='250 gms') echo('selected')?>>250 Gms</option>
                                                      <option value="500 gms" <?php if($oi->packing=='500 gms') echo('selected')?>>500 Gms</option>
                                                      <option value="1 ltr" <?php if($oi->packing=='1 ltr') echo('selected')?>>1 Lts</option>
                                                      <option value="5 ltr" <?php if($oi->packing=='5 ltr') echo('selected')?>>5 Lts</option>
                                                      <option value="20 ltr" <?php if($oi->packing=='20 ltr') echo('selected')?>>20 Lts</option>
                                                    </select> 
                                                    <label>Quantity</label>
                                                    <input type="number" min="1" value="{{$oi->quantity}}" name="quantity[]" class="form-control mb-2 my-2" placeholder="Quantity" required>
                                                    
                                                  </div>
                                                  <div class="col-md-6">
                                                    <label>Item Type</label>
                                                    <input name="item_type[]" type="text" class="form-control mb-2" required readonly value="{{$oi->item->item_type}}">
                                                    <label>Unit</label>
                                                    <select class="form-select mb-2" name="unit[]" required>
                                                      <option value="kgs" <?php if($oi->unit=='kgs') echo('selected')?>>Kgs</option>
                                                      <option value="lts" <?php if($oi->unit=='lts') echo('selected')?>>Itr</option>
                                                    </select>
                                                    <label>Rate</label>
                                                    <input type="text" name="rate[]" value="{{$oi->rate}}" class="form-control mb-2 my-2" placeholder="Rate" required>
                                                    @if($loop->iteration!='1')
                                                    <button type="button" data-id="{{$o->id}}" class="my-2" style="float:right;" onclick="removeItem2(this)">Remove</button>
                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                              @endforeach
                                            </div>
                                            <button type="button" class="mt-2 w-25 mx-2" onclick="addItem2({{$o->id}})">Add Item</button>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" name="upload" id="upload" class="btn text-white btn-primary" value="Update">
                                    </div>
                                </form>
                              </div>
                          </div>
                        </div>
                        <form style="display: inline; text-decoration: none;" method="post" action="{{url('orders',$o->id)}}" enctype="multipart/form-data">
                          @method('Delete')
                          @csrf
                          <button title="delete" class="btn" style="color:red;">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                    @endif
              </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#customer').on('change', function(){
            var type = $(this).find(':selected').data('type');
            var location = $(this).find(':selected').data('location');
            $('#customer_type').val(type);
            $('#customer_location').val(location);
        });
    } );
</script>
<script>
  function customerFunc(id) {
			var customer = document.getElementById("customer"+id);
      var type = customer.find(':selected').data('type');
      var location = customer.find(':selected').data('location');
      $('#customer_type'+id).val(type);
      $('#customer_location'+id).val(location);
		}

  function itemFunc()
  {
    for (var i = 0; i < $('select[name="item_id[]"]').length; i++) {
        var type = $('select[name="item_id[]"]:eq('+i+')').find(':selected').data('type');
        $('input[name="item_type[]"]:eq('+i+')').val(type);
    }
  }
</script>
@endsection
