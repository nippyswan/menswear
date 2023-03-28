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


class changeemailController extends Controller
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
    public function index(Request $request)
    {   
        
        return view('/changeemail');
        //return view('/home');
    }
     public function store(Request $request)
    {
        $un=Auth::user()->username;
        $cur=User::where('username','=',$un)->get();
        foreach($cur as $cr)
                $current=$cr->password;
            //echo $current.'\n';
            $curu=$request->get('curpass');
            //echo $curu.'\n';
            //$d=bcrypt($curu);
            //echo $d;
            if (Hash::check($curu, $current)) {
                
            
                Validator::make($request->all(), [

                    'email' => 'required|email|unique:users',
                    ])->validate();
                 $mailchk=User::all();
                        
                $user=User::where('username','=',$un)->get();
                foreach($user as $usr)
                {
            
                $usr->email = $request->get('email');
                $usr->save();
                }
                
            return \Redirect::route('home')        
                ->with('changedemail', 'Email Successfully Changed !');
                
                
                }
            else 
                return \Redirect::route('changeemail.index')        
                ->with('wrongpass', 'Current Password Incorrect !');
            }
}
