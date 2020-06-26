@extends('layouts.app')
@section('title')Creation @endsection
@section('titlepage') <h1>Creation</h1> @endsection
@section('breadcrumb-link') creation @endsection
@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="card card-warning">
        <div class="card-header ">
          <h3 class="card-title">Add Creation</h3>
        </div>
          <form class="needs-validation" action="{{route('karya.store')}}" method="post" enctype="multipart/form-data">
          @csrf
        <div class="card-body">
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" value="{{old('name')}}" class="form-control {{$errors->first('name') ? "is-invalid": ""}}" id="name" name="name" >
                  <div class="invalid-feedback">
                    {{$errors->first('name')}}
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="ownerName">Owner name</label>
                  <input type="text" value="{{old('owner_name')}}" class="form-control {{$errors->first('owner_name') ? "is-invalid": ""}}" id="ownerName" name="owner_name" placeholder="Owner name">
                  <div class="invalid-feedback">
                    {{$errors->first('name')}}
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="">Image File</label>
                  <div class="custom-file">
                    <input type="file" value="{{old('avatar')}}" class="custom-file-input {{$errors->first('avatar') ? "is-invalid": ""}}" name="avatar" id="validatedCustomFile">
                    <label class="custom-file-label" for="validatedCustomFile">Choose the image file...</label>
                    <div class="invalid-feedback">
                        {{$errors->first('avatar')}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="fileGdrive">File link</label>
                  <input type="url" value="{{old('link')}}" class="form-control {{$errors->first('link') ? "is-invalid": ""}}" id="ownerName" name="link" placeholder="Image link id" >
                  <div class="invalid-feedback">
                    {{$errors->first('link')}}
                   </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="statusPembayaran">Pembayaran</label>
                  <select class="form-control" name="pembayaran">
                    <option value="paid off">Lunas</option>
                    <option value="debt">Proses</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="optionn">Option</label>
                  <select class="form-control" name="option">
                    <option value="post">Post</option>
                    <option value="save">Save</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="">Categories</label>
                  <div class="input-group mb-3">
                    <select class="form-control" id="category" name="category" onclick="selected()" required>
                      @foreach($category as $k)
                      <option value="{{ $k->name}}">
                            {{ $k->name}} ({{ $k->price }})
                        </option>
                      @endforeach
                    </select>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formother">
                        Other
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary " name="button">Submit</button>
        </div>
      </form>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Job Progress</h3>
          <i class="fas fa-tasks float-right"></i>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @foreach( $progress as $pr )
              <li class="list-group-item">
                {{ $pr->name }} <small>{{ $pr->category_name }}</small>
                <form class="d-inline float-right" action="{{route('karya.delete-permanent',$pr->id )}}" method="post"  onsubmit="return confirm('Are you sure you want to permanently delete this file ?')">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-danger" onsubmit="return confirm('Are you sure you want to delete this job file ?')"><i class="fas fa-trash-alt"></i> </button>
                </form>
                <button type="button" class="btn btn-primary float-right mr-1" data-toggle="modal" data-target="#progress-{{ $pr->id }}"><i class="fas fa-pencil-alt"></i></button>
              </li>
              <div class="modal fade"  id="progress-{{ $pr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{ $pr->name }} ( {{ $pr->category_name}} )</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="" action="{{route('karya.update',$pr->id)}}" method="post" enctype="multipart/form-data" >
                        @method('PUT')
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="avatar" id="validatedCustomFile" value="/storage/{{ $pr->image }}">
                              <label class="custom-file-label" for="validatedCustomFile" >Choose file...</label>
                              <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                          </div>
                        </div>
                          <div class="form-row">
                            <div class="col">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of work" value="{{ $pr->name }}">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="ownerName">Owner name</label>
                                <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Owner name" value="{{ $pr->order_name }}">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="fileGdrive">File link</label>
                            <input type="url" class="form-control" id="ownerName" name="link" placeholder="Image link id" value="{{ $pr->file }}">
                          </div>
                          <div class="form-row">
                            <div class="col">
                              <div class="form-group">
                                <label for="statusPembayaran">Pembayaran</label>
                                <select class="form-control" name="pembayaran">
                                  <option value="paid off"
                                  @if($pr->payment == 'paid off')
                                    selected
                                  @endif
                                  >Lunas</option>
                                  <option value="debt"
                                  @if($pr->payment == 'debt')
                                    selected
                                  @endif
                                  >Proses</option>
                                </select>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label for="optionn">Option</label>
                                <select class="form-control" name="option">
                                  <option value="post"
                                  @if($pr -> option == 'post')
                                    selected
                                  @endif
                                  >Post</option>
                                  <option value="save"
                                  @if($pr-> option == 'save')
                                  selected
                                  @endif
                                  >Save</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col">
                              <div class="form-group">
                                <label for="">Categories</label>
                                <div class="input-group mb-3">
                                  <select class="form-control" id="category" name="category" onclick="selected()">
                                    @foreach($category as $k)
                                    <option value="{{ $k->name}}">
                                          {{ $k->name}} ({{ $k->price }})
                                      </option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary " name="button">Submit</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="formother" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="form-goup">
                  <label for="">name category</label>
                  <input type="text" class="form-control" name="category_name" value="">
                </div>
                <div class="form-group">
                  <label for="">price</label>
                  <input type="number" name="price" value="" class="form-control">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">List of Work</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Owner Name</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $karya as $k )
                  <tr>
                    <td>
                      <img src=" {{ asset('public/storage/' . $k->image) }}" alt="" width="50px">
                    </td>
                    <td> {{ $k->name }} </td>
                    <td> {{ $k->order_name }} </td>
                    <td> <a href="{{ $k->file }}" class="btn btn-primary btn-sm" ><i class="fas fa-link"></i> link</a> </td>
                    <td> {{ $k->option }} </td>
                    <td> {{ $k->payment }} </td>
                    <td>
                      {{ $k->category_name }}
                    </td>
                    <td> Rp.{{ $k->price }} </td>
                    <td>
                      <div class="row">
                        <div class="col-md-3">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#fileshow-{{ $k->id }}" >
                          <i class="fas fa-eye"></i>
                          </button>
                        </div>
                        <div class="col-md-3">
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $k->id }}"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                        <div class="col-md-3">
                          <form class="d-inline" action="{{route('karya.delete-permanent',$k->id )}}" method="post"  onsubmit="return confirm('Are you sure you want to permanently delete this file ?')">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> </button>
                          </form>
                        </div>
                      </div>
                    </td>
                      <!-- Modal Privew -->
                      <div class="modal fade bd-example-modal-lg "  id="fileshow-{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{ $k->name }} ( {{ $k->category_name}} )</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="text-center">
                                <img src="public\storage\{{ $k->image }} " alt="" height="500px">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="{{ $k->file }}" class="btn btn-success">Download</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal Edit -->
                      <div class="modal fade"  id="edit-{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{ $k->name }} ( {{ $k->category_name}} )</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form class="" action="{{route('karya.update',$k->id)}}" method="post" enctype="multipart/form-data" >
                                @method('PUT')
                                @csrf
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-2">
                                    <img src="public/storage/{{ $k->image }}" alt="" width="70px">
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group">
                                      <label for="exampleInputFile">File input</label>
                                      <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="avatar" id="validatedCustomFile" value="/storage/{{ $k->image }}">
                                          <label class="custom-file-label" for="validatedCustomFile" >Choose file...</label>
                                          <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="form-row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of work" value="{{ $k->name }}">
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label for="ownerName">Owner name</label>
                                        <input type="text" class="form-control" id="ownerName" name="owner_name" placeholder="Owner name" value="{{ $k->order_name }}">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="fileGdrive">File link</label>
                                    <input type="url" class="form-control" id="ownerName" name="link" placeholder="Image link id" value="{{ $k->file }}">
                                  </div>
                                  <div class="form-row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label for="statusPembayaran">Pembayaran</label>
                                        <select class="form-control" name="pembayaran">
                                          <option value="paid off"
                                          @if($k->payment == 'paid off')
                                            selected
                                          @endif
                                          >Lunas</option>
                                          <option value="debt"
                                          @if($k->payment == 'debt')
                                            selected
                                          @endif
                                          >Proses</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-group">
                                        <label for="optionn">Option</label>
                                        <select class="form-control" name="option">
                                          <option value="post"
                                          @if($k -> option == 'post')
                                            selected
                                          @endif
                                          >Post</option>
                                          <option value="save"
                                          @if($k -> option == 'save')
                                          selected
                                          @endif
                                          >Save</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="col">
                                      <div class="form-group">
                                        <label for="">Categories</label>
                                        <div class="input-group mb-3">
                                          <select class="form-control" id="category" name="category" onclick="selected()">
                                            @foreach($category as $k)
                                            <option value="{{ $k->name}}">
                                                  {{ $k->name}} ({{ $k->price }})
                                              </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary " name="button">Submit</button>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <br>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <b>Creation This Month : {{ $sumKarya->count() }}</b>
            </div>
            <div class="col-md-3">
               <b>Total price :
                 {{$sumKarya->sum('price')}}
               </b>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    // function selected(){
    //   var formCategory = document.getElementById('formOther');
    //   var selectObjec = document.getElementById('category').value=='other';
    //   if(selectObjec){
    //     formCategory.hidden = false;
    //   }else{
    //     formCategory.hidden = true;
    //   }
    // }
  </script>
@endsection
