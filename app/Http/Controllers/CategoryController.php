<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
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
         $categories = Category::paginate(5);
        return view('system-mgmt/categories.index', ['categories' => $categories]);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('system-mgmt/categories.create');
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
        Category::create([
            'name'=>$request['name']
        ]);
        return redirect()->intended('system-management/categories');

      /*  $this->validate($request,[
          
            'name' => 'required'

        ]);

       $input = $request->all();
       $category =  Category::create($input);
       $name= $category ->name;

        
        return redirect()->back() -> with("status","Added " .$name. " successfully");*/
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
        $categories = Category::find($id);
        if($categories == null || count($categories) == 0){
            return redirect()->intended('/system-management/categories');
            
        }

        return view('system-mgmt/categories.edit', ['categories' => $categories]);
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

        $categories = Category::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
            
        ];
        Category::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/categories');
        /* $this -> validate($request,
            [
                
                'name' => 'required'
            ]);

        $category = Category::find($id);
        $category->name = $request -> name;
        
        $categorySaved = $category->save();
        $name = $request -> name;
        if( $categorySaved == 1 ){

            return redirect()->back()-> with('status','Saved '.$name.' succesfully');
        }else{
            return redirect()->back()-> with('status','Failed '.$name.' not saved');
        }*/
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

        Category::where('id', $id)->delete();
            return redirect()->intended('system-management/categories');
        /*$category = Category::findOrFail($id);
      
        $name = $category->name;
        $category->delete();

        return redirect()->back()->with('status','Deleted '.$name.' succesfully');*/
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
        $categories = $this->doSearchingQuery($constraints);
        return view('system-mgmt/categories.index',['categories' => $categories, 'searchingVals' => $constraints]);
       
    }

    private function doSearchingQuery($constraints){
        $query =Category::query();
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
