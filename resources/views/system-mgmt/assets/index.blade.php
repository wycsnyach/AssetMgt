@extends('system-mgmt.assets.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-10">
          <h3 class="box-title">Asset List</h3>
        </div>
        <div class="col-sm-2">
          <a class="btn btn-primary" href="{{ route('assets.create') }}">Add Assset</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('assets.search') }}">
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
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assets: activate to sort column ascending">Name</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assets: activate to sort column ascending">Type</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assets: activate to sort column ascending">Sub Type</th>
                <th width="15%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assets: activate to sort column ascending">User</th>
                
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending" width="30%">Select Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($assets as $asset)
                <tr role="row" class="odd">
                  <td>{{ $asset->name }}</td>
                  <td>{{ $asset->type_name }}</td>
                  <td>{{ $asset->subtypes_name }}</td>
                  <td>{{ $asset->person_name }}</td>
                
                  <td>
                    <form class="row" method="POST" action="{{ route('assets.destroy', ['id' => $asset->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('assets.edit', ['id' => $asset->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="15%" rowspan="1" colspan="1">Name</th>
                <th width="15%" rowspan="1" colspan="1">Type</th>
                <th width="15%" rowspan="1" colspan="1">Sub Type</th>
                <th width="15%" rowspan="1" colspan="1">User</th>
               <!--  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="cycle_description: activate to sort column ascending">Cycle Description</th> -->
                <th rowspan="1" colspan="2" width="30%">Select Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($assets)}} of {{count($assets)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $assets->links() }}
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