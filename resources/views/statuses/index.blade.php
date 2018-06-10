@extends('admin_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
              <p></p>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Status List</h3></div>
                    
                    @if(session()->has('status'))
                        <div class="alert">
                            <div class="alert alert-success alert-dismissable">
                                {{ session()->get('status') }}
                            </div>
                        </div>
                    @endif

             
                  <p></p>
                    <div><a class="btn btn-primary" href="{{route('statuses.create')}}">Create New</a> </div>
                    <div class="panel-heading">{{--Page {{ $statuses->currentPage() }} of {{ $statuses->lastPage() }}--}}</div>
                    {{-- Loop thru posts --}}

                    {{--@foreach ($statuses as $status)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('statuses.show', $status->id ) }}">
                                    <p class="teaser">
                                       {{  str_limit($status->name, 100) }} --}}{{-- Limit teaser to 100 characters --}}{{--
                                    </p>
                                </a>
                            </li>

                              </div>
                     @endforeach--}}
                     <div class="panel-body" >
                            <table class="table-bordered" width="100%">
                            <thead>
                            <tr role="row">
                               
                                <th width="20%">Status Name</th>
                                <th width="20%" colspan="2">Actions</th>
                            </tr>
                            </thead>
<tbody>
                            @foreach ($statuses as $status)
                            <tr role="row" class="odd">
                               
                                <td>{{ $status->description }}</td>
                            



        <td>
        
          <form id="delform" action="{{action('StatusController@destroy', $status['id'])}}" method="post">
            <!-- @csrf -->  {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
           
          </form>
          <a href="{{action('StatusController@edit', $status['id'])}}" class="btn btn-warning">Edit</a>
             <button class="btn btn-danger" form="delform" type="submit">Delete</button>
        </td>


                            </tr>
                            @endforeach
                            </tbody>
                            </table>

                     </div>



                    </div>
                    <div class="text-center">
                     {{--   {!! $statuses->links() !!}--}}
                    </div>
                </div>
            </div>
        </div>
@endsection