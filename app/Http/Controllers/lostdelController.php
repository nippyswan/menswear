<?php

namespace App\Http\Controllers;
use App\User;

use App\lost;
use App\additemstock;

use App\closemonth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class lostdelController extends Controller
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
    
    public function index($q)
    {
                if((Auth::user()->username)==="admin")
            {

                $ex=lost::where('l_id','=',$q)->get();
                foreach ($ex as $exx) {
                     $dt=$exx->date;
                     $code=$exx->code;
                     $qty=$exx->qty;
                }
                $edd=strtotime($dt);
                $edt=date("m/Y",$edd);
                $cm=closemonth::all();
                foreach ($cm as $c) {
                    $cmd=$c->cmonyr;
                    $cmdd=strtotime($cmd);
                    $cmdt=date("m/Y",$cmdd);
                    if($cmdt===$edt)
                        return \Redirect::route('lostdam.index')        
                        ->with('lostntdel', 'Lost Entry Of Item: '.'"'.$code.'"'.' Cannot Be Deleted! Closed Month\'s Record!');


                }
                $lt=lost::where('l_id','=',$q)->delete();

                $cdd=additemstock::where('code','=',$code)->get();
        
        foreach ($cdd as $cd) 
        {
            
            $qtys=$cd->qty;
        }

                $newqty=$qtys+$qty;
                additemstock::where('code', $code)
                ->update(['qty' => $newqty]);   
                        
                            
                                            
       
          
            return \Redirect::route('lostdam.index')        
                        ->with('lostdel', 'Lost Entry Of Item: '.'"'.$code.'"'.' Deleted!');
                    
            }
            else
            abort(403, 'Unauthorized action.');
    }


  }

