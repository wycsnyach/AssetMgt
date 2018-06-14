@extends('system-mgmt.cyclephases.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Cycle Phase</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('cyclephases.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cycle Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('cycle_description') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cycle Description</label>

                            <div class="col-md-6">
                                <input id="cycle_description" type="text" class="form-control" name="cycle_description" value="{{ old('cycle_description') }}" required autofocus>

                                @if ($errors->has('cycle_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cycle_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection