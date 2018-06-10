<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('categories', '| View Category')

@section('content')

<div class="container">

    <!-- <h1>{{ $location->name }}</h1> -->
    <hr>
    <p class="lead">{{ $category->name }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Category')
    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Category')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection
