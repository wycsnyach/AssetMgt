<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations=Location::orderBy('id', 'desc')->paginate(5);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('locations.create');
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
       $this->validate($request,[
           /* 'id' => 'required',*/
            'name' => 'required'

        ]);

       $input = $request->all();
       $location =  Location::create($input);
       $name= $location ->name;

        //Session::flash('flash_message', 'Task successfully added!');
        return redirect()->back() -> with("status","Added " .$name. " successfully");
        
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
        $location=Location::find($id);
        return view('locations.edit', compact('location'));
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
        $this -> validate($request,
            [
                
                'name' => 'required'
            ]);

        $location = Location::find($id);
        $location->name = $request -> name;
        
        $locationSaved = $location->save();
        $name = $request -> name;
        /* if saved */

        if( $locationSaved == 1 ){

            return redirect()->back()-> with('status','Saved '.$name.' succesfully');
        }else{
            return redirect()->back()-> with('status','Failed '.$name.' not saved');
        }
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
         $location = Location::findOrFail($id);
      
        $name = $location->name;
        $location->delete();

        //Session::flash('flash_message', 'Task successfully deleted!');

        //return redirect()->route('tasks.index');
         return redirect()->back()->with('status','Deleted '.$name.' succesfully');
    }
}
