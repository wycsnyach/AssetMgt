<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $statuses=Status::orderBy('id', 'desc')->paginate(5);
        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('statuses.create');

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
         //
       $this->validate($request,[
           /* 'id' => 'required',*/
            'description' => 'required'

        ]);

       $input = $request->all();
       $status =  Status::create($input);
       $description= $status ->description;

        //Session::flash('flash_message', 'Task successfully added!');
        return redirect()->back() -> with("status","Added " .$description. " successfully");
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
         $status=Status::find($id);
        return view('statuses.edit', compact('status'));
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
                
                'description' => 'required'
            ]);

        $status = Status::find($id);
        $status->description = $request -> description;
        
        $statusSaved = $status->save();
        $description = $request -> description;
        /* if saved */

        if( $statusSaved == 1 ){

            return redirect()->back()-> with('status','Saved '.$description.' succesfully');
        }else{
            return redirect()->back()-> with('status','Failed '.$description.' not saved');
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
        $status = Status::findOrFail($id);
      
        $description = $status->description;
        $status->delete();

        //Session::flash('flash_message', 'Task successfully deleted!');

        //return redirect()->route('tasks.index');
         return redirect()->back()->with('status','Deleted '.$description.' succesfully');
    }
}
