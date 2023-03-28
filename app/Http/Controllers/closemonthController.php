<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\closemonth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class closemonthController extends Controller
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

    
    public function index($q)
    {
            if((Auth::user()->username)=="admin")
            {
                $clc=closemonth::where('cmonyr','=',$q)->get();
              foreach ($clc as $clcc) {

                  if($clcc->cmonyr!=="")
                        return \Redirect::route('profit.index')        
                        ->with('alclosed', 'Month Already Closed!');
              }
                    
                
                $d=strtotime($q);
                if(date("m/Y",$d)===date("m/Y"))
                    return \Redirect::route('profit.index')        
                        ->with('notp', 'Too Early To Close Month!');
                $cl=new closemonth;
                $cl->cmonyr=$q;
                $cl->save();
                      
           
            return \Redirect::route('profit.index')        
                        ->with('closed', 'Month Closed!');
            }
        else
            abort(403, 'Unauthorized action.');
            
        
        
    }

    
}
