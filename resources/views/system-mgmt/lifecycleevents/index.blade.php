@extends('system-mgmt.lifecycleevents.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Asset Life Cycle Events List</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('lifecycleevents.create') }}">Add Cycle Event</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('lifecycleevents.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">Cycle Phase</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">Location</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">User</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">Status</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">Date From</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="lifecycleevents: activate to sort column ascending">Date To</th>
                
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Select Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($lifecycleevents as $lifecycleevent)
                <tr role="row" class="odd">
                  <td>{{ $lifecycleevent->phase_name }}</td>
                  <td>{{ $lifecycleevent->location_name }}</td>
                  <td>{{ $lifecycleevent->user_name }}</td>
                  <td>{{ $lifecycleevent->status_name }}</td>
                  <td>{{ $lifecycleevent->date_from }}</td>
                  <td>{{ $lifecycleevent->date_to }}</td>
                
                  <td>
                    <form class="row" method="POST" action="{{ route('lifecycleevents.destroy', ['id' => $lifecycleevent->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('lifecycleevents.edit', ['id' => $lifecycleevent->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                        Update
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                          Delete
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" rowspan="1" colspan="1">Cycle Phase</th>
                <th width="20%" rowspan="1" colspan="1">Location</th>
                <th width="15%" rowspan="1" colspan="1">User</th>
                <th width="10%" rowspan="1" colspan="1">Status</th>
                <th width="10%" rowspan="1" colspan="1">Date From</th>
                <th width="10%" rowspan="1" colspan="1">Date To</th>
               <!--  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="cycle_description: activate to sort column ascending">Cycle Description</th> -->
                <th rowspan="1" colspan="2">Select Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($lifecycleevents)}} of {{count($lifecycleevents)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $lifecycleevents->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection