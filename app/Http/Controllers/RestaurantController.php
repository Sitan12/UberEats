<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use App\Models\Plat;
use App\Models\User;
use App\Models\Livreur;
use App\Models\Commande;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\ProfileRestaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    
    public function index()
    {
        $plats = Plat::all();
        $commandes = Commande::has('user')->get();
        $livreurs = User::all();
        return view('restos.index',compact('plats','commandes','livreurs'));
    }
   
    public function affichPlats($user){

        $restaurants = ProfileRestaurant::has('user')->get();
        //dd($restaurants);
        $plats = Plat::where('user_id',$user)->get();
        $commande = Commande::all();
        return view('plats.plat',compact('plats'));

    }
    public function create()
    {
        return view('restos.test');
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
        return view('restos.login');
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
    
    if(auth()->attempt(array('is_actived' => 1,'role' => "restaurant", 'email' => $input['email'], 'password' => $input['password'])))
    {
      // if (auth()->user()->is_admin == 1)
      // {
      //   return view('isadmins.index');
      // } 
           return redirect('/');
    
    } 
    else{
      return redirect()->route('restos.login')->with(session()->flash('alert-danger', "Mot de passe incorect, compte inactif ou ne correspond pas!!!  "));

    }
  }else{
    return redirect()->route('restos.login')->with(session()->flash('alert-danger', "Email incorrect.!!!  "));
  }
    }

    public function store(Request $request)
    {
        $restaurant = new User();
        $restaurant->name = $request->name;
        $restaurant->email = $request->email;
        $restaurant->role = 'restaurant';
        $restaurant->is_admin = 0;
        $restaurant->password = Hash::make($request->password);
        $restaurant->is_actived = 0;
        $restaurant->save();

         ProfileRestaurant::create([
            'user_id' => $restaurant->id,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        Mail::to($request->email)->send(new EMail($restaurant));
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
   
    
    public function AjoutPlat(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg,jfif',
            'prix' => 'required',
        ]);    

        $plats = new Plat();
        $plats->user_id = Auth::user()->id;
        $plats->title = $request->title;
        $plats->description = $request->description;
        $imageName = null;

        if(request()->hasFile('image')){
            $uploadedImage = $request->file('image');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $destinationPath = public_path('/photoPlat/');
            $uploadedImage->move($destinationPath, $imageName);
            $uploadedImage->imagePath = $destinationPath . $imageName;
        }

        $plats->image = $imageName;
        $plats->prix = $request->prix;
        $plats->save();

        notify()->success("Plat Ajouté avec succès");

        return $this->index();
    }

   


}
