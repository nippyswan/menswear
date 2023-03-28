<?php

namespace App\Http\Controllers;
use App\User;
use App\expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class expenseController extends Controller
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
        return view('expense');
    }
 


   public function store(Request $request)
    {
          $descr=$request->get('descr');
          $amt=$request->get('amt');            
                          
        $expense=new expense;
        $expense->descr=$request->get('descr');
        $expense->exp_amt=$request->get('amt');
        $expense->exp_date=date("Y/m/d");
        $expense->save();
                 

                
                        return \Redirect::route('expense.index')        
        ->with('saved', 'Expense '.'"'.$descr.'"'.' with amount '.$amt.' saved!');
                
            
    }

    
}

