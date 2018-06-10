<!-- @extends('layouts.app') -->
@extends('admin_template')

@section('people', '| Create New Person')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
       <!--  <h3>New location</h3> -->
        <hr width="100%">
        {{-- @include ('errors.list') --}}

                    @if(session()->has('status'))
                        <div class="alert">
                            <div class="alert alert-success alert-dismissable">
                                {{ session()->get('status') }}
                            </div>
                        </div>
                    @endif
        {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'people.store')) }}

        <div class="form-group">
          <!--   {{ Form::label('country_code', 'Country Code') }}
            {{ Form::text('country_code', null, array('class' => 'form-control')) }}

            @if ($errors->has('country_code'))
                <span class="alert alert-warning">
                    <strong>{{ $errors->first('country_code') }}</strong>
                </span>

            @endif
            <br> -->

            {{ Form::label('name', 'Name') }}
            {{ Form::textarea('name', null, array('class' => 'form-control')) }}
                @if ($errors->has('name'))
                    <span class="help-block">
                    <strong>{{$errors->first('name')}}</strong>
                    </span>
                @endif
            <br>


            {{ Form::submit('Create person', array('class' => 'btn btn-primary btn-sm ')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>
</div>

@endsection
