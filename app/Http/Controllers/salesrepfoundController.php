<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class salesrepfoundController extends Controller
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

    
    public function index(Request $request)
    {
        if((Auth::user()->username)=="admin")
            {
       
        $month= $request->get('month');
  

    
        $year= $request->get('year');
  

      
        switch ($month) {
            case '01':
                $monname='January';
                break;
            case '02':
                $monname='February';
                break;
            case '03':
                $monname='March';
                break;
            case '04':
                $monname='April';
                break;
            case '05':
                $monname='May';
                break;
            case '06':
                $monname='June';
                break;
            case '07':
                $monname='July';
                break;
            case '08':
                $monname='August';
                break;
            case '09':
                $monname='September';
                break;
            case '10':
                $monname='October';
                break;
            case '11':
                $monname='November';
                break;

            default:
                $monname='December';
                break;
        }

        $purc=DB::table('sales')
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->join('stock', 'sales.code', '=', 'stock.code')
        ->join('brand', 'stock.br_id', '=', 'brand.br_id')
        ->join('category', 'stock.cat_id', '=', 'category.cat_id')
        ->select('sales.code', 'sales.date', 'sales.qty', 'sales.sp', 'stock.descr','brand.br_name','category.cat_name','sales.billno','sales.soldby')
        ->latest('date')
        ->paginate(20);



        $purc->setPath($request->url()."?month=".$request->month."&year=".$request->year);

       
         
        $sh=DB::table('sell_shareholder')
        ->join('shareholder', 'sell_shareholder.sh_id', '=', 'shareholder.sh_id')
        ->select('sell_shareholder.billno', 'shareholder.username')
            ->get();

    
     
      

           
            return view('/salesrepfound',['monthc'=>$month,'yearc'=>$year,'monnamec'=>$monname,'purcc'=>$purc,'shc'=>$sh]);//,'qtysoldc'=>$qtysold,'grossprofitc'=>$grossprofit,'netprofitc'=>$netprofit]);
            }
        else
            abort(403, 'Unauthorized action.');
            
        
        
    }

    
}
