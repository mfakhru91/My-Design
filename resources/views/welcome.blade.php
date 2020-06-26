<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>welcome</title>
    <link rel="stylesheet" href="public\css\bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public\css\welcomestyle.css?v')}}">
  </head>
  <body>
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
            <div class="container-fluid"><a href="#" class="navbar-brand text-uppercase font-weight-bold">Alfa Design</a>
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                      <li class="nav-item active"><a href="#" class="nav-link text-uppercase font-weight-bold">Order <span class="sr-only">(current)</span></a></li>
                      <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">About</a></li>
                      <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">faq</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                      @if (Route::has('login'))
                        @auth
                        <li>
                          <a href="{{ route('home') }}" class="nav-link text-uppercase font-weight-bold" >{{ Auth::user()->name }}</a>
                        </li>
                        <li>
                          @if( Auth::user()->avatar)
                            <i><img src="public/storage/{{ Auth::user()->avatar }}" alt="" class="img-fluid rounded-circle" width="40px">
                          @else
                            <i><img src="public\image\user.png" alt="" class="img-fluid" width="40px"></i>
                          @endif
                        </li>
                        @else
                          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-uppercase font-weight-bold">Login</a></li>
                          @if(Route::has('register'))
                          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link text-uppercase font-weight-bold">Registe</a></li>
                          @endif
                        @endauth
                      @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="jumbotron">
        <div class="row mt-5 mb-5">
          <div class="col-md-7 mb-5">
            <p class="title-1">Alfa<span class="title-2"> Design </span></p>
            <h4>Selamat Datang di Aplikasi Manajemen dan Monitorin Penjualan dan Pembelian Buah salak</h4>
            <form class="" action="index.html" method="post">
              <div class="input-group mb-3 input-group-lg">
                <input type="text" class="form-control" placeholder="Search Iamge" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-info" type="submit">Search</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6 mb-5">
          </div>
        </div>
    </div>
    <!-- content -->
    <div class="container">
        <div class="card-columns">
          @foreach( $creations as $cr )
          <div class="card">
              <a href="" data-toggle="modal" data-target="#view-{{ $cr->id }}"><img src="public\storage\{{ $cr->image }}" alt="..."  class="img-fluid" ></a>
              <!-- <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div> -->
          </div>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="view-{{ $cr->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">{{$cr->name}}( {{ $cr->categoriesName }} )</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="text-center">
                      <img src="public\storage\{{ $cr->image }}" alt="view_image" style=" width: 500px" >
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
    </div>
    <!-- end content -->
    <!-- jQuery -->
    <script src="\LTE\plugins\jquery\jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="\LTE\plugins\bootstrap\js\bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="\LTE\dist\js\adminlte.min.js"></script>
    <!-- DataTable -->
    <script type="\LTE\plugins\datatables\jquery.dataTables.min.js"></script>
    <script type="\LTE\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script type="\LTE\plugins\datatables-responsive\js\dataTables.responsive.min.js"></script>
    <script type="\LTE\plugins\datatables-responsive\js\responsive.bootstrap4.js"></script>
  <script type="text/javascript">
      $(function () {
      $(window).on('scroll', function () {
              if ( $(window).scrollTop() > 10 ) {
                  $('.navbar').addClass('active');
              } else {
                  $('.navbar').removeClass('active');
              }
          });
        });
  </script>
  </body>
</html>
