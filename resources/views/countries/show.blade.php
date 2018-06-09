<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('countries', '| View Country')

@section('content')

<div class="container">

    <h1>{{ $country->country_code }}</h1>
    <hr>
    <p class="lead">{{ $country->name }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['countries.destroy', $country->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Country')
    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Country')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
