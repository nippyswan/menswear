<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\shareholder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Access\AuthorizationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
   public function showRegistrationForm()
    {
        
        if((Auth::user()->username)=="admin")
            return view('auth.register');
        else
          abort(403, 'Unauthorized action.');
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
 /*public function store(Request $request)
    {
  $shareholder=new shareholder;
        $shareholder->username=$request->get('username');
        $shareholder->save();
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*$user=new User;
        $user->username=$data['username'];
                $user->email=$data['email'];
                $user->password=Hash::make($data['password']);
                $user->save();*/
                $adds=Input::get('adds');
                if($adds!=null)
                {
                $shareholder=new shareholder;
        $shareholder->username=$data['username'];
        $shareholder->save();
                }
        //return \Redirect::route('home');
        
      

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
  


}

