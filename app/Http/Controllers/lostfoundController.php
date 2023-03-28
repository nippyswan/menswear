<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\lost;
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

class lostfoundController extends Controller
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
                
            return view('/lostfound',['codec'=>$q,'qtyc'=>$qty,'cpc'=>$cp,'brsnc'=>$brsn,'catsnc'=>$catsn,'descrc'=>$descr]);

                    
        }
        
        
        else 
        return \Redirect::route('lost.index')        
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
            return \Redirect::route('lost.index')        
            ->with('foundlost', 'No Item/s Entered In Damaged/Lost Record !');  
        
                    
           
            if($qty!=='0')
            {
                $stq=additemstock::where('code','=',$code)->get();
        
                foreach ($stq as $qts) 
                {
                
                    $qtys=$qts->qty;
                }

                $newqty=(float)$qtys-(float)$qty;
                if(($newqty<0)||(float)$qtys!==(float)$qtyc)
                    return \Redirect::route('lost.index')        
                    ->with('notfound', 'Error! Invalid Form Submission!'); 
            $lt=new lost;
            $lt->code=$code;
            $lt->date=date("Y/m/d");
            $lt->qty=$qty;
            $lt->save();

                
            

            additemstock::where('code', $code)
                ->update(['qty' => $newqty,'delchk' => 1]);
                return \Redirect::route('lost.index')        
        ->with('foundlost', $qty.' Item/s With Code: '.$code.' Entered In Damaged/Lost Record !');  

                
            }
            else 
        return \Redirect::route('lost.index')        
        ->with('notfound', 'No Item/s Entered In Damaged/Lost Record !');  
        }
        else
            abort(403, 'Unauthorized action.');
       


    
    }

    
}
