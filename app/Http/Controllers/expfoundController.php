<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expense;



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

class expfoundController extends Controller
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

        $purc=expense::whereYear('exp_date', $year)
        ->whereMonth('exp_date', $month)
        ->latest('exp_date')
        ->paginate(20);

        $texp=0.0;
        foreach ($purc as $pur) {
            $texp+=$pur->exp_amt;
        }

        $purc->setPath($request->url()."?month=".$request->month."&year=".$request->year);    
        
    
     
      

           
            return view('/expfound',['monthc'=>$month,'yearc'=>$year,'monnamec'=>$monname,'purcc'=>$purc,'texpc'=>$texp]);//,'qtysoldc'=>$qtysold,'grossprofitc'=>$grossprofit,'netprofitc'=>$netprofit]);
          }
        else
            abort(403, 'Unauthorized action.');   
        
        
    }

    
}
