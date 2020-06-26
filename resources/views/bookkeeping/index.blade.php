@extends('layouts.app')
@section('title')Bookkeeping @endsection
@section('titlepage')<h1>Bookkeeping</h1>@endsection
@section('breadcrumb-link')bookkeeping @endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Bookkeeping for this month</h3>
        </div>
        <div class="card-body">
          <div class="" id="Bookkeeping">
            <img src="{{asset('public/image/logo.png')}}" alt="" height="80px">
            <hr>
            <h5>Bookkeeping Alfa Design</h5>
            <div class="row ml-3">
              <div class="col">
                <div class="row">
                  <div class="col-xs-2">
                    Year
                  </div>
                  <div class="col-xs-1">
                    :
                  </div>
                  <div class="col">
                    <div class="" id="year"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-2">
                    Month
                  </div>
                  <div class="col-xs-1">
                    :
                  </div>
                  <div class="col">
                    <div class="" id="month"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-2">
                    Name
                  </div>
                  <div class="col-xs-1">
                    :
                  </div>
                  <div class="col">
                    {{ Auth::user()->name}}
                  </div>
                </div>
              </div>
              <div class="col">
                <p>Email : {{ Auth::user()->email}} <br><b>Profit : </b>{{ $creations->sum('price')*50/100 }} <br><b>Total Creation : </b>{{ $creations->count() }} </p>
              </div>
            </div>
            <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Total Creation</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                @foreach($category as $ct)
                <tr>
                  <td>{{ $ct->name }}</td>
                  <td>{{ $ct->price }}</td>
                  <td>{{ $creations->where('category_name', $ct->name )->count()}}</td>
                  <td>{{ $ct->price * $creations->where('category_name',$ct->name)->count()}}</td>
                </tr>
                @endforeach
                <tr class="">
                  <td colspan="2"></td>
                  <td >
                    <b>Income :</b>
                  </td>
                  <td>Rp.{{ $creations->sum('price') }} / 50%</td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                  <td >
                    <b>Total :</b>
                  </td>
                  <td>Rp.{{ $creations->sum('price')*50/100 }}</td>
                </tr>
              </tbody>
            </table>
            <br>
            <hr>
          </div>
          <br>
          <button type="button" class="btn btn-outline-info" onclick="printJS({
           printable:'Bookkeeping',documentTitle:'Bookkeping',type: 'html',css:['https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',],})"><i class="fas fa-print"></i> Print</button>
          <div class="float-right">
            <button type="button" class="btn btn-primary" name="button"><i class="fas fa-download"></i> Download PDF</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Custem Bookkeeping</h3>
        </div>
        <div class="card-body">
          <form class="" action="{{route('bookkeeping.index')}}">
            <div class="row">
            <div class="col-md-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="dateStart" id="dateStart" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="text-center">
                <b>To</b>
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" name="dateEnd" />
              </div>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
          </form>
          <br>
          <div class="container-fluid">
            <div class="" id="custumBookkeeping">
              <img src="{{asset('public/image/logo.png')}}" alt="" height="80px">
              <hr>
              <h5>Bookkeeping Alfa Design</h5>
              <table class="table table-borderless">
              </table>
              <div class="row">
                <div class="col pl-4">
                  <div class="row">
                    <div class="col-xs-2">
                      Date
                    </div>
                    <div class="col-xs-1">
                      :
                    </div>
                    <div class="col">
                      {{ $prindata }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-2">
                      Name
                    </div>
                    <div class="col-xs-1">
                      :
                    </div>
                    <div class="col">
                      {{ Auth::user()->name}}
                    </div>
                  </div>
                </div>
                <div class="col ">
                  <p>Email : {{ Auth::user()->email}} <br><b>Profit : </b>{{ $wherecreations->sum('price')*50/100 }} <br><b>Total Creation : </b>{{ $wherecreations->count() }} </p>
                </div>
              </div>
              <table class="table table-striped table-bordered ">
                <thead class="thead-dark">
                  <tr>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Total Creation</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($category as $ct)
                  <tr>
                    <td>{{ $ct->name }}</td>
                    <td>{{ $ct->price }}</td>
                    <td>{{ $wherecreations->where('category_name',$ct->name)->count()}}</td>
                    <td>{{ $ct->price * $wherecreations->where('category_name',$ct->name)->count()}}</td>
                  </tr>
                  @endforeach
                  <tr class="">
                    <td colspan="2"></td>
                    <td >
                      <b>Income :</b>
                    </td>
                    <td>Rp.{{ $wherecreations->sum('price') }} / 50%</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td >
                      <b>Total :</b>
                    </td>
                    <td>Rp.{{ $wherecreations->sum('price')*50/100 }}</td>
                  </tr>
                </tbody>
              </table>
              <br>
              <hr>
              </div>
            </div>
            <button type="button" class="btn btn-outline-info" onclick="printJS({
             printable:'custumBookkeeping',type: 'html',css:'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'})"><i class="fas fa-print"></i> Print</button>
            <div class="float-right">
              <button type="button" class="btn btn-primary" name="button"><i class="fas fa-download"></i>   Download PDF</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
function Year() {
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("year").innerHTML = n;
}
function Month(){
  var d = new Date();
  var n = d.getMonth();
  var months = [];
  var selectedMonthName = months.push(moment().month(n).format("MMMM"));
  document.getElementById("month").innerHTML = months;
}
  $( document ).ready(function(){
    Year();
    Month();
    var date = $(function() {
      $('input[name="dateStart"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
      });
    });
    $('#dateStart').on("change",function(){
      var dateStart = $('#dateStart').val();
      $('input[name="dateEnd"]').daterangepicker({
        minDate: dateStart,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
      });
    })
    $(function() {
    });
  });
</script>
@endsection
