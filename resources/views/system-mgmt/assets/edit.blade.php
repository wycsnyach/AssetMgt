@extends('system-mgmt.assets.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Asset</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('assets.update', ['id' => $assets->id]) }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $assets->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Asset Sub Type Start -->
                          <div class="form-group">
                            <label class="col-md-4 control-label">Asset Sub Type</label>
                            <div class="col-md-6">
                                <select class="form-control" name="asset_subtype_code">
                                    @foreach ($assetsubtypes as $assetsubtypes)
                                        <option value="{{$assetsubtypes->id}}" {{$assetsubtypes->id == $assetsubtypes->asset_subtype_code ? 'selected' : ''}}>{{$assetsubtypes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--  End -->

                        <!-- Asset Type Start -->
                          <div class="form-group">
                            <label class="col-md-4 control-label">Asset Type</label>
                            <div class="col-md-6">
                                <select class="form-control" name="asset_type_code">
                                    @foreach ($assettypes as $assettypes)
                                        <option value="{{$assettypes->id}}" {{$assettypes->id == $assettypes->asset_type_code ? 'selected' : ''}}>{{$assettypes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--  End -->

                       <!-- Asset User Start -->
                          <div class="form-group">
                            <label class="col-md-4 control-label">Asset User</label>
                            <div class="col-md-6">
                                <select class="form-control" name="user_id">
                                    @foreach ($people as $people)
                                        <option value="{{$people->id}}" {{$people->id == $people->user_id ? 'selected' : ''}}>{{$people->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--  End -->

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
