<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\additemstock;

use App\sales;
use App\return_item;

use App\lost;

use App\expense;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class profitfoundController extends Controller
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
        $month=$request->get('month');
        $year=$request->get('year');
        
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

        $j=$monname;
        $g=strtotime($j);
        $gvn=date("m",$g);

       
     
         $now=date("m");
         $nowy=date("Y");
        if($gvn>$now||$year>$nowy)
                    return \Redirect::route('profit.index')        
                        ->with('ytc', 'Month/Year Yet To Come!');

        $salep=sales::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->join('stock', 'sales.code', '=', 'stock.code')
        ->select('sales.code', 'sales.qty', 'stock.cp')
        ->get();
        $salescp=0.0;
        $salesqty=0;        
        foreach ($salep as $slp) {
            $salescpp=$slp->qty*$slp->cp;
            $salescp+=$salescpp;
            $salesqty+=$slp->qty;
        }

        $retp=return_item::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->join('stock', 'return_item.code', '=', 'stock.code')
        ->select('return_item.code', 'return_item.qty', 'stock.cp')
        ->get();
        $retcp=0.0;
        $retqty=0;        
        foreach ($retp as $rtp) {
            $retcpp=$rtp->qty*$rtp->cp;
            $retcp+=$retcpp;
            $retqty+=$rtp->qty;
        }
                    
        $ssp=sales::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('sp');  
        
        $rsp=return_item::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->sum('sp');  
       
        $exp=expense::whereYear('exp_date', $year)
        ->whereMonth('exp_date', $month)
        ->sum('exp_amt'); 
        $lost=lost::whereYear('date', $year)
        ->whereMonth('date', $month)
        ->join('stock', 'lost.code', '=', 'stock.code')
        ->select('lost.code', 'lost.qty', 'stock.cp')
        ->get();
        $lcp=0.0;
        $lostqty=0;        
        foreach ($lost as $lt) {
            $lcpp=$lt->qty*$lt->cp;
            $lcp+=$lcpp;
            $lostqty+=$lt->qty;
        }

       

        $grossprofit=$ssp-$salescp-($rsp-$retcp);
        $netprofit=$grossprofit-$exp-$lcp;
        $qtysold=$salesqty-$retqty; 
        
      

           
            return view('/profitfound',['monthc'=>$month,'yearc'=>$year,'monnamec'=>$monname,'qtysoldc'=>$qtysold,'grossprofitc'=>$grossprofit,'netprofitc'=>$netprofit]);
            }
        else
            abort(403, 'Unauthorized action.');
        
        
    }

    
}
