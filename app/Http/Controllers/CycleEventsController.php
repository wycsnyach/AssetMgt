<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cyclephases;
use App\CycleEvents;
use App\Person;
use App\Status;
use App\Location;


class CycleEventsController extends Controller
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

        $lifecycleevents = DB::table('lifecycleevents')
        ->leftJoin('cyclephases', 'lifecycleevents.life_cycle_code', '=', 'cyclephases.id')
        ->leftJoin('locations', 'lifecycleevents.location_id', '=', 'locations.id')
        ->leftJoin('statuses', 'lifecycleevents.status_code', '=', 'statuses.id')
        ->leftJoin('people', 'lifecycleevents.responsible_person_code', '=', 'people.id')
        ->select('lifecycleevents.*', 'cyclephases.name as phase_name', 'cyclephases.id as cyclephases_id', 'locations.name as location_name', 'locations.id as location_id','people.name as user_name','people.id as user_id','statuses.name as status_name','statuses.id as statuses_id')
        ->paginate(5);

        return view('system-mgmt/lifecycleevents/index', ['lifecycleevents' => $lifecycleevents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cyclephases = Cyclephases::all();
        $locations = Location::all();
        $people = Person::all();
        $statuses =Status::all();
        return view('system-mgmt/lifecycleevents/create', ['cyclephases' => $cyclephases,
        'locations' => $locations, 'people' => $people, 'statuses' => $statuses]);
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
        // Upload image
     
        $keys = ['life_cycle_code', 'location_id', 'responsible_person_code', 'status_code', 'date_from', 'date_to'];
        $input = $this->createQueryInput($keys, $request);
       
        // Not implement yet
        // $input['company_id'] = 0;
        CycleEvents::create($input);

        return redirect()->intended('/system-management/lifecycleevents');
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
        $lifecycleevents = CycleEvents::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($lifecycleevents == null || count($lifecycleevents) == 0) {
            return redirect()->intended('/system-management/lifecycleevents');
        }
        $cyclephases = Cyclephases::all();
        $locations = Location::all();
        $people = Person::all();
        $statuses =Status::all();
        return view('system-mgmt/lifecycleevents/edit', ['cyclephases' => $cyclephases,
        'locations' => $locations, 'people' => $people, 'statuses' => $statuses]);
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
        $lifecycleevents = CycleEvents::findOrFail($id);
        $this->validateInput($request);
        // Upload image
        $keys = ['life_cycle_code', 'location_id', 'responsible_person_code', 'status_code', 'date_from', 'date_to'];
        $input = $this->createQueryInput($keys, $request);
        /*if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }*/

        CycleEvents::where('id', $id)
            ->update($input);

        return redirect()->intended('/system-management/lifecycleevents');
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
        CycleEvents::where('id', $id)->delete();
         return redirect()->intended('/system-management/lifecycleevents');
    }

    private function validateInput($request) {
        $this->validate($request, [
            'life_cycle_code' => 'required',
            'location_id' => 'required',
            'responsible_person_code' => 'required',
            'status_code' => 'required',
            'date_from' => 'required',
            'date_to' => 'required'
        ]);
    }
    

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
