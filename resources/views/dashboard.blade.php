@extends('layouts.app')
@section('title')Dashboard @endsection
@section('titlepage') <h1>Dashboard</h1> @endsection
@section('breadcrumb-link') dashboard @endsection
@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>Rp.{{ $creation->sum('price') }}</h3>
          <p>Your Balance</p>
        </div>
        <div class="icon">
          <i class="fas fa-money-bill"></i>
          </div>
            <a href="{{ route('karya.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $creation->count() }} Creations</h3>
          <p>Your Creations</p>
        </div>
        <div class="icon">
          <i class="fas fa-copy"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-danger">
        <div class="inner">
          @php
            $profit = $creation->sum('price')*50/100
          @endphp
          <h3>Rp.{{ $profit }}</h3>
          <p>Your Profit</p>
        </div>
        <div class="icon">
          <i class="fas fa-wallet"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Chart Profit</h3>
        </div>
        <div class="card-body">
          <canvas id="myChart" width="300px" height="200px"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Chart Categories</h3>
        </div>
        <div class="card-body">
          <canvas id="pieChart" width="300px" height="200px"></canvas>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
  <script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
        datasets: [{
            label: 'My Profit',
            borderColor: 'rgb(255, 99, 132)',
            data: [
                    {{ $jan ->sum('price')*50/100 }},
                    {{ $feb ->sum('price')*50/100 }},
                    {{ $mar ->sum('price')*50/100 }},
                    {{ $apr ->sum('price')*50/100 }},
                    {{ $may ->sum('price')*50/100 }},
                    {{ $jun ->sum('price')*50/100 }},
                    {{ $jul ->sum('price')*50/100 }},
                    {{ $aug ->sum('price')*50/100 }},
                    {{ $sep ->sum('price')*50/100 }},
                    {{ $oct ->sum('price')*50/100 }},
                    {{ $nov ->sum('price')*50/100 }},
                    {{ $dec ->sum('price')*50/100 }},
                  ]
        }]
    },

    // Configuration options go here
    options: {}
    });
    var pctx = document.getElementById('pieChart').getContext('2d');
    var chart = new Chart(pctx, {
    // The type of chart we want to create
    type: 'pie',
    // The data for our dataset
    data: {
        labels: ['Poster','Logo','Banner','Vektor','Other'],
        datasets: [{
            backgroundColor:['red','yellow','#77b300','#0000ff','gray'],
            data: [
                    {{$poster->count()}},
                    {{$logo->count()}},
                    {{$banner->count()}},
                    {{$vektor->count()}},
                    {{$categoryEx->count()}},
                  ]
        }]
    },
    // Configuration options go here
    options: {}
    });
  </script>
@endsection
