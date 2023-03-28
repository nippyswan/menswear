<?php

namespace App\Http\Controllers;
use App\User;
use App\shareholder;
use App\sell_shareholder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class deluserfinalController extends Controller
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
 


   public function store(Request $request)
    {
        if((Auth::user()->username)==="admin")
            {
                $ud= $request->get('uname');
            
                if($ud!=="admin")
                {
                    $cur=User::where('username','=','admin')->get();
                    foreach($cur as $cr)
                    $current=$cr->password;
                         
                    $pass= $request->get('password');

                    if (Hash::check($pass, $current))
                    {
                        $sh=shareholder::where('username','=',$ud)->get();
                        foreach ($sh as $shr)
                        {
                           $sh_id=$shr->sh_id;
                        }
                        $ssh=sell_shareholder::all();
                        foreach ($ssh as $sshr) 
                        {
                            if($sshr->sh_id===$sh_id)
                            {
                                return \Redirect::route('listdeluser.index')        
                            ->with('untdel', 'User '.'"'.$ud.'"'.' Cannot be Deleted Because The User Has a Purchase Record!');   
                            }
                        }
                        $shd=shareholder::where('username','=',$ud)->delete();
                    
                        $usd=User::where('username','=',$ud)->delete();                      

                        return \Redirect::route('listdeluser.index')        
                        ->with('udel', 'User '.$ud.' Deleted!');
                    }
                        
                    else

                        return \Redirect::route('listdeluser.index')        
                        ->with('wrongpassdel', 'Password Incorrect !');
                    
                }    
                else         
                {
                    abort(403, 'Unauthorized action.');
                }
            }

        else
            abort(403, 'Unauthorized action.');
            
    }

    
}

