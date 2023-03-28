@extends('admin.master')

@section('title')
  Customers
@endsection

@section('page-content')
<h2 class="mt-4">Customers</h2>
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
          Add Customer
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="post" action="{{url('customers')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body p-4">
                          <div class="form-group row">
                              <label>Customer :</label>
                              <input type="text" name="customer" class="form-control mb-2" placeholder="Customer" required="">
                          </div>
                          <div class="form-group row">
                              <label>Customer Type :</label>
                              <input type="text" name="customer_type" class="form-control mb-2" placeholder="Customer Type" required="">
                          </div>
                          <div class="form-group row">
                              <label>Customer Location:</label>
                              <input type="text" name="customer_location" class="form-control mb-2" placeholder="Customer Location" required="">
                          </div>
                          <div class="form-group row">
                              <label>Phone:</label>
                              <input type="text" name="phone" class="form-control mb-2" placeholder="Customer Phone">
                          </div>
                          <div class="form-group row">
                              <label>Note:</label>
                              <textarea name="note" class="form-control mb-2" placeholder="Optional"></textarea>
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
                      <th>Customer</th>
                      <th>Customer Type</th>
                      <th>Customer Location</th>
                      <th>Phone</th>
                      <th>Note</th>
                      <th>Action</th>
                  </tr>
              </thead>
            <tbody>
                    @if($customers!=null)
                    @foreach($customers as $c)
                    <tr>
                      <td>
                        {{$loop->iteration}}
                      </td>
                      <td>
                        {{$c->customer}}
                      </td>
                      <td>
                        {{$c->customer_type}}
                      </td>
                      <td>
                        {{$c->customer_location}}
                      </td>
                      <td>
                        {{$c->phone}}
                      </td>
                      <td>
                        {{$c->note}}
                      </td>
                      <td>
                        <a href="" data-bs-toggle="modal" title="view" style="color:gray; text-decoration: none;" data-bs-target="#view{{$c->id}}">
                          <i class="fas fa-eye"></i>
                        </a>
                        <div class="modal fade" id="view{{$c->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">View Customer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="form-group row">
                                        <label>Customer :</label>
                                        <input type="text" name="customer" class="form-control mb-2" readonly="" value="{{$c->customer}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Customer Type :</label>
                                        <input type="text" name="customer_type" class="form-control mb-2" readonly="" value="{{$c->customer_type}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Customer Location :</label>
                                        <input type="text" name="customer_location" class="form-control mb-2" readonly="" value="{{$c->customer_location}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Phone :</label>
                                        <input type="text" name="phone" class="form-control mb-2" readonly="" value="{{$c->phone}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Note :</label>
                                        <textarea name="note" class="form-control mb-2" readonly="">{{$c->note}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                          </div>
                        </div>
                        &nbsp&nbsp&nbsp
                        <a href="" data-bs-toggle="modal" title="edit" style="text-decoration: none;" data-bs-target="#edit{{$c->id}}">
                          <i class="fas fa-edit"></i>
                        </a>
                        <div class="modal fade" id="edit{{$c->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form method="post" action="{{url('customers', $c->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="form-group row">
                                            <label>Customer :</label>
                                            <input type="text" name="customer" class="form-control mb-2" required="" value="{{$c->customer}}">
                                        </div>
                                        <div class="form-group row">
                                            <label>Customer Type :</label>
                                            <input type="text" name="customer_type" class="form-control mb-2" required="" value="{{$c->customer_type}}">
                                        </div>
                                        <div class="form-group row">
                                            <label>Customer Location :</label>
                                            <input type="text" name="customer_location" class="form-control mb-2" required="" value="{{$c->customer_location}}">
                                        </div>
                                        <div class="form-group row">
                                            <label>Phone :</label>
                                            <input type="text" name="phone" class="form-control mb-2" value="{{$c->phone}}">
                                        </div>
                                        <div class="form-group row">
                                            <label>Note :</label>
                                            <textarea name="note" class="form-control mb-2" placeHolder="optional">{{$c->note}}</textarea>
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
                        <form style="display: inline; text-decoration: none;" method="post" action="{{url('customers',$c->id)}}" enctype="multipart/form-data">
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
@endsection
