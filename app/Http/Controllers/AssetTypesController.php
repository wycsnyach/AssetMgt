<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AssetTypes;
use App\AssetSubTypes;
class AssetTypesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $assettypes = DB::table('assettypes')
        ->leftJoin('assetsubtypes', 'assettypes.asset_subtype_code', '=', 'assetsubtypes.id')
        ->select('assettypes.id', 'assettypes.name', 'assetsubtypes.name as assetsubtypes_name', 'assetsubtypes.id as asset_subtype_code')
        ->paginate(5);
        return view('assettypes.index', ['assettypes' => $assettypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          $assetsubtypes = AssetTypes::all();
            return view('assettypes.create', ['assetsubtypes' => $assetsubtypes]);
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
        $this->validateInput($request);
         AssetTypes::create([
            'name' => $request['name'],
            'asset_subtype_code' => $request['asset_subtype_code']
        ]);

        return redirect()->intended('assettypes');
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
        $assettypes = AssetTypes::find($id);
        // Redirect to city list if updating city wasn't existed
        if ($assettypes == null || count($assettypes) == 0) {
            return redirect()->intended('assettypes');
        }

        $assetsubtypes = AssetSubTypes::all();
        return view('assettypes.edit', ['assettypes' => $assettypes, 'assetsubtypes' => $assetsubtypes]);
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

        $assettypes = AssetTypes::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'asset_subtype_code' => $request['asset_subtype_code']
        ];
        AssetTypes::where('id', $id)
            ->update($input);
        
        return redirect()->intended('assettypes');
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
        AssetTypes::where('id', $id)->delete();
         return redirect()->intended('assettypes');
    }


    public function loadAssettypes($asset_subtype_code) {
        $assettypes = Category::where('asset_subtype_code', '=', $asset_subtype_code)->get(['id', 'name']);

        return response()->json($assettypes);
    }

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

       $assettypes = $this->doSearchingQuery($constraints);
       return view('assettypes.index', ['assettypes' => $assettypes, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = AssetTypes::query();
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
        'name' => 'required|max:60|unique:assettypes'
    ]);
    }
}
