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


class changepasswordController extends Controller
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
        
        return view('/changepassword');
        //return view('/home');
    }
     public function store(Request $request)
    {
        $un=Auth::user()->username;
        $cur=User::where('username','=',$un)->get();
        foreach($cur as $cr)
                $current=$cr->password;
            //echo $current.'\n';
            $curu=$request->get('curpassword');
            //echo $curu.'\n';
            //$d=bcrypt($curu);
            //echo $d;
            if (Hash::check($curu, $current)) {
            //if(bcrypt($curu)==$current)
            //{
        Validator::make($request->all(), [

            'password' => 'required|string|min:6|confirmed',
            ])->validate();
        $user=User::where('username','=',$un)->get();
        foreach($user as $usr)
        {
    
        $usr->password = bcrypt($request->get('password'));
        $usr->save();
    }
        
    return \Redirect::route('home')        
        ->with('changemessage', 'Password Successfully Changed !');
    }
    else 
        return \Redirect::route('changepassword.index')        
        ->with('matchmessage', 'Current Password Incorrect !');
    }
}
