<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('statuses', '| View Status')

@section('content')

<div class="container">

    <!-- <h1>{{ $location->name }}</h1> -->
    <hr>
    <p class="lead">{{ $status->description }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['statuses.destroy', $status->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Status')
    <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Status')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
