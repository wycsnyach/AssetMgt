<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::get()->all();
        return view('categories.index' , compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
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
       $category =  Category::create($input);
       $name= $category ->name;

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
        $category=Category::find($id);
        return view('categories.edit', compact('category'));
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

        $category = Category::find($id);
        $category->name = $request -> name;
        
        $categorySaved = $category->save();
        $name = $request -> name;
        /* if saved */

        if( $categorySaved == 1 ){

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
        $category = Category::findOrFail($id);
      
        $name = $category->name;
        $category->delete();

        //Session::flash('flash_message', 'Task successfully deleted!');

        //return redirect()->route('tasks.index');
         return redirect()->back()->with('status','Deleted '.$name.' succesfully');
    }
}
