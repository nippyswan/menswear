<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\return_item;
use App\billno;
use App\brand;
use App\sales;
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

class custfoundController extends Controller
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
            $q=$request->get('billnum');
            $billnum=sales::where('billno','=',$q)->get();
            $billnumret=return_item::where('ref_billno','=',$q)->get();
            foreach ($billnum as $billno) 
            {
                $date=$billno->date;
                $soldby=$billno->soldby;
            }
            foreach ($billnumret as $billno) 
            {
                $dateret=$billno->date;
                $retby=$billno->retby;
            }
            if(isset($date))
            {   
                if(isset($dateret))
                {
                    foreach ($billnum as $pos => $billno) 
                    {
                        $code[$pos]=$billno->code;
                        $qty[$pos]=$billno->qty;
                        $sp2[$pos]=$billno->sp;
                        $sp1[$pos]=$sp2[$pos]/$qty[$pos];
                        $sl=return_item::where('ref_billno','=',$q)
                        ->where('code','=',$code[$pos])->get();
                
                        foreach ($sl as $stc) 
                        {
                    
                            $qty[$pos]=$qty[$pos]-$stc->qty;              

                        }  
                        $sp[$pos]=$sp1[$pos]*$qty[$pos];
                        $stock=additemstock::where('code','=',$code[$pos])->get();
                        foreach ($stock as $stc) 
                        {
                        
                            $brs=$stc->br_id;
                            $cats=$stc->cat_id;
                        

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
                    return view('/custfound',['billc'=>$q,'datec'=>$dateret,'soldbyc'=>$retby,'codec'=>$code,'qtyc'=>$qty,'spc'=>$sp,'brsnc'=>$brsn,'catsnc'=>$catsn]);

                                    
                }               
                 
            
                else
                {
                    foreach ($billnum as $pos => $billno)
                    {
                        $code[$pos]=$billno->code;
                        $qty[$pos]=$billno->qty;
                        $sp[$pos]=$billno->sp;
               

                        $stock=additemstock::where('code','=',$code[$pos])->get();
                        foreach ($stock as $stc) 
                        {
                
                            $brs=$stc->br_id;
                            $cats=$stc->cat_id;
                            

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

                    return view('/custfound',['billc'=>$q,'datec'=>$date,'soldbyc'=>$soldby,'codec'=>$code,'qtyc'=>$qty,'spc'=>$sp,'brsnc'=>$brsn,'catsnc'=>$catsn]);
                }
            
            }
            else 
                return \Redirect::route('retbycust.index')        
                    ->with('retbycust', 'Bill Not Found!');   
        }
        else
            abort(403, 'Unauthorized action.');   
            
    }

    public function store(Request $request)
    {
        if((Auth::user()->username)=="admin")
        {
        
            $billn=$request->get('billno');
            $code=$request->get('code');
            $qty=$request->get('qty');
            $qtyc=$request->get('qtyc');
            $sp=$request->get('sp');

            if(!isset($code))
                return \Redirect::route('retbycust.index')        
            ->with('returned', 'No Item/s Returned!');  

            
            $q=$request->get('billno');//again for short typing
           
            $billnumret=return_item::where('ref_billno','=',$q)->get();
            
            foreach ($billnumret as $billno) 
            {
                $dateret=$billno->date;
                
            }
            $c=0;
            $tsp=0.0;  
              
                if(isset($dateret))
                {
                    foreach ($code as $pos => $cd)
                    { 
                      
                        $sl=sales::where('billno','=',$q)
                        ->where('code','=',$cd)->get();

                        $qtysl=0;
                        foreach ($sl as $sk) 
                        {
                            $qtysl+=$sk->qty;
                        }
                        
                        $rt=return_item::where('ref_billno','=',$q)
                        ->where('code','=',$cd)->get();
                        
                        $qtyrt=0;
                        foreach ($rt as $rk) 
                        {
                            $qtyrt+=$rk->qty;   
                        }
                        $qtysa[$pos]=$qtysl-$qtyrt;

                        if((float)$qtysa[$pos]!==(float)$qtyc[$pos])
                           return \Redirect::route('retbycust.index')        
                    ->with('retbycust', 'Error! Invalid Form Submission!');                    
                            

                          
                    }   
                    
                }
              
                else
                {
                    foreach ($code as $pos => $cd)
                    { 
                      
                        $sl=sales::where('billno','=',$q)
                        ->where('code','=',$cd)->get();

                        $qtysl[$pos]=0;
                        foreach ($sl as $sk) 
                        {
                            $qtysl[$pos]+=(float)$sk->qty;
                        }
                        
                        

                        if($qtysl[$pos]!==(float)$qtyc[$pos])
                            
                          return \Redirect::route('retbycust.index')        
                        ->with('retbycust', 'Error! Invalid Form Submission!');                   
                            

                          
                    }   
                    
                    

                }
        foreach ($code as $pos => $cd)
        {   

            $nsp=(float)$sp[$pos]/(float)$qtyc[$pos];
            $nnsp=$nsp*(float)$qty[$pos];
            $spbill[$pos]=(float)$sp[$pos]-$nnsp;

            $tsp+=$spbill[$pos];
           
            

            $stock=additemstock::where('code','=',$cd)->get();
           
                 
            foreach ($stock as $stc) 
            {             
                $qtys[$pos]=$stc->qty;
                $brs=$stc->br_id;
                $cats=$stc->cat_id;
                $descs[$pos]=$stc->descr;
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

            


            if($qty[$pos]!=='0')
            {
                $c=1;

                
            

          $retitem=new return_item;
            $retitem->code=$cd;
            $retitem->date=date("Y/m/d");
            $retitem->qty=$qty[$pos];
            $retitem->sp=$nnsp;
            $retitem->ref_billno=$billn;
           
            $retitem->retby=Auth::user()->username;
            $retitem->save();


            
                $newbillqty[$pos]=(float)$qtyc[$pos]-(float)$qty[$pos];
            
                

            $newqty[$pos]=$qtys[$pos]+$qty[$pos];
            additemstock::where('code', $cd)
                ->update(['qty' => $newqty[$pos]]);

                
            }
            else 
                $newbillqty[$pos]=(float)$qtyc[$pos];
            
        }
        
        
        if($c===1)
        return view('/printpret',['bidc' => $billn,'codec' => $code,'qtyc' => $newbillqty,'spsc' => $spbill,'brsnc' => $brsn,'catsnc' => $catsn,'descsc' => $descs,'tspc'=>$tsp]);
     
     
     else 
        return \Redirect::route('retbycust.index')        
        ->with('returned', 'No Item/s Returned!');  
        
       
         }
        else
            abort(403, 'Unauthorized action.');

    
    }
}
