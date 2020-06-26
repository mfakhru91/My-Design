<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $home = DB::table('creations')
        ->join('categories', 'categories.id', '=', 'creations.category_id')
        ->select('creations.*','categories.name as category_name','categories.price')
        ->where('creations.option','post')
        ->where('creations.payment','paid off')
        ->where('creations.user_id',$userId)
        ->whereMonth('creations.created_at',now()->month )
        ->whereYear('creations.created_at',now()->year)
        ->get();
        $january = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','01');
        $february = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','02');
        $march = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','03');
        $april = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','04');
        $may = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','05');
        $june = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','06');
        $july = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','07');
        $august = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','08');
        $september = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','09');
        $october = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','10');
        $november = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','11');
        $december = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->select('creations.*','categories.name as category_name','categories.price')
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at','12');

        // mengambil data per kategory
        $logo = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->where('categories.name','like','%'.'ogo'.'%')
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->where('creations.user_id',$userId)
                    ->whereMonth('creations.created_at',now()->month )
                    ->whereYear('creations.created_at',now()->year)
                    ->get();
        $poster = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->where('categories.name','like','%'.'oster'.'%')
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->where('creations.user_id',$userId)
                    ->whereMonth('creations.created_at',now()->month )
                    ->whereYear('creations.created_at',now()->year)
                    ->get();
        $banner = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->where('categories.name','like','%'.'anner'.'%')
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->where('creations.user_id',$userId)
                    ->whereMonth('creations.created_at',now()->month )
                    ->whereYear('creations.created_at',now()->year)
                    ->get();
        $vektor = DB::table('creations')
                    ->join('categories', 'categories.id', '=', 'creations.category_id')
                    ->where('categories.name','like','%'.'ektor'.'%')
                    ->where('creations.option','post')
                    ->where('creations.payment','paid off')
                    ->where('creations.user_id',$userId)
                    ->whereMonth('creations.created_at',now()->month )
                    ->whereYear('creations.created_at',now()->year)
                    ->get();
        $categoryEx = DB::table('creations')
                ->join('categories', 'categories.id', '=', 'creations.category_id')
                ->where('categories.name','not like',"%ogo%")
                ->where('categories.name','not like',"%oster%")
                ->where('categories.name','not like',"%anner%")
                ->where('categories.name','not like',"%ektor%")
                ->where('creations.user_id',$userId)
                ->whereMonth('creations.created_at',now()->month)
                ->get();
          $notivications = DB::table('creations')
                                ->join('categories', 'categories.id', '=', 'creations.category_id')
                                ->select('creations.*','categories.name as category_name','categories.price')
                                ->where('creations.option','save')
                                ->where('creations.user_id', $userId)
                                ->whereMonth('creations.created_at', now()->month)
                                ->paginate(4);
        return view('dashboard',[
            'creation'=>$home,
            'jan' => $january,
            'feb' => $february,
            'mar' => $march,
            'apr' => $april,
            'may' => $may,
            'jun' => $june,
            'jul' => $july,
            'aug' => $august,
            'sep' => $september,
            'oct' => $october,
            'nov' => $november,
            'dec' => $december,
            'logo' => $logo,
            'poster'=>$poster,
            'banner'=>$banner,
            'vektor'=>$vektor,
            'notivications'=>$notivications,
            'categoryEx' => $categoryEx,
            'activePage'=>'dashboard'
            ]);
    }
}
