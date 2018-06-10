<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use Yajra\Datatables\Facades\Datatables;
class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return view('people.index');

        $people = Person::get()->all();
        return view('people.index' , compact( 'people' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('people.create');
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
       $person =  Person::create($input);
       $name= $person ->name;

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
        $person=Person::find($id);
        return view('people.edit', compact('person'));
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

        $person = Person::find($id);
        $person->name = $request -> name;
        
        $personSaved = $person->save();
        $name = $request -> name;
        /* if saved */

        if( $personSaved == 1 ){

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
          $person = Person::findOrFail($id);
      
        $name = $person->name;
        $person->delete();

       
         return redirect()->back()->with('status','Deleted '.$name.' succesfully');
    }

   /*  public function personData()
    {
        return Datatables::of(Person::query())->make(true);
    }
    */
}
