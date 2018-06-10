@extends('admin_template')

@section('statuses', '| Edit Status')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Status</h1>

         @if(session()->has('status'))
                <div class="alert">
                    <div class="alert alert-success alert-dismissable">
                        {{ session()->get('status') }}
                    </div>
                </div>
            @endif
        <hr>
       
            {{ Form::model($status, array('route' => array('statuses.update', $status->id), 'method' => 'PUT')) }}
            <div class="form-group">
          
            {{ Form::label('description', 'location Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}<br>
            @if ($errors->has('description'))
                <span class="alert alert-warning">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>

            @endif

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection
