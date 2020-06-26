<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class BookkeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $userId = Auth::user()->id;
      $creations = DB::table('creations')
      ->join('categories', 'categories.id', '=', 'creations.category_id')
      ->select('creations.*','categories.name as category_name','categories.price')
      ->where('creations.payment','paid off')
      ->where('creations.user_id',$userId)
      ->whereMonth('creations.created_at',now()->month )
      ->get();
      $category = DB::table('categories')
      ->where('user_id', $userId)
      ->get();
      // search bookkeeping
      $bookkepingsearch = DB::table('creations')
      ->join('categories', 'categories.id', '=', 'creations.category_id')
      ->select('creations.*','categories.name as category_name','categories.price')
      ->where('creations.payment','paid off')
      ->where('creations.user_id',$userId)
      ->whereMonth('creations.created_at',now()->month )
      ->get();
      $whereCategoryEx = DB::table('creations')
              ->join('categories', 'categories.id', '=', 'creations.category_id')
              ->where('categories.name','not like',"%ogo%")
              ->where('categories.name','not like',"%oster%")
              ->where('categories.name','not like',"%anner%")
              ->where('categories.name','not like',"%ektor%")
              ->where('creations.payment','paid off')
              ->where('creations.user_id',$userId)
              ->whereMonth('creations.created_at',now()->month)
              ->get();
      $dateStart = $request->get('dateStart');
      $dateEnd = $request->get('dateEnd');
      $printDate = $dateStart.' - '.$dateEnd;
      if ($dateStart) {
        $bookkepingsearch = DB::table('creations')
        ->join('categories', 'categories.id', '=', 'creations.category_id')
        ->select('creations.*','categories.name as category_name','categories.price')
        ->where('creations.payment','paid off')
        ->where('creations.user_id',$userId)
        ->whereBetween('creations.created_at',[$dateStart, $dateEnd])
        ->get();
        $whereCategoryEx = DB::table('creations')
        ->join('categories', 'categories.id', '=', 'creations.category_id')
        ->where('creations.payment','paid off')
        ->where('creations.user_id',$userId)
        ->whereNotIn('categories.name',['Poster','Banner','Logo','Vektor'])
        ->whereBetween('creations.created_at',[$dateStart, $dateEnd])
        ->get();
      }
      $notivications = DB::table('creations')
                      ->join('categories', 'categories.id', '=', 'creations.category_id')
                      ->select('creations.*','categories.name as category_name','categories.price')
                      ->where('creations.option','save')
                      ->where('creations.user_id', $userId)
                      ->whereMonth('creations.created_at', now()->month)
                      ->paginate(4);
        return view('bookkeeping.index',[
          'category'=>$category,
          'whereOther'=>$whereCategoryEx,
          'creations' => $creations,
          'wherecreations' =>$bookkepingsearch,
          'prindata'=>$printDate,
          'notivications'=>$notivications,
          'activePage'=>'bookkeeping'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
