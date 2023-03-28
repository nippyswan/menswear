<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\brand;
use App\category;
use App\additemstock;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
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
    public function index()
    {
        
                   
           
            return view('/home');
            
        
        
    }
    public function show($q)
    {
        $brs=1000;
        $cats=1000;
        $brsn=1000;
        $catsn=1000;
        $descs=1000;
        $mps=1000;
    
        $cd=1000;
                   
           $stock=additemstock::where('code','=',$q)->get();
           
                 
            foreach ($stock as $stc) 
            {
                $cd=$stc->code;
                $brs=$stc->br_id;
                $cats=$stc->cat_id;
                $descs=$stc->descr;
                $mps=$stc->mp;
                $qty=$stc->qty;
            }
             
     
          
            $brand=brand::where('br_id','=',$brs)->get();
           
            
            $catg=category::where('cat_id','=',$cats)->get();
            

                      
            foreach ($brand as $brn) {
                $brsn=$brn->br_name;
            }
            foreach ($catg as $catgn) {
                $catsn=$catgn->cat_name;
            }
             
           

            $item='<strong>'."$brsn"." "."$catsn"." "."$descs".'</strong>'.'  '.'('.'<strong>MP:</strong>'.' ';
          

            
            if($cd===$q)
            {
            echo $item;
            echo '<span id="mp">';
            echo "$mps";
            echo '</span>)';
            if($qty===0)
                echo '<span id="oos" style="color:red;">--Item Out Of Stock!--</span>';
            
            }
            else       
            echo '<span style="color:red;">No Item Found!</span>';

        
    }
}
