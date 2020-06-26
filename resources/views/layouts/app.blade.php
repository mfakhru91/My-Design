<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('public\LTE\plugins\fontawesome-free\css\all.css') }}">
  <!-- ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public\LTE\dist\css\adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public\LTE\dist\css\skins\all-skin.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- dataTables -->
  <link rel="stylesheet" href="{{ asset('public\LTE\plugins\datatables-bs4\css\dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('public\LTE\plugins\datatables-responsive\css\responsive.bootstrap4.css') }}public\LTE\plugins\datatables-responsive\css\responsive.bootstrap4.css">
  @yield('head')
</head>
<body class="hold-transition sidebar-mini skin-green">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('welcome') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if($notivications->count() == 0)
          @else
          <span class="badge badge-warning navbar-badge">{{ $notivications->count() }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">{{ $notivications->count() }} Progress</span>
          <div class="dropdown-divider"></div>
          @foreach($notivications as $nt)
          <a href="{{route('karya.index')}}" class="dropdown-item">
            <i class="fad fa-spinner-third"></i>
            @if($nt->payment == 'debt')
              (Proses)
            @endif
            {{ $nt->name }}
            <small>{{ $nt->option }}</small>
          </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('karya.index')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('welcome')}}" class="brand-link">
      <img src="public\image\myLogo.png" alt="AdminLTE Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Alfa Design</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if( Auth::user()->avatar)
            <img src="public/storage/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image"
            width="50px" height="100px" style=" object-fit: cover; ">
          @else
            <img src="public/image/user.png" class="img-circle" alt="User Image"
            width="50px" height="100px" style=" object-fit: cover; ">
          @endif
        </div>
        <div class="info">
          <a href="{{route('home')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
             <a href="{{route('home')}}" class="nav-link <?php if ('dashboard' === $activePage):?>active<?php endif;?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                   Dashboard
               </p>
             </a>
          </li>
          <li class="nav-item">
            <a href="{{route('karya.index')}}" class="nav-link <?php if ('karya' === $activePage):?>active<?php endif;?>">
                <i class="nav-icon fas fa-copy"></i>
              <p>Karya</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link <?php if ('category' === $activePage):?>active<?php endif;?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('bookkeeping.index')}}" class="nav-link <?php if ('bookkeeping' === $activePage):?>active<?php endif;?>">
              <i class="nav-icon fas fa-dice-d6"></i>
              <p>Bookkeeping</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              @yield('titlepage')
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">@yield('breadcrumb-link')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Option</h5>
        <small> {{ Auth::user()->name }} </small>
        <hr style=" background-color: white">
        <div class="mb-1"><a href="{{ route('profile.index') }}">Edit Profile</a></div>
        <a class="" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <!-- jQuery -->
  <script src="{{asset('public\LTE\plugins\jquery\jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('public\LTE\plugins\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('public\LTE\dist\js\adminlte.min.js')}}"></script>
  <!-- DataTable -->
  <script type="{{asset('public\LTE\plugins\datatables\jquery.dataTables.min.js')}}"></script>
  <script type="{{asset('public\LTE\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
  <script type="{{asset('public\LTE\plugins\datatables-responsive\js\dataTables.responsive.min.js')}}"></script>
  <script type="{{asset('public\LTE\plugins\datatables-responsive\js\responsive.bootstrap4.js')}}"></script>
  @yield('script')
  </body>
  </html>
