@extends('system-mgmt.lifecycleevents.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Cycle Event</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('lifecycleevents.update', ['id' => $lifecycleevents->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- Start Cycle Phase -->
                     <!--    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cycle Phase</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $lifecycleevents->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                        <!-- END -->
                     
                         <!-- Start Cycle Phases -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">Cycle Phase</label>
                            <div class="col-md-6">
                                <select class="form-control" name="life_cycle_code">
                                    @foreach ($cyclephases as $cyclephases)
                                        <!-- <option value="{{$cyclephases->id}}" {{$cyclephases->id == $lifecycleevents->life_cycle_code ? 'selected' : ''}}>{{$lifecycleevents->name}}</option> -->

                                        <option {{$lifecycleevents->life_cycle_code == $cyclephases->id ? 'selected' : ''}} value="{{$cyclephases->id}}">{{$cyclephases->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        <!--  END -->
                         <!-- Start Location -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">Location</label>
                            <div class="col-md-6">
                                <select class="form-control" name="location_id">
                                    @foreach ($locations as $locations)
                                     <!--    <option value="{{$locations->id}}" {{$locations->id == $lifecycleevents->location_id ? 'selected' : ''}}>{{$locations->name}}</option> -->

                                         <option {{$lifecycleevents->location_id == $locations->id ? 'selected' : ''}} value="{{$locations->id}}">{{$locations->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        <!--  END -->
                         <!-- Start User -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">User</label>
                            <div class="col-md-6">
                                <select class="form-control" name="responsible_person_code">
                                    @foreach ($people as $people)
                                       <!--  <option value="{{$people->id}}" {{$people->id == $lifecycleevents->responsible_person_code ? 'selected' : ''}}>{{$people->name}}</option> -->
                                          <option {{$lifecycleevents->responsible_person_code == $people->id ? 'selected' : ''}} value="{{$people->id}}">{{$people->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        <!--  END -->
                         <!-- Start Status -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="status_code">
                                    @foreach ($statuses as $statuses)
                                       <!--  <option value="{{$statuses->id}}" {{$statuses->id == $lifecycleevents->status_code ? 'selected' : ''}}>{{$statuses->name}}</option> -->
                                        <option {{$lifecycleevents->status_code == $statuses->id ? 'selected' : ''}} value="{{$statuses->id}}">{{$statuses->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        <!--  END -->

                        <!-- Start Date From -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">Date From</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ $lifecycleevents->date_from }}" name="date_from" class="form-control pull-right" id="fromDate" required>
                                </div>
                            </div>
                        </div>
                        <!-- END -->

                            <!-- Start Date To -->

                          <div class="form-group">
                            <label class="col-md-4 control-label">Date To</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ $lifecycleevents->date_to }}" name="date_to" class="form-control pull-right" id="toDate" required>
                                </div>
                            </div>
                        </div>
                        <!-- END -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
