<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Auth::user();
        $creation = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->select('creations.*','categories.name as category_name','categories.price')
                    ->where('creations.user_id','=', $profil->id)
                    ->where('creations.option','post')
                    ->where('creations.user_id',$profil->id)
                    ->where('creations.payment','paid off')
                    ->get();
        $transaction = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->select('creations.*','categories.name as category_name','categories.price')
                    ->where('creations.user_id','=', $profil->id)
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->where('creations.user_id',$profil->id)
                    ->get();
        $notivications = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->select('creations.*','categories.name as category_name','categories.price')
                    ->where('creations.user_id',$profil->id)
                    ->where('creations.option','save')
                    ->whereMonth('creations.created_at', now()->month)
                    ->paginate(4);
        return view('profile.index',[
                    'profil'=>$profil,
                    'creation'=>$creation,
                    'notivications'=>$notivications,
                    'transaction'=>$transaction,
                    'activePage'=>'profile'
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
        $update = Auth::user();
        if($request->file('avatar')){
          $file = $request->file('avatar')->store('user_img','public');
          $update->avatar = $file;
        }
        $update->save();
        return redirect()->route('profile.index');
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
