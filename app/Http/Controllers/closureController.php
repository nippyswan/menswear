<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\expense; 


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class closureController extends Controller
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
      date_default_timezone_set("Asia/Kathmandu");
       $exp=expense::whereDate('exp_date', date("Y/m/d"))
             ->get();

         $texp=0.0;
        foreach ($exp as $ex) {
            $texp+=$ex->exp_amt;
        }

           

        $purc=DB::table('purchase')
        ->whereDate('date', date("Y/m/d"))
        ->join('stock', 'purchase.code', '=', 'stock.code')
        ->join('brand', 'stock.br_id', '=', 'brand.br_id')
        ->join('category', 'stock.cat_id', '=', 'category.cat_id')
        ->select('purchase.code', 'purchase.qty', 'stock.cp', 'stock.descr','brand.br_name','category.cat_name')
        ->get();

        $tpurc=0.0;
        foreach ($purc as $pur) {
            $tpurc+=$pur->cp*$pur->qty;
        }

        $puret=DB::table('ret_whole')
        ->whereDate('date', date("Y/m/d"))
        ->join('stock', 'ret_whole.code', '=', 'stock.code')
        ->join('brand', 'stock.br_id', '=', 'brand.br_id')
        ->join('category', 'stock.cat_id', '=', 'category.cat_id')
        ->select('ret_whole.code', 'ret_whole.qty', 'stock.cp', 'stock.descr','brand.br_name','category.cat_name')
        ->get();

        $tpuret=0.0;
        foreach ($puret as $purt) {
            $tpuret+=$purt->cp*$purt->qty;
        }

          $sales=DB::table('sales')
        ->whereDate('date', date("Y/m/d"))
        ->join('stock', 'sales.code', '=', 'stock.code')
        ->join('brand', 'stock.br_id', '=', 'brand.br_id')
        ->join('category', 'stock.cat_id', '=', 'category.cat_id')
        ->select('sales.code', 'sales.qty', 'sales.sp', 'stock.descr','brand.br_name','category.cat_name','sales.billno','sales.soldby')
             ->get();
             $tsales=0.0;
        foreach ($sales as $sal) {
            $tsales+=$sal->sp;
        }

        $sh=DB::table('sell_shareholder')
        ->join('shareholder', 'sell_shareholder.sh_id', '=', 'shareholder.sh_id')
        ->select('sell_shareholder.billno', 'shareholder.username')
            ->get();
       

        $salesret=DB::table('return_item')
        ->whereDate('date', date("Y/m/d"))
        ->join('stock', 'return_item.code', '=', 'stock.code')
        ->join('brand', 'stock.br_id', '=', 'brand.br_id')
        ->join('category', 'stock.cat_id', '=', 'category.cat_id')
        ->select('return_item.code', 'return_item.qty', 'return_item.sp', 'stock.descr','brand.br_name','category.cat_name','return_item.ref_billno','return_item.retby')
        ->get();
        $tsalesret=0.0;
        foreach ($salesret as $salret) {
            $tsalesret+=$salret->sp;
        }


           
            return view('/closure',['expc'=>$exp,'texpc'=>$texp,'purcc'=>$purc,'tpurcc'=>$tpurc,'puretc'=>$puret,'tpuretc'=>$tpuret,'salesc'=>$sales,'tsalesc'=>$tsales,'salesretc'=>$salesret,'tsalesretc'=>$tsalesret,'shc'=>$sh]);
            
        
        
    }

    
}
