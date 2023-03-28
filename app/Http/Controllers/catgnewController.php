<?php

namespace App\Http\Controllers;
use App\User;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class catgnewController extends Controller
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
        return view('catgnew');
    }
    else
            abort(403, 'Unauthorized action.');
    }
 


   public function store(Request $request)
    {
           if((Auth::user()->username)=="admin")
            {
          $catname=$request->get('cat_name');

         Validator::make($request->all(), [

                    'cat_name' => 'required|unique:category',
                    ])->validate();                 
                          
        $catg=new category;
        $catg->cat_name=$request->get('cat_name');
        $catg->save();
                 

                
                        return \Redirect::route('catgnew.index')        
        ->with('newcat', 'Category '.'"'.$catname.'"'.' Added!');
    }
    else
            abort(403, 'Unauthorized action.');
                
            
    }

    
}

