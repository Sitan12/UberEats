<?php

namespace App\Http\Controllers\Auth;


use App\Mail\EMail;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    
    use RegistersUsers;
 
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'client';
        $user->is_admin = 0;
        $user->password = Hash::make($request->password);
        $user->is_actived = 0;
        $user->save();

         Profile::create([
            'user_id' => $user->id,
        ]);

        Mail::to($request->email)->send(new EMail($user));
        return redirect()->back()->with(session()->flash('alert-success', "Votre compte a été créé, s'il vous plait verifiier votre email pour verifier votre compte!!!  "));

    }

    public function verify($verification){
        $user = User::where('is_actived',$verification)->first();
        if($user){
            $user->is_actived = 1;
            $user->update();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Votre compte est verifié. Connectez-vous!'));
        }else{
            return redirect()->route('login')->with(session()->flash('alert-danger', 'Email deja verifié!'));

        }

    }
   
    
}
