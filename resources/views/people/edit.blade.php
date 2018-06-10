@extends('admin_template')

@section('people', '| Edit Person')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Person</h1>

         @if(session()->has('status'))
                <div class="alert">
                    <div class="alert alert-success alert-dismissable">
                        {{ session()->get('status') }}
                    </div>
                </div>
            @endif
        <hr>
       
            {{ Form::model($person, array('route' => array('people.update', $person->id), 'method' => 'PUT')) }}
            <div class="form-group">
           

            {{ Form::label('name', 'person Name') }}
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
