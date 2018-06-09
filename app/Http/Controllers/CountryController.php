<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$countries = Country::get()->all();
        return view('countries.index' , compact( 'countries' ) );
*/
        $countries=Country::orderBy('id', 'desc')->paginate(5);
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('countries.create');
        //return view('countries.create');
        //$tags=Tag::all();
        //$categories=Category::all();
        //return view('countries.create',compact('tags','categories'));
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
            'country_code' => 'required',
            'name' => 'required'

        ]);
       /* return $request->country_code;*/

        $input = $request->all();
        $country =  Country::create($input);
        $name= $country ->name;

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
        $country=Country::find($id);
        return view('countries.edit', compact('country'));
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
        
        $this -> validate($request ,[
            'country_code' => 'required',
            'name' => 'required'
        ]);
        /* find id and update the row*/
        $country = Country::find($id);
        $country->name = $request -> name;
        $country ->country_code =$request ->country_code;
        $countrySaved = $country->save();
        $name = $request -> name;
        /* if saved */

        if( $countrySaved == 1 ){

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

        $country = Country::findOrFail($id);
       // return $country ;
        $country_code = $country->country_code;
        $country->delete();

        //Session::flash('flash_message', 'Task successfully deleted!');

        //return redirect()->route('tasks.index');
         return redirect()->back()->with('status','Deleted '.$country_code.' succesfully');
    }
}
