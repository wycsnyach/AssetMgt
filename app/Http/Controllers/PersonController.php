<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
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
        //return view('people.index');

       /* $people = Person::get()->all();
        return view('people.index' , compact( 'people' ) );*/

          $people = Person::paginate(5);
        return view('employee-mgmt/people.index', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('employee-mgmt/people.create');
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
        Person::create([
            'name'=>$request['name']
        ]);
        return redirect()->intended('employee-management/people');

              $this->validate($request,[
           /* 'id' => 'required',*/
            'name' => 'required'

        ]);

       
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
         $people = Person::find($id);
        if($people == null || count($people) == 0){
            return redirect()->intended('/employee-management/people');
            
        }

        return view('employee-mgmt/people.edit', ['people' => $people]);
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
       $people = Person::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
            
        ];
        Person::where('id', $id)
            ->update($input);
        
        return redirect()->intended('employee-management/people');
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
           Person::where('id', $id)->delete();
            return redirect()->intended('employee-management/people');
    }

   /*  public function personData()
    {
        return Datatables::of(Person::query())->make(true);
    }
    */

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
        $people = $this->doSearchingQuery($constraints);
        return view('employee-mgmt/people.index',['people' => $people, 'searchingVals' => $constraints]);
       
    }

    private function doSearchingQuery($constraints){
        $query =Person::query();
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
