<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cyclephases;
class CyclePhasesController extends Controller
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
        $cyclephases = Cyclephases::paginate(5);

        //return view('cyclephases.index', ['cyclephases' => $cyclephases]);
        return view('system-mgmt/cyclephases.index', ['cyclephases' => $cyclephases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('cyclephases.create');
        return view('system-mgmt/cyclephases.create');
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
        Cyclephases::create([
            'name'=>$request['name'],
            'cycle_description'=>$request['cycle_description']
        ]);
        return redirect()->intended('system-management/cyclephases');
        // return redirect()->intended('cyclephases');
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
        $cyclephases = Cyclephases::find($id);
        if($cyclephases == null || count($cyclephases) == 0){
            return redirect()->intended('/system-management/cyclephases');
            //return redirect()->intended('cyclephases');
        }

        return view('system-mgmt/cyclephases.edit', ['cyclephases' => $cyclephases]);
        // return view('cyclephases.edit', ['cyclephases' => $cyclephases]);
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
       /* $cyclephases = Cyclephases::findOrFail($id);
        $this->validateInput($request , [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'cycle_description'=> $$request['cycle_description']
        ];
        Cyclephases::where('id',$id)
            ->update($input);

        return redirect()->intended('cyclephases');*/

        $cyclephases = Cyclephases::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'cycle_description' => $request['cycle_description']
        ];
        Cyclephases::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/cyclephases');
        // return redirect()->intended('cyclephases');
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
        Cyclephases::where('id', $id)->delete();
            return redirect()->intended('system-management/cyclephases');
            //return redirect()->intended('cyclephases');
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
        $cyclephases = $this->doSearchingQuery($constraints);
        return view('system-mgmt/cyclephases.index',['cyclephases' => $cyclephases, 'searchingVals' => $constraints]);
        // return view('cyclephases.index',['cyclephases' => $cyclephases, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query =Cyclephases::query();
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
            //'name' =>'required|max:60|unique:cyclephases',
            'name' =>'required|max:60',
            'cycle_description' => 'required|max:100'
            //'cycle_description' => $request['cycle_description']
        ]);
    }

}
