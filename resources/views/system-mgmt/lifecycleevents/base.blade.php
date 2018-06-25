@extends('admin_template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asset Sub Types Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> System Mangement</a></li>
        <li class="active">Asset Sub Types </li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection