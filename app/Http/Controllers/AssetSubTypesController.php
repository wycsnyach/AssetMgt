<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
Use App\AssetSubTypes;
class AssetSubTypesController extends Controller
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
        $assetsubtypes = DB::table('assetsubtypes')
        ->leftJoin('categories', 'assetsubtypes.asset_category_code', '=', 'categories.id')
        ->select('assetsubtypes.id', 'assetsubtypes.name', 'categories.name as categories_name', 'categories.id as asset_category_code')
        ->paginate(5);
        return view('system-mgmt/assetsubtypes.index', ['assetsubtypes' => $assetsubtypes]);
        // return view('assetsubtypes.index', ['assetsubtypes' => $assetsubtypes]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
            return view('system-mgmt/assetsubtypes.create', ['categories' => $categories]);
            // return view('assetsubtypes.create', ['categories' => $categories]);
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
        Category::findOrFail($request['asset_category_code']);
        $this->validateInput($request);
         AssetSubTypes::create([
            'name' => $request['name'],
            'asset_category_code' => $request['asset_category_code']
        ]);

        return redirect()->intended('system-management/assetsubtypes');
        //return redirect()->intended('assetsubtypes');
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
        $assetsubtypes = AssetSubTypes::find($id);
        // Redirect to city list if updating city wasn't existed
        if ($assetsubtypes == null || count($assetsubtypes) == 0) {
            return redirect()->intended('/system-management/assetsubtypes');
            //return redirect()->intended('assetsubtypes');
        }

        $categories = Category::all();
        return view('system-mgmt/assetsubtypes.edit', ['assetsubtypes' => $assetsubtypes, 'categories' => $categories]);
        //return view('assetsubtypes.edit', ['assetsubtypes' => $assetsubtypes, 'categories' => $categories]);
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
        $assetsubtypes = AssetSubTypes::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'asset_category_code' => $request['asset_category_code']
        ];
        AssetSubTypes::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/assetsubtypes');
        //return redirect()->intended('assetsubtypes');
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

        AssetSubTypes::where('id', $id)->delete();
         return redirect()->intended('system-management/assetsubtypes');
         //return redirect()->intended('assetsubtypes');
    }

    public function loadAssetsubtypes($asset_category_code) {
        $assetsubtypes = Category::where('asset_category_code', '=', $asset_category_code)->get(['id', 'name']);

        return response()->json($assetsubtypes);
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

       $assetsubtypes = $this->doSearchingQuery($constraints);
       return view('system-mgmt/assetsubtypes.index', ['assetsubtypes' => $assetsubtypes, 'searchingVals' => $constraints]);
       //return view('assetsubtypes.index', ['assetsubtypes' => $assetsubtypes, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = AssetSubTypes::query();
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
        'name' => 'required|max:60|unique:assetsubtypes'
    ]);
    }

}
