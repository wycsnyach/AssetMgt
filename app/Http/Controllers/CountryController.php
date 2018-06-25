<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Country;
class CountryController extends Controller
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
        /*$countries = Country::get()->all();
        return view('countries.index' , compact( 'countries' ) );
*/
       /* $countries=Country::orderBy('id', 'desc')->paginate(5);
        return view('countries.index', compact('countries'));*/
         $countries = Country::paginate(5);

        return view('country-mgmt/countries/index', ['countries' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('country-mgmt/countries.create');
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
       /* $this->validate($request,[
            'country_code' => 'required',
            'name' => 'required'

        ]);
       

        $input = $request->all();
        $country =  Country::create($input);
        $name= $country ->name;

        return redirect()->back() -> with("status","Added " .$name. " successfully");*/

        $this->validateInput($request);
         Country::create([
            'name' => $request['name'],
            'country_code' => $request['country_code']
        ]);

        return redirect()->intended('country-management/countries');
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
        /*$country=Country::find($id);
        return view('countries.edit', compact('country'));*/
        $countries = Country::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($countries == null || count($countries) == 0) {
            return redirect()->intended('/country-management/countries');
        }

        return view('country-mgmt/countries/edit', ['countries' => $countries]);
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
        
        /*$this -> validate($request ,[
            'country_code' => 'required',
            'name' => 'required'
        ]);
        $country = Country::find($id);
        $country->name = $request -> name;
        $country ->country_code =$request ->country_code;
        $countrySaved = $country->save();
        $name = $request -> name;
       

        if( $countrySaved == 1 ){

            return redirect()->back()-> with('status','Saved '.$name.' succesfully');
        }else{
            return redirect()->back()-> with('status','Failed '.$name.' not saved');
        }*/
        $countries = Country::findOrFail($id);
        $input = [
            'name' => $request['name'],
            'country_code' => $request['country_code']
        ];
        $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        Country::where('id', $id)
            ->update($input);
        
        return redirect()->intended('country-management/countries');
       
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

        /*$country = Country::findOrFail($id);
      
        $country_code = $country->country_code;
        $country->delete();

        return redirect()->back()->with('status','Deleted '.$country_code.' succesfully');*/
         Country::where('id', $id)->delete();
         return redirect()->intended('country-management/countries');
    }

    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'country_code' => $request['country_code']
            ];

       $countries = $this->doSearchingQuery($constraints);
       return view('country-mgmt/countries/index', ['countries' => $countries, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Country::query();
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
        'name' => 'required|max:60|unique:countries',
        'country_code' => 'required|max:3|unique:countries'
    ]);
    }
}
