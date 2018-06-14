<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
class LocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$locations=Location::orderBy('id', 'desc')->paginate(5);
        return view('locations.index', compact('locations'));*/

        $locations = Location::paginate(5);

        return view('system-mgmt/locations/index', ['locations' => $locations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('system-mgmt/locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validateInput($request);
         Location::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('system-management/locations') -> with("status","Added successfully");

        //Session::flash('flash_message', 'Task successfully added!');
       // return redirect()->back() -> with("status","Added " .$name. " successfully");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    /*    $location=Location::find($id);
        return view('locations.edit', compact('location'));*/

        $locations = Location::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($locations == null || count($locations) == 0) {
            return redirect()->intended('/system-management/locations');
        }

        return view('system-mgmt/locations/edit', ['locations' => $locations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $locations = Location::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        Location::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/locations');

        /*$this -> validate($request,
            [
                
                'name' => 'required'
            ]);

        $location = Location::find($id);
        $location->name = $request -> name;
        
        $locationSaved = $location->save();
        $name = $request -> name;
      

        if( $locationSaved == 1 ){

            return redirect()->back()-> with('status','Saved '.$name.' succesfully');
        }else{
            return redirect()->back()-> with('status','Failed '.$name.' not saved');
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

         Location::where('id', $id)->delete();
         return redirect()->intended('system-management/locations') -> with('status','succesfully');
        /* $location = Location::findOrFail($id);
      
        $name = $location->name;
        $location->delete();
         return redirect()->back()->with('status','Deleted '.$name.' succesfully');*/
    }

/**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $locations = $this->doSearchingQuery($constraints);
       return view('system-mgmt/locations/index', ['locations' => $locations, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Location::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:locations'
    ]);
    }

}
