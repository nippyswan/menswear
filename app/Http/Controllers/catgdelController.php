<?php

namespace App\Http\Controllers;
use App\User;
use App\category;
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


class catgdelController extends Controller
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
                $cat=category::where('cat_name','=',$q)->get();
                        foreach ($cat as $catg)
                        {
                           $cat_id=$catg->cat_id;
                        }
                        $st=additemstock::all();
                        foreach ($st as $stc) 
                        {
                            if($stc->cat_id===$cat_id)
                            {
                                return \Redirect::route('catgnd.index')        
                            ->with('catgntdel', 'Category '.'"'.$q.'"'.' Cannot be Deleted Because The Category Has an Item/Items in Stock!');   
                            }
                        }
               $cat=category::where('cat_name','=',$q)->delete();
            
       
           // return view('/brandnd',['userc' => $q]);
            return \Redirect::route('catgnd.index')        
                        ->with('catgdel', 'Category '.'"'.$q.'"'.' Deleted!');
            }
            else
            abort(403, 'Unauthorized action.');
    }


  }

