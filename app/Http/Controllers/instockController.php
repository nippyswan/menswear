<?php

namespace App\Http\Controllers;
use App\additemstock;
use App\brand;
use App\category;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class instockController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        return view('home');
    }*/
    
    public function index(Request $request)
    {
                if((Auth::user()->username)=="admin")
            {
       $stck=additemstock::all();
       $total=0.0;
       foreach ($stck as $st) {
           $cp=$st->cp;
           $qty=$st->qty;
           $total+=($st->cp*$st->qty);
       }
        $stock = additemstock::paginate(20);
        $brand = brand::all();
        $category = category::all();       

return view('/instock',['stockc' => $stock,'brandc' => $brand, 'categoryc'=>$category,'tot'=>$total]);
}
 else
          abort(403, 'Unauthorized action.');
}
  
}
