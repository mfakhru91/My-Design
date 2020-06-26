<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function index(){
        $creation = DB::table('creations')
                    ->join('categories', 'categories.id','=','creations.category_id')
                    ->select('creations.*','categories.name as categoriesName')
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->paginate(15);
        return view('welcome',['creations'=>$creation]);
      }
}
