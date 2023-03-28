<?php

namespace App\Http\Controllers;
use App\User;
use App\brand;
use App\additemstock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class branddelController extends Controller
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
                $br=brand::where('br_name','=',$q)->get();
                        foreach ($br as $brr)
                        {
                           $br_id=$brr->br_id;
                        }
                        $st=additemstock::all();
                        foreach ($st as $stc) 
                        {
                            if($stc->br_id===$br_id)
                            {
                                return \Redirect::route('brandnd.index')        
                            ->with('brandntdel', 'Brand '.'"'.$q.'"'.' Cannot be Deleted Because The Brand Has an Item/Items in Stock!');   
                            }
                        }
                
               $br=brand::where('br_name','=',$q)->delete();
            
       
           // return view('/brandnd',['userc' => $q]);
            return \Redirect::route('brandnd.index')        
                        ->with('branddel', 'Brand '.'"'.$q.'"'.' Deleted!');
            }
            else
            abort(403, 'Unauthorized action.');
    }


  }

