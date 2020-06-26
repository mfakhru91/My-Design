<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PbookkeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $creations = DB::table('creations')
      ->join('categories', 'categories.id', '=', 'creations.category_id')
      ->select('creations.*','categories.name as category_name','categories.price')
      ->whereMonth('creations.created_at',now()->month )
      ->get();
      $categoryEx = DB::table('creations')
              ->join('categories', 'categories.id', '=', 'creations.category_id')
              ->whereNotIn('categories.name',['Poster','Banner','Logo','Vektor'])
              ->whereMonth('creations.created_at',now()->month)
              ->get();
      $logo = DB::table('categories')->where('name','Logo')->first();
      $banner = DB::table('categories')->where('name','Banner')->first();
      $poster = DB::table('categories')->where('name','Poster')->first();
      $vektor = DB::table('categories')->where('name','Logo')->first();
        return view('print_bookkeeping.index',[
          'logo'=>$logo,
          'banner'=>$banner,
          'poster'=>$poster,
          'vektor'=>$vektor,
          'other'=>$categoryEx,
          'creations' => $creations,
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
