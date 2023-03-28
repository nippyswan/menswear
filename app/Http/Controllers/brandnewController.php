<?php

namespace App\Http\Controllers;
use App\User;
use App\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class brandnewController extends Controller
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
    public function index()
    {
        if((Auth::user()->username)=="admin")
            {
        return view('brandnew');
    }
    else
            abort(403, 'Unauthorized action.');
    }
 


   public function store(Request $request)
    {
           if((Auth::user()->username)=="admin")
            {
          $brname=$request->get('br_name');

          Validator::make($request->all(), [

                    'br_name' => 'required|unique:brand',
                    ])->validate();
            
                  
        $brand=new brand;
        $brand->br_name=$request->get('br_name');
        $brand->save();
                 

                
                        return \Redirect::route('brandnew.index')        
        ->with('newbr', 'Brand '.'"'.$brname.'"'.' Added!');
    }
    else
            abort(403, 'Unauthorized action.');
                
            
    }

    
}

