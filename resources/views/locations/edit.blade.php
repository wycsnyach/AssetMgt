@extends('admin_template')

@section('locations', '| Edit Location')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Location</h1>

         @if(session()->has('status'))
                <div class="alert">
                    <div class="alert alert-success alert-dismissable">
                        {{ session()->get('status') }}
                    </div>
                </div>
            @endif
        <hr>
       
            {{ Form::model($location, array('route' => array('locations.update', $location->id), 'method' => 'PUT')) }}
            <div class="form-group">
            <!-- {{ Form::label('country_code', 'Country Code') }}
            {{ Form::text('country_code', null, array('class' => 'form-control')) }}<br>
            @if ($errors->has('country_code'))
                <span class="alert alert-warning">
                    <strong>{{ $errors->first('country_code') }}</strong>
                </span>

            @endif -->

            {{ Form::label('name', 'location Name') }}
            {{ Form::textarea('name', null, array('class' => 'form-control')) }}<br>
            @if ($errors->has('name'))
                <span class="alert alert-warning">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>

            @endif

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection
