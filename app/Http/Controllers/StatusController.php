<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
class StatusController extends Controller
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

         $statuses = Status::orderBy('id', 'desc')->paginate(5);
        return view('system-mgmt/statuses.index', ['statuses' => $statuses]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('system-mgmt/statuses.create');

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
          $this -> validateInput($request);
        Status::create([
            'name'=>$request['name']
        ]);
        return redirect()->intended('system-management/statuses');


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
         $statuses = Status::find($id);
        if($statuses == null || count($statuses) == 0){
            return redirect()->intended('/system-management/statuses');
            
        }

        return view('system-mgmt/statuses.edit', ['statuses' => $statuses]);

         
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
        $statuses = Status::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
            
        ];
        Status::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/statuses');
        
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
        Status::where('id', $id)->delete();
            return redirect()->intended('system-management/statuses');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        $constraints = [
            'name' => $request['name']
        ];
        $statuses = $this->doSearchingQuery($constraints);
        return view('system-mgmt/statuses.index',['statuses' => $statuses, 'searchingVals' => $constraints]);
       
    }

    private function doSearchingQuery($constraints){
        $query =Status::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint){
            if($constraint != null){
                $query = $query->where($fields[$index],'like','%' .$constraint. '%');
            }
            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request){
        $this->validate($request, [
            
            'name' =>'required|max:60'
        ]);
    }
}
