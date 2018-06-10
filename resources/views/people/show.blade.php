<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('people', '| View Person')

@section('content')

<div class="container">

    <!-- <h1>{{ $location->name }}</h1> -->
    <hr>
    <p class="lead">{{ $person->name }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['people.destroy', $person->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Person')
    <a href="{{ route('people.edit', $person->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Person')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
