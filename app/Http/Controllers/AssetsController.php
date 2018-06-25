<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AssetSubTypes;
use App\Person;
use App\Assets;
use App\AssetTypes;

class AssetsController extends Controller
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
        $assets = DB::table('assets')
        ->leftJoin('assetsubtypes', 'assets.asset_subtype_code', '=', 'assetsubtypes.id')
        ->leftJoin('assettypes', 'assets.asset_type_code', '=', 'assettypes.id')
        ->leftJoin('people', 'assets.user_id', '=', 'people.id')
        ->select('assets.*','assetsubtypes.name as subtypes_name', 'assetsubtypes.id as asset_subtype_code', 'assettypes.name as type_name','assettypes.id as asset_type_code','people.name as person_name')
        ->paginate(5);
        return view('system-mgmt/assets.index', ['assets' => $assets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $assetsubtypes = AssetSubTypes::all();
        $assettypes = AssetTypes::all();
        $people = Person::all();
        return view('system-mgmt/assets.create', ['assetsubtypes' => $assetsubtypes,
        'assettypes' => $assettypes, 'people' => $people]);
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

        AssetSubTypes::findOrFail($request['asset_subtype_code']);
        AssetTypes::findOrFail($request['asset_type_code']);
        Person::findOrFail($request['user_id']);
        $this->validateInput($request);
         Assets::create([
            'name' => $request['name'],
            'asset_subtype_code' => $request['asset_subtype_code'],
            'asset_type_code' => $request['asset_type_code'],
            'user_id' => $request['user_id']
        ]);

        return redirect()->intended('system-management/assets');
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
        $assets = Assets::find($id);
        // Redirect to city list if updating city wasn't existed
        if ($assets == null || count($assets) == 0) {
            return redirect()->intended('/system-management/assets');
            
        }

        $assetsubtypes = AssetSubTypes::all();
        $assettypes = AssetTypes::all();
        $people = Person::all();
        return view('system-mgmt/assets.edit', ['assets' => $assets, 'assetsubtypes' => $assetsubtypes,
        'assettypes' => $assettypes, 'people' => $people]);
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
        $assets = Assets::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'asset_subtype_code' => $request['asset_subtype_code'],
            'asset_type_code' => $request['asset_type_code'],
            'user_id' => $request['user_id']
        ];
        Assets::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/assets');
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

         Assets::where('id', $id)->delete();
         return redirect()->intended('system-management/assets');
    }

    /*public function loadAssetsubtypes($asset_category_code) {
        $assetsubtypes = Category::where('asset_category_code', '=', $asset_category_code)->get(['id', 'name']);

        return response()->json($assetsubtypes);
    }*/

      /**
     * Search city from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $assets = $this->doSearchingQuery($constraints);
       return view('system-mgmt/assets.index', ['assets' => $assets, 'searchingVals' => $constraints]);
       //return view('assetsubtypes.index', ['assetsubtypes' => $assetsubtypes, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('assets')
        ->leftJoin('assetsubtypes', 'assets.asset_subtype_code', '=', 'assetsubtypes.id')
        ->leftJoin('assettypes', 'assets.asset_type_code', '=', 'assettypes.id')
        ->leftJoin('people', 'assets.user_id', '=', 'people.id')
        ->select('assets.*','assetsubtypes.name as subtypes_name', 'assetsubtypes.id as asset_subtype_code', 'assettypes.id as asset_type_code','assettype.name as asset_type_name','people.name as person_name');

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
        'name' => 'required|max:60|unique:assets',
        'asset_subtype_code' => 'required|max:60|unique:assets',
        'asset_type_code' => 'required|max:60|unique:assets',
        'user_id' => 'required|max:60|unique:assets'
    ]);
    }

}
