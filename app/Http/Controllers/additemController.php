<?php

namespace App\Http\Controllers;
use App\User;
use App\brand;
use App\category;
use App\additempurchase;
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


class additemController extends Controller
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
           
            $brand = brand::all();
            $catg=category::all();
            return view('/additem',['brandc' => $brand],['catgc' => $catg]);
            
            }
        else
            abort(403, 'Unauthorized action.');
        
        
    }
 
protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

   public function store(Request $request)
    {
        if((Auth::user()->username)==="admin")
        {
                /*Validator::make($request->all(), [
                             'code' => 'required|string',
            '' => 'required|string',
            'email' => 'email|nullable',
            'homephone' => 'digits_between:6,10|nullable',
            'workphone' => 'digits_between:6,10|nullable',
            'mobilephone' => 'required|digits_between:6,10',
            'city' => 'required|string',
            'address' => 'required|string',
            'notes' => 'string|nullable',
            'date'=>'required|string|',
            'portnum'=>'digits_between:2,5|nullable',
            'apip'=>'ipv4|nullable',
            'custip'=>'ip
            v4|nullable',
            'ponport'=>'digits_between:2,5|nullable',
            'upass'=>'required|string|min:6',


])->validate();  */
      
            $code=$request->get('code');
            $cp=$request->get('cp');
            $mp=$request->get('mp');
            $br=$request->get('brand');
            $cat=$request->get('catg');
            $qty=$request->get('qty');

            $desc=$request->get('desc');

            $brg=brand::where('br_name','=',$br)->get();
            foreach ($brg as $brgg) 
            {
                $brv=$brgg->br_id; 
            }
         
            $catg=category::where('cat_name','=',$cat)->get();  
            foreach ($catg as $catgg)
            {
                $catv=$catgg->cat_id; 
            }

            $check=additemstock::where('code','=',$code)->get();
            
            foreach ($check as $chk) 
            {
                $codeck=$chk->code;
                $cpc=$chk->cp;
                $mpc=$chk->mp;
                $brc=$chk->br_id;
                $catc=$chk->cat_id;
                $qtyc=$chk->qty;
            } 
            if(isset($codeck))
            {         

                if($cp==$cpc&&$mp==$mpc&&$brv==$brc&&$catv==$catc) 
                    {
                        $purchase=new additempurchase;
                        $purchase->qty=$request->get('qty');
                        $purchase->code=$request->get('code');
                        $purchase->date=date("Y/m/d");
                        $purchase->save();

                        $newqty=$qtyc+$qty;
                        additemstock::where('code', $code)
                                    ->update(['qty' => $newqty]);
                       

                        

                        return \Redirect::route('additem.index')        
                        ->with('itemadded', '"'.$qty.' '.$br.' '.$cat.' '.$desc.'"'.' added to Stock!');
                    }
                else

                return \Redirect::route('additem.index')        
                ->with('itemnotadded', 'CP / MP / Brand / Category Do Not Match With Item '.$code.'!');
            }
            else             
            {
                $stock=new additemstock;
                $stock->code=$request->get('code');
                $stock->cp=$request->get('cp');
                $stock->mp=$request->get('mp');
                $stock->br_id=$brv;
                $stock->cat_id=$catv;
                $stock->qty=$request->get('qty');
                $stock->descr=$request->get('desc');
                $stock->delchk=0;
                $stock->save(); 

                $purchase=new additempurchase;
                $purchase->qty=$request->get('qty');
                $purchase->code=$request->get('code');
                $purchase->date=date("Y/m/d");
                $purchase->save();           

        
                return \Redirect::route('additem.index')        
                ->with('itemadded', 'New Item '.'"'.$br.' '.$cat.' '.$desc.'"'.' added!');
            }
        }
        else
            abort(403, 'Unauthorized action.');
        
                
            
    }

    
}

