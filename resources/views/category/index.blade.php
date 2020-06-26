@extends ('layouts.app')
@section('title')Category @endsection
@section('titlepage') <h1>Category</h1> @endsection
@section('breadcrumb-link') category @endsection
@section('content')
@if(session('status'))
  <div class="alert alert-success">
    {{session('status')}}
  </div>
@endif
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">List Of Categories</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
              Add Category +
            </button>
            <div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <input type="text" class="form-control {{$errors->first('category_name') ? "is-invalid": ""}}" name="category_name" value="{{ old('category_name') }}">
                              <div class="invalid-feedback">
                                {{$errors->first('category_name')}}
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">price</label>
                              <input type="number" name="price" value="{{ old('price') }}" class="form-control {{$errors->first('category_name') ? "is-invalid": ""}}">
                              <div class="invalid-feedback">
                                {{$errors->first('price')}}
                              </div>
                            </div>
                            <input type="text" name="form_category" value="" hidden>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
              </div>
              </div>
            </div>
            <thead>
              <tr>
                <th>Name Caregory</th>
                <th>Price</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
                @foreach( $category as $c )
                  <tr>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->price }}</td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <form class="d-inline" action="{{route('category.delete-permanent',$c->id )}}" method="post"  onsubmit="return confirm('Are you sure you want to permanently delete this file ?')">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
