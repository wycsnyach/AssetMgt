@extends('system-mgmt.assettypes.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Asset Types</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('assettypes.create') }}">Add Asset Type</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('assettypes.search') }}">
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
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assettypes: activate to sort column ascending">Asset Type Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assetsubtypes: activate to sort column ascending">Asset SubType</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Select Action</th>
              </tr>
            </thead>
            <tbody>
            {{$assettypes}}
            @foreach ($assettypes as $assettype)
                <tr role="row" class="odd">
                  <td>{{ $assettype->name }}</td>
                  <td>{{ $assettype->assetsubtypes_name }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('assettypes.destroy', ['id' => $assettype->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('assettypes.edit', ['id' => $assettype->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
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
                <th width="20%" rowspan="1" colspan="1">Asset Type Name</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="assetsubtypes: activate to sort column ascending">Asset SubType</th>
                <th rowspan="1" colspan="2">Select Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($assettypes)}} of {{count($assettypes)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $assettypes->links() }}
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