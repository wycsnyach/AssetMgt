@extends('system-mgmt.assets.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Add Asset</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('assets.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Asset Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <!--  Asset Subtype Code Start-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Sub Type</label>
                            <div class="col-md-6">
                                <select class="form-control" name="asset_subtype_code">
                                     <option value="-1">Please select your Asset Sub Type</option>
                                    @foreach ($assetsubtypes as $assetsubtypes)
                                        <option value="{{$assetsubtypes->id}}">{{$assetsubtypes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- End -->
                         <!--  Asset Type Code Start-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Type</label>
                            <div class="col-md-6">
                                <select class="form-control" name="asset_type_code">
                                     <option value="-1">Please select your Asset Type</option>
                                    @foreach ($assettypes as $assettypes)
                                        <option value="{{$assettypes->id}}">{{$assettypes->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- End -->

                         <!--  Asset Type Code Start-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Assigned User</label>
                            <div class="col-md-6">
                                <select class="form-control" name="user_id">
                                     <option value="-1">Please select Asset User</option>
                                    @foreach ($people as $people)
                                        <option value="{{$people->id}}">{{$people->name}}</option>
                                    @endforeach
                                </select>
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
