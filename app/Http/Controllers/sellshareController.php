<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\sales;
use App\brand;
use App\billno;

use App\shareholder;
use App\sell_shareholder;
use App\category;
use App\additemstock;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class sellshareController extends Controller
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
        
                   
            $brand = brand::all();
            $catg=category::all();
            $shareholder = shareholder::all();
            $stock=additemstock::all();
            return view('/sellshare',['brandc' => $brand,'catgc' => $catg,'stockc' => $stock,'shareholderc' => $shareholder]);
            
        
        
    }
    public function show($q)
    {
        $brs=1000;
        $cats=1000;
        $brsn=1000;
        $catsn=1000;
        $descs=1000;
        
    
        $cd=1000;
                   
           $stock=additemstock::where('code','=',$q)->get();
           
                 
            foreach ($stock as $stc) 
            {
                $cd=$stc->code;
                $brs=$stc->br_id;
                $cats=$stc->cat_id;
                $descs=$stc->descr;
                $cps=$stc->cp;
                $qty=$stc->qty;
            }
             
     
          
            $brand=brand::where('br_id','=',$brs)->get();
           
            
            $catg=category::where('cat_id','=',$cats)->get();
            

                      
            foreach ($brand as $brn) {
                $brsn=$brn->br_name;
            }
            foreach ($catg as $catgn) {
                $catsn=$catgn->cat_name;
            }
             
           

            $item='<strong>'."$brsn"." "."$catsn"." "."$descs".'</strong>'.'  '.'('.'<strong>CP:</strong>'.' ';
          

            
            if($cd===$q)
            {
            echo $item;
            echo '<span id="cp">';
            echo "$cps";
            echo '</span>)';
            if($qty===0)
                echo '<span id="oos" style="color:red;">--Item Out Of Stock!--</span>';
            
            }
            else       
            echo '<span style="color:red;">No Item Found!</span>';

        
    }
    
   public function store(Request $request)
    {
        $shareun=$request->get('shareun');
        $sharepass=$request->get('sharepassword');

        $shareid=shareholder::where('username','=',$shareun)->get();
        foreach($shareid as $shareidd)
                     $shid=$shareidd->sh_id;

        $sharep=user::where('username','=',$shareun)->get();
        foreach($sharep as $sharepp)
                     $shpass=$sharepp->password;
        if (Hash::check($sharepass, $shpass)) 
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
                    $cps[$pos]=$stc->cp;
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
          
            
           
            $sps=$request->get('sps');

            foreach ($sps as $pos => $spv) 
        {
            if($qty[$pos]<=$qtyc[$pos]&&$spv>0)
                continue;
                else
                return \Redirect::route('sellshare.index')        
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
                $sales->billno=$bid;
                $sales->soldby=Auth::user()->username;
                $sales->save();  

                $newqty[$pos]=$qtyc[$pos]-$qty[$pos];
                additemstock::where('code', $code[$pos])
                ->update(['qty' => $newqty[$pos],'delchk' => 1]);
              


            }
          


            $slsh=new sell_shareholder;
            $slsh->billno=$bid;
            $slsh->sh_id=$shid; 
            $slsh->save(); 
            
                   
            return view('/printpsh',['bidc' => $bid,'codec' => $code,'qtyc' => $qty,'spsc' => $sps,'cpsc' => $cps,'brsnc' => $brsn,'catsnc' => $catsn,'descsc' => $descs,'tspc'=>$tsp]);
        }  
    

        else 
            return \Redirect::route('sellshare.index')        
            ->with('wrongpass', 'Shareholder\'s Password Incorrect !'); 
    }
}
