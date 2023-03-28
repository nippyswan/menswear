<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ret_whole;
use App\brand;
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

class wholefoundController extends Controller
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
        
        $q=$request->get('code');
        $code=additemstock::where('code','=',$q)->get();
        
        foreach ($code as $cd) 
        {
            $brid=$cd->br_id;
            $catid=$cd->cat_id;
            $cp=$cd->cp;
            $descr=$cd->descr;
            $qty=$cd->qty;
        }
        
        if(isset($cp))
        {   
            $brand=brand::where('br_id','=',$brid)->get();
                   
                    
            $catg=category::where('cat_id','=',$catid)->get();
                          
                foreach ($brand as $brn) {
                    $brsn=$brn->br_name;
                }
                foreach ($catg as $catgn) {
                    $catsn=$catgn->cat_name;
                }
                
            return view('/wholefound',['codec'=>$q,'qtyc'=>$qty,'cpc'=>$cp,'brsnc'=>$brsn,'catsnc'=>$catsn,'descrc'=>$descr]);

                    
        }
        
        
        else 
        return \Redirect::route('rettowhole.index')        
        ->with('notfound', 'Item Not Found In Stock !'); 
         }
        else
            abort(403, 'Unauthorized action.');     
            
    }

    public function store(Request $request)
    {
        if((Auth::user()->username)=="admin")
            {
        $code=$request->get('code');
        $qty=$request->get('qty');
         $qtyc=$request->get('qtyc');
            

        if(!isset($code))
            return \Redirect::route('rettowhole.index')        
            ->with('foundret', 'No Item/s Returned!');  
        
                    
           
            if($qty!=='0')
            {

                $stq=additemstock::where('code','=',$code)->get();
        
                foreach ($stq as $qts) 
                {
                
                    $qtys=$qts->qty;
                }

                $newqty=(float)$qtys-(float)$qty;
                if(($newqty<0)||(float)$qtys!==(float)$qtyc)
                    return \Redirect::route('rettowhole.index')        
                    ->with('foundret', 'Error! Invalid Form Submission!'); 

            $retw=new ret_whole;
            $retw->code=$code;
            $retw->date=date("Y/m/d");
            $retw->qty=$qty;
            $retw->save();




            additemstock::where('code', $code)
                ->update(['qty' => $newqty,'delchk' => 1]);
         
                return \Redirect::route('rettowhole.index')        
        ->with('foundret', $qty.' Item/s With Code: '.$code.' Returned To Wholesaler !');  

                
            }
            else 
        return \Redirect::route('rettowhole.index')        
        ->with('foundret', 'No Item/s Returned!');  
         }
        else
            abort(403, 'Unauthorized action.');
       


    
    }
}
