@extends('system-mgmt.lifecycleevents.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add cycle event</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('lifecycleevents.store') }}">
                        {{ csrf_field() }}

                       <!--  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Sub Type Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                            <!-- Location -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Cycle Phase</label>
                            <div class="col-md-6">
                                <select class="form-control" name="life_cycle_code">
                                    @foreach ($cyclephases as $cyclephases)
                                        <option value="{{$cyclephases->id}}">{{$cyclephases->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                         <!-- Location -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Locations</label>
                            <div class="col-md-6">
                                <select class="form-control" name="location_id">
                                    @foreach ($locations as $locations)
                                        <option value="{{$locations->id}}">{{$locations->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- END -->
                        <!-- User -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">User</label>
                            <div class="col-md-6">
                                <select class="form-control" name="responsible_person_code">
                                    @foreach ($people as $people)
                                        <option value="{{$people->id}}">{{$people->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                        <!-- Status -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_code">
                                    @foreach ($statuses as $statuses)
                                        <option value="{{$statuses->id}}">{{$statuses->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- END -->

                        <!-- Date From -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Date From</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('date_from') }}" name="date_from" class="form-control pull-right" id="date_from" required>
                                </div>
                            </div>
                        </div>
                        <!-- End -->
                        
                        <!-- Date To -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Date To</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('date_to') }}" name="date_to" class="form-control pull-right" id="date_to" required>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

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
