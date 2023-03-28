<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class deluserController extends Controller
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
       
            return view('/deluser',['userc' => $q]);
            }
            else
            abort(403, 'Unauthorized action.');
    }


   /*public function deleteuser(Request $request)
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
                        $us=User::where('username','=',$ud)->delete();

                        return \Redirect::route('listdeluser.index')        
                        ->with('udel', 'User '.$ud.' Deleted!');
                    } 
                    else
                    {
                        return \Redirect::route('deluser.index')        
        ->with('wrongpassdel', 'Password Incorrect !');
                    }
                }    
                else         
                {
                    abort(403, 'Unauthorized action.');
                }
            }

        else
            abort(403, 'Unauthorized action.');
            
            
    }

    */
}

