<?php

namespace App\Http\Controllers\Auth;

use App\Models\Plat;
use Illuminate\Http\Request;
use App\Models\ProfileRestaurant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    
 public function login(Request $request){
  $input = $request->all();
  $this->validate($request,[
    'email' =>'required|email',
    'password' => 'required',
  ]);

  $email = User::where('email',$input['email'])->count();
  if($email > 0 )
  {
    
    if(auth()->attempt(array('is_actived' => 1,'role' => "client", 'email' => $input['email'], 'password' => $input['password'])))
    {
      // if (auth()->user()->is_admin == 1)
      // {
      //   return view('isadmins.index');
      // } 
           return redirect('/');
    
    } 
    else{
      return redirect('login')->with(session()->flash('alert-danger', "Mot de passe incorect, compte inactif ou ne correspond pas!!!  "));

    }
  }else{
    return redirect('login')->with(session()->flash('alert-danger', "Email incorrect.!!!  "));
  }

 }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}


