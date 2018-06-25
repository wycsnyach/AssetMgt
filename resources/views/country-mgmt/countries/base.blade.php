@extends('admin_template')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Country
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Country Mangement</a></li>
        <li class="active">Country </li>
      </ol>
    </section>
    @yield('action-content')
    <!-- /.content -->
  </div>
@endsection