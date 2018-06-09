<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('locations', '| View Location')

@section('content')

<div class="container">

    <!-- <h1>{{ $location->name }}</h1> -->
    <hr>
    <p class="lead">{{ $location->name }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['locations.destroy', $location->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Location')
    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Location')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
