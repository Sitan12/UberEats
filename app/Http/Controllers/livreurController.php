<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use App\Models\User;
use App\Models\Livreur;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\ProfileLivreur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class livreurController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $commandes = Commande::all();
        return view('livreurs.index',compact('commandes'));
    }

    public function create()
    {
        return view('livreurs.create');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'longitude' =>  ['required'],
            'latitude' =>  ['required'],
        ]);
    }

    public function login(){
        return view('livreurs.login');
    }

    public function addLogin(Request $request){
       
        $input = $request->all();
         $this->validate($request,[
    'email' =>'required|email',
    'password' => 'required',
  ]);
  $email = User::where('email',$input['email'])->count();
  if($email > 0 )
  {
    
    if(auth()->attempt(array('is_actived' => 1,'role' => "livreur", 'email' => $input['email'], 'password' => $input['password'])))
    {
      // if (auth()->user()->is_admin == 1)
      // {
      //   return view('isadmins.index');
      // } 
           return redirect('/');
    
    } 
    else{
      return redirect()->route('livreur.login')->with(session()->flash('alert-danger', "Mot de passe incorect, compte inactif ou ne correspond pas!!!  "));

    }
  }else{
    return redirect()->route('livreur.login')->with(session()->flash('alert-danger', "Email incorrect.!!!  "));
  }
    }

    public function store(Request $request)
    {
        
        $livreur = new User();
        $livreur->name = $request->name;
        $livreur->email = $request->email;
        $livreur->role = 'livreur';
        $livreur->is_admin = 0;
        $livreur->password = Hash::make($request->password);
        $livreur->is_actived = 0;
        $livreur->save();

         ProfileLivreur::create([
            'user_id' => $livreur->id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

         Mail::to($request->email)->send(new EMail($livreur));
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
   

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
