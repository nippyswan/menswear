<?php

namespace App\Http\Controllers;
use App\sales;
use App\billno;
use App\brand;
use App\category;
use App\additemstock;
use App\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class savePrintController extends Controller
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
    public function index()
    {
               
        
    }
 


   public function store(Request $request)
    {
        

        $code=$request->get('code');

        foreach ($code as $pos => $cd)
        {
            
        
            $stock=additemstock::where('code','=',$cd)->get();
           
                 
            foreach ($stock as $stc) 
            {
                
                $brs=$stc->br_id;
                $cats=$stc->cat_id;
                $descs[$pos]=$stc->descr;
                $mps[$pos]=$stc->mp;
                $qtyc[$pos]=$stc->qty;

            }    
          
            $brand=brand::where('br_id','=',$brs)->get();
                      
            $catg=category::where('cat_id','=',$cats)->get();
                                
            foreach ($brand as $brn) 
            {
                $brsn[$pos]=$brn->br_name;
            }
            foreach ($catg as $catgn) 
            {
                $catsn[$pos]=$catgn->cat_name;
            }

        }
        $qty=$request->get('qty');
        $dsc=$request->get('dsc');
        $ty=$request->get('ty');
        $sps=$request->get('sps');

        foreach ($sps as $pos => $spv) 
        {
            if($qty[$pos]<=$qtyc[$pos]&&$spv>0)
                continue;
                else
                return \Redirect::route('home.index')        
            ->with('qtydsc', 'Not Enough Qty In Stock Or Invalid Discount !'); 
        }

        
        $abill=billno::get()->max('billno');
            if($abill===null)
            $bid=7890;
            else
            $bid=$abill+1;
        $billno=new billno; 
            $billno->billno=$bid;
            $billno->bill_date=date("Y/m/d");
            $billno->save();
            
        

        $tsp=0.0;
        foreach ($sps as $pos => $spv) 
        {
                        
            
            $tsp+=$spv;
            $sales=new sales;
            $sales->code=$code[$pos];
            $sales->date=date("Y/m/d");
            $sales->qty=$qty[$pos];
            $sales->sp=$spv;
            $sales->soldby=Auth::user()->username;
            $sales->billno=$bid;
            $sales->save();  

            $newqty[$pos]=$qtyc[$pos]-$qty[$pos];
            additemstock::where('code', $code[$pos])
                ->update(['qty' => $newqty[$pos],'delchk' => 1]);
            
            


        }
        
        

        return view('/printp',['bidc' => $bid,'codec' => $code,'qtyc' => $qty,'dscc' => $dsc,'tyc' => $ty,'spsc' => $sps,'mpsc' => $mps,'brsnc' => $brsn,'catsnc' => $catsn,'descsc' => $descs,'tspc'=>$tsp]);
      

    
    }

}