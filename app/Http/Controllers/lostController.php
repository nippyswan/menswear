<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lost;
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

class lostController extends Controller
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
        if((Auth::user()->username)=="admin")
            {
            return view('/lost');
            }
        else
            abort(403, 'Unauthorized action.');
        
        
   }

  
}
