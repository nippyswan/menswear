<?php

namespace App\Http\Controllers;
use App\User;

use App\additemstock;
use App\additempurchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class stockdelController extends Controller
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
                $st=additemstock::where('code','=',$q)->get();
                        foreach ($st as $stc)
                        {
                           $stdchk=$stc->delchk;
                        }
                        
                            if($stdchk===1)
                            {
                                return \Redirect::route('instock.index')        
                            ->with('stockntdel', 'Stock Item: '.'"'.$q.'"'.' Cannot be Deleted Because The Stock Item Is Already Confirmed!');   
                            
                            }
                        else
                        {
                $pur=additempurchase::where('code','=',$q)->delete();
               $std=additemstock::where('code','=',$q)->delete();
               
            
       
           // return view('/brandnd',['userc' => $q]);
            return \Redirect::route('instock.index')        
                        ->with('stockdel', 'Stock Item: '.'"'.$q.'"'.' Deleted!');
                    }
            }
            else
            abort(403, 'Unauthorized action.');
    }


  }

