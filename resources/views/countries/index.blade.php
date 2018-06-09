@extends('admin_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-0">
              <p></p>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Countries List</h3></div>
                    
                    @if(session()->has('status'))
                        <div class="alert">
                            <div class="alert alert-success alert-dismissable">
                                {{ session()->get('status') }}
                            </div>
                        </div>
                    @endif

               <!--    {{--  <div class="btn btn-primary"><a href="{{route('countries.create')}}"> Create New</a></div>--}} -->
                  <p></p>
                    <div><a class="btn btn-primary" href="{{route('countries.create')}}">Create New</a> </div>
                    <div class="panel-heading">{{--Page {{ $countries->currentPage() }} of {{ $countries->lastPage() }}--}}</div>
                    {{-- Loop thru posts --}}

                    {{--@foreach ($countries as $country)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('countries.show', $country->id ) }}"><b>{{ $country->country_code }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($country->name, 100) }} --}}{{-- Limit teaser to 100 characters --}}{{--
                                    </p>
                                </a>
                            </li>

                              </div>
                     @endforeach--}}
                     <div class="panel-body" >
                            <table class="table-bordered" width="100%">
                            <thead>
                            <tr role="row">
                                <th width="20%">Country Code</th>
                                <th width="20%">Country Name</th>
                                <th width="20%" colspan="2">Actions</th>
                            </tr>
                            </thead>
<tbody>
                            @foreach ($countries as $country)
                            <tr role="row" class="odd">
                                <td>{{ $country->country_code  }}</td>
                                <td>{{ $country->name }}</td>
                               <!--  <td><a href="{{ route('countries.edit', $country->id ) }}" class="btn btn-primary btn-margin">Edit</a></td>
                                <td><a href="{{ route('countries.destroy', $country->id ) }}" class="btn btn-primary btn-margin">Delete</a></td> -->



        <td>
        
          <form id="delform" action="{{action('CountryController@destroy', $country['id'])}}" method="post">
            <!-- @csrf -->  {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
           
          </form>
          <a href="{{action('CountryController@edit', $country['id'])}}" class="btn btn-warning">Edit</a>
             <button class="btn btn-danger" form="delform" type="submit">Delete</button>
        </td>


                            </tr>
                            @endforeach
                            </tbody>
                            </table>

                     </div>



                    </div>
                    <div class="text-center">
                     {{--   {!! $countries->links() !!}--}}
                    </div>
                </div>
            </div>
        </div>
@endsection
