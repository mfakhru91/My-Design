<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class KaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $mont = now()->format('m');
        // $karya = \App\Creation::with('category')->whereMonth('created_at',$mont)->get();
        $karya = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.option','post')
                ->where('creations.payment','paid off')
                ->where('creations.user_id', $userId)
                ->whereMonth('creations.created_at', now()->month)
                ->get();
        $notivications = DB::table('creations')
                        ->join('categories', 'categories.id', '=', 'creations.category_id')
                        ->select('creations.*','categories.name as category_name','categories.price')
                        ->where('creations.option','save')
                        ->where('creations.user_id', $userId)
                        ->whereMonth('creations.created_at', now()->month)
                        ->paginate(4);
        $progress = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.option','save')
                ->where('creations.user_id', Auth::user()->id)
                ->whereMonth('creations.created_at', now()->month)
                ->paginate(5);
        $sumKarya = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->select('creations.*','categories.name as category_name','categories.price')
                    ->whereMonth('creations.created_at', now()->month)
                    ->where('payment','=','paid off')
                    ->where('creations.user_id', $userId)
                    ->get();
        $category = DB::table('categories')
                ->where('user_id', $userId)
                    ->get();
        return view('karya.index', [
                                    'karya'=>$karya,
                                    'category'=>$category,
                                    'progress'=>$progress,
                                    'sumKarya'=>$sumKarya,
                                    'notivications'=>$notivications,
                                    'activePage'=>'karya',
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
        \Validator::make($request->all(),[
            "name" => "required|min:5",
            "owner_name"=>"required|min:5",
            "avatar"=>"max:2084|image",
          ])->validate();
          $user = Auth::user();
          $category_name = $request->get('category');
          $category =  \App\Category::where('name',$category_name)->first();
          $new_karya = new \App\Creation;
          $new_costumeCategory = new \App\Category;
          $new_karya->name = $request->get('name');
          $new_karya->file = $request->get('link');
          $new_karya->order_name = $request->get('owner_name');
          $new_karya->payment = $request->get('pembayaran');
          $new_karya->option = $request->get('option');
          $new_karya->category_id = $category->id;
          $new_karya->user_id = $user->id;

          if($request->file('avatar')){
            $file = $request->file('avatar')->store('karya_img','public');
            $new_karya->image = $file;
          }
          $new_karya->save();
          return redirect()->route('karya.index');
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
        $user = Auth::user();
      $category_name = $request->get('category');
      $category =  \App\Category::where('name',$category_name)->first();
      $update = \App\Creation::findOrFail($id);
      $update->name = $request->get('name');
      $update->file = $request->get('link');
      $update->order_name = $request->get('owner_name');
      $update->payment = $request->get('pembayaran');
      $update->option = $request->get('option');
      $update->category_id = $category->id;
      $update->user_id = $user->id;
      if($request->file('avatar')){
        if($update->image && file_exists(storage_path('app/public/'.$update->image))){
          \Storage::delete('public/'.$update->image);
        }
        $new_path = $request->file('avatar')->store('karya_img', 'public');
        $update->image = $new_path;
      }
      $update->save();
      return redirect()->route('karya.index');
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

    public function delete($id)
    {
      $delete = \App\Creation::findOrFail($id);
      \Storage::delete('public/'.$delete->image);
      $delete->forceDelete();

      return redirect()->route('karya.index');
    }
}
