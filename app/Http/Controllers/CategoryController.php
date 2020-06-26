<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $category = DB::table('categories')
                    ->where('user_id',$userId)
                    ->get();
                    $notivications = DB::table('creations')
                                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                                    ->select('creations.*','categories.name as category_name','categories.price')
                                    ->where('creations.option','save')
                                    ->where('creations.user_id', $userId)
                                    ->whereMonth('creations.created_at', now()->month)
                                    ->paginate(4);
        return view('category.index',[
            'category'=>$category,
            'notivications'=>$notivications,
            'activePage'=>'category'
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(),[
            "category_name" => "required",
            "price"=>"required",
          ])->validate();
        $user = Auth::user();
        $new_Category = new \App\Category;
        $new_Category->name = $request->get('category_name');
        $new_Category->price = $request->get('price');
        $new_Category->user_id = $user->id;
        $new_Category->save();
        if($request->get('form_category')){
          return redirect()->route('category.index');
        }else{
          return redirect()->route('karya.index');
        }
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
    }

    public function delete($id){
      $delete = \App\Category::findOrFail($id);
      $delete->forceDelete();

      return redirect()->route('category.index');
    }
}
