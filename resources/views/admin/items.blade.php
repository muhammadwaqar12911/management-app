@extends('admin.master')

@section('title')
  Items
@endsection

@section('page-content')
<h2 class="mt-4">Items</h2>
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
          Add Item
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form method="post" action="{{url('items')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body p-4">
                          <div class="form-group row">
                              <label>item :</label>
                              <input type="text" name="item" class="form-control mb-2 mb-2" placeholder="Item" required="">
                          </div>
                          <div class="form-group row">
                              <label>item Type :</label>
                                <select class="form-select mb-2" name="item_type" required>
                                    <option value="">Select Item Type</option>
                                    <option value="RFC">RFC</option>
                                    <option value="UFC">UFC</option>
                                    <option value="NC-0">NC-0</option>
                                    <option value="R8">R8</option>
                                    <option value="R4">R4</option>
                                    <option value="LAQ">LAQ</option>
                                </select> 
                          </div>
                          <div class="form-group row">
                              <label>Item Note :</label>
                              <textarea name="item_note" class="form-control mb-2" placeHolder="optional"></textarea>
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
                      <th>Item</th>
                      <th>Item Type</th>
                      <th>Item Note</th>
                      <th>Action</th>
                  </tr>
              </thead>
            <tbody>
                    @if($items!=null)
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
                        {{$i->item_note}}
                      </td>
                      <td>
                        <a href="" data-bs-toggle="modal" title="view" style="color:gray; text-decoration: none;" data-bs-target="#view{{$i->id}}">
                          <i class="fas fa-eye"></i>
                        </a>
                        <div class="modal fade" id="view{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">View Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="form-group row">
                                        <label>Item :</label>
                                        <input type="text" name="item" class="form-control mb-2" readonly="" value="{{$i->item}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Item Type :</label>
                                        <input type="text" name="item_type" class="form-control mb-2" readonly="" value="{{$i->item_type}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>Item Note :</label>
                                        <textarea name="item_note" class="form-control mb-2" readonly>{{$i->item_note}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                          </div>
                        </div>
                        &nbsp&nbsp&nbsp
                        <a href="" data-bs-toggle="modal" title="edit" style="text-decoration: none;" data-bs-target="#edit{{$i->id}}">
                          <i class="fas fa-edit"></i>
                        </a>
                        <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <form method="post" action="{{url('items', $i->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="form-group row">
                                            <label>Item :</label>
                                            <input type="text" name="item" class="form-control mb-2" required="" value="{{$i->item}}">
                                        </div>
                                        <div class="form-group row">
                                            <label>Item Type</label>
                                            <select class="form-select mb-2" name="item_type" required>
                                                <option value="RFC" <?php if($i->item_type=='RFC') echo('selected')?>>RFC</option>
                                                <option value="UFC" <?php if($i->item_type=='UFC') echo('selected')?>>UFC</option>
                                                <option value="NC-0" <?php if($i->item_type=='NC-0') echo('selected')?>>NC-0</option>
                                                <option value="R8" <?php if($i->item_type=='R8') echo('selected')?>>R8</option>
                                                <option value="R4" <?php if($i->item_type=='R4') echo('selected')?>>R4</option>
                                                <option value="LAQ" <?php if($i->item_type=='LAQ') echo('selected')?>>LAQ</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label>Item Note :</label>
                                            <textarea name="item_note" class="form-control mb-2" placeHolder="optional">{{$i->item_note}}</textarea>
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
                        <form style="display: inline; text-decoration: none;" method="post" action="{{url('items',$i->id)}}" enctype="multipart/form-data">
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
