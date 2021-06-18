<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\ProfileLivreur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileLivreurController extends Controller
{
    public $users;

    public function __construct()
    {
        $this->users = User::getAllUsers();
        $this->middleware('auth');
    } 

    public function index(){
        $commandes = Commande::all();
        return view('livreurs.liste', compact('commandes'));
    }

  

    public function show(User $user)
    {

        $user_id = Auth::user()->id;
        $profiles = ProfileLivreur::has('user')->get();
        // $profiles = ProfileLivreur::where( 'user_id' === $user_id );
        return view('livreurs.profile', compact('user', 'profiles'));
    }

    public function edit(User $user)
    {
        $profiles = ProfileLivreur::has('user')->get();
        return view('livreurs.EditProfile', compact('user', 'profiles'));
    }

    public function update(User $user, Request $request)
    {

       $data = request()->validate([
            'nom' => '',
            'prenom' => '',
            'telephone' => '',
            'adresse' => '',
            'CNI' => '',
            'transport' => '',
            'photo' => '',
        ]);    
        if ($request->hasFile('photo')){
            $image_path = public_path("/photoProfile/".$user->profileLivreur->photo);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $bannerImage = $request->file('photo');
            $imgName = $bannerImage->getClientOriginalName();
            $destinationPath = public_path('/photoProfile/');
            $bannerImage->move($destinationPath, $imgName);
          } else {
            $imgName = $user->profileLivreur->photo;
          }
          $user->profileLivreur->photo= $imgName;
        Auth()->user()->profileLivreur->update(array_merge($data, ['photo' => $imgName]));
        //  Auth()->user()->profileLivreur->update($data);
        // update for user
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($data);

        return $this->show($user);
      
       

    }
}