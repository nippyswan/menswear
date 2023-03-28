<?php

namespace App\Http\Controllers;


use Illuminate\Http\File;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \Stevebauman\EloquentTable\TableTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class backupController extends Controller
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
                 
       
        
        $out1=shell_exec('e:\wamp\bin\mysql\mysql5.7.23\bin\mysqldump -u root -proot menswear > e:\wamp\www\menswear\storage\app\menswear.sql');
        $db = Storage::disk('local')->get('menswear.sql');
$encrypted = Crypt::encryptString($db);

//$decrypted = Crypt::decryptString($encrypted);
Storage::put('encr.sql',$encrypted);


        date_default_timezone_set("Asia/Kathmandu");

        return Storage::disk('local')->download('encr.sql', 'MensWearBackup'.date("Y-m-d-H-i-s").'.mwb');


           
          
            }
        else
            abort(403, 'Unauthorized action.');
            
        
        
    }

    
}
