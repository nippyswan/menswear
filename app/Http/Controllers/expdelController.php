<?php

namespace App\Http\Controllers;
use App\User;

use App\expense;

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


class expdelController extends Controller
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

                $ex=expense::where('exp_id','=',$q)->get();
                foreach ($ex as $exx) {
                    $dc=$exx->descr;
                    $dt=$exx->exp_date;
                }
                $edd=strtotime($dt);
                $edt=date("m/Y",$edd);
                $cm=closemonth::all();
                foreach ($cm as $c) {
                    $cmd=$c->cmonyr;
                    $cmdd=strtotime($cmd);
                    $cmdt=date("m/Y",$cmdd);
                    if($cmdt===$edt)
                        return \Redirect::route('exp.index')        
                        ->with('expntdel', 'Expense '.'"'.$dc.'"'.' Cannot Be Deleted! Closed Month\'s Record!');


                }
                $exp=expense::where('exp_id','=',$q)->delete();
                        
                        
                            
                                            
       
          
            return \Redirect::route('exp.index')        
                        ->with('expdel', 'Expense '.'"'.$dc.'"'.' Deleted!');
                    
            }
            else
            abort(403, 'Unauthorized action.');
    }


  }

