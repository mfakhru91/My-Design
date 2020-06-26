@extends('layouts.app')
@section('title')Profile @endsection
@section('titlepage') <h1>Profile</h1> @endsection
@section('breadcrumb-link') profile @endsection
@section('content')

  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if( $profil->avatar)
                    <button type="button" class="btn" data-toggle="modal" data-target="#editAvatar-{{ $profil->id }}"><img src="public/storage/{{ $profil->avatar }}" class="img-circle" alt="" width="100px" height="100px"
                      style=" object-fit: cover; "></button>
                  @else
                    <a href="" class="btn" data-toggle="modal" data-target="#editAvatar-{{ $profil->id }}"><img src="public/image/user.png" alt="" width="100px"></a>
                  @endif
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editAvatar-{{ $profil->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="" action="{{route('profile.update',$profil->id)}}" method="post" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf
                          <div class="form-group">
                              <label for="exampleInputFile">File input</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="avatar" id="validatedCustomFile" required>
                                  <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                  <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                              </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
                <h3 class="profile-username text-center">{{ $profil->name }}</h3>
                <br>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Creations</b> <a class="float-right">{{ $creation->count() }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Profit</b> <a class="float-right">{{ $creation->sum('price')*50/100 }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Transaction</b> <a class="float-right">{{ $transaction->count() }}</a>
                  </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block"><i class="fas fa-pencil-alt"></i> <b>Edit</b><ion-icon name="create-outline"></ion-icon></a>
              </div>
              <!-- /.card-body -->
            </div>
    </div>
    <div class="col-md-9">
      <div class="card card-primary card-outline">
        <div class="">
          <img src="public\image\404background.jpg" alt="" style=" width:100%; height:200px;  object-fit: cover; position: auto">
        </div>
        <div class="card-body">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td width="10px">Name</td>
                <td width="10px">:</td>
                <td>{{ Auth::user()->name }}</td>
              </tr>
              <tr>
                <td width="10px">Email</td>
                <td width="10px">:</td>
                <td>{{ Auth::user()->email }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
@endsection
