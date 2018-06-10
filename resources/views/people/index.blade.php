@extends('admin_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
              <p></p>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>People List</h3></div>
                    
                    @if(session()->has('status'))
                        <div class="alert">
                            <div class="alert alert-success alert-dismissable">
                                {{ session()->get('status') }}
                            </div>
                        </div>
                    @endif

             
                  <p></p>
                    <div><a class="btn btn-primary" href="{{route('people.create')}}">Create New</a> </div>
                    <div class="panel-heading">{{--Page {{ $people->currentPage() }} of {{ $people->lastPage() }}--}}</div>
                    {{-- Loop thru posts --}}

                    {{--@foreach ($people as $person)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('people.show', $person->id ) }}">
                                    <p class="teaser">
                                       {{  str_limit($person->name, 100) }} --}}{{-- Limit teaser to 100 characters --}}{{--
                                    </p>
                                </a>
                            </li>

                              </div>
                     @endforeach--}}
                     <div class="panel-body" >
                            <table class="table-bordered" width="100%">
                            <thead>
                            <tr role="row">
                               
                                <th width="20%">Person Name</th>
                                <th width="20%" colspan="2">Actions</th>
                            </tr>
                            </thead>
<tbody>
                            @foreach ($people as $person)
                            <tr role="row" class="odd">
                               
                                <td>{{ $person->name }}</td>
                            



        <td>
        
          <form id="delform" action="{{action('PersonController@destroy', $person['id'])}}" method="post">
            <!-- @csrf -->  {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
           
          </form>
          <a href="{{action('PersonController@edit', $person['id'])}}" class="btn btn-warning">Edit</a>
             <button class="btn btn-danger" form="delform" type="submit">Delete</button>
        </td>


                            </tr>
                            @endforeach
                            </tbody>
                            </table>

                     </div>



                    </div>
                    <div class="text-center">
                     {{--   {!! $people->links() !!}--}}
                    </div>
                </div>
            </div>
        </div>
@endsection
