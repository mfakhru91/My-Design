<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <body>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-body">
            <img src="{{asset('public/image/logo.png')}}" alt="" height="80px">
            <hr>
            <div class="row">
              <div class="col-md-6">
                <h5>Bookkeeping Alfa Design</h5>
              </div>
              <div class="col-md-6">
                <div class="text-right">
                  <p id="date"></p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-2">
                    Year
                  </div>
                  <div class="col-md-1">
                    :
                  </div>
                  <div class="col">
                    <div class="" id="year"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    Month
                  </div>
                  <div class="col-md-1">
                    :
                  </div>
                  <div class="col">
                    <div class="" id="month"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    Name
                  </div>
                  <div class="col-md-1">
                    :
                  </div>
                  <div class="col">
                    {{ Auth::user()->name}}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <p>Email : {{ Auth::user()->email}} <br><b>Profit : </b>{{ $creations->sum('price')*50/100 }} <br><b>Total Creation : </b>{{ $creations->count() }} </p>
              </div>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Category Name</th>
                  <th>Price</th>
                  <th>Total Creation</th>
                  <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Logo</td>
                  <td>{{ $logo->price }}</td>
                  <td>{{ $creations->where('category_name','Logo')->count() }}</td>
                  <td>{{ $logo->price * $creations->where('category_name','Logo')->count() }}</td>
                </tr>
                <tr>
                  <td>Banner</td>
                  <td>{{ $banner->price }}</td>
                  <td>{{ $creations->where('category_name','Banner')->count() }}</td>
                  <td>{{ $banner->price * $creations->where('category_name','Banner')->count() }}</td>
                </tr>
                <tr>
                  <td>Poster</td>
                  <td>{{ $poster->price }}</td>
                  <td>{{ $creations->where('category_name','Poster')->count() }}</td>
                  <td>{{ $poster->price * $creations->where('category_name','Poster')->count() }}</td>
                </tr>
                <tr>
                  <td>Vektor</td>
                  <td>{{ $vektor->price }}</td>
                  <td>{{ $creations->where('category_name','Vektor')->count() }}</td>
                  <td>{{ $vektor->price * $creations->where('category_name','Vektor')->count() }}</td>
                </tr>
                <tr>
                  <td>Other</td>
                  <td> - </td>
                  <td>{{ $other->count() }}</td>
                  <td>{{ $other->sum('price') }}</td>
                </tr>
              </tbody>
            </table>
            <br>
            <div class="row">
              <div class="col-md-6">
                <p> Income : Rp.{{ $creations->sum('price') }} / 50% <br>Total : Rp.{{ $creations->sum('price')*50/100 }} </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{asset('public\LTE\plugins\jquery\jquery.min.js')}}"></script>
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
    function date() {
      var d = new Date();
      var n = d.toLocaleDateString();
      document.getElementById("date").innerHTML = n;
    }
      $( document ).ready(function(){
        Year();
        Month();
        date();
        $(function() {
          $('input[name="dateBookkeeping"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
          }, function(start, end, label) {
            var years = moment().diff(start, 'years');
          });
        });
      });
    </script>

  </body>
</html>
