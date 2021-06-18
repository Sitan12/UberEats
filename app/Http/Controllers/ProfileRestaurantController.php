<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProfileRestaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileRestaurantController extends Controller
{
    public $users;

    public function __construct()
    {
        $this->users = User::getAllUsers();
        $this->middleware('auth');
    } 

    public function show(User $user)
    {
        $user_id = Auth::user()->id;
        $profiles = ProfileRestaurant::has('user')->get();
        // $profiler = ProfileRestaurant::where('user_id' === $user_id );
        return view('restos.profile', compact('user', 'profiles'));
    }

    public function edit(User $user)
    {
        $profiles = ProfileRestaurant::has('user')->get();
        return view('restos.EditProfile', compact('user', 'profiles'));
    }

    public function update(User $user, Request $request)
    {
        
       $data = request()->validate([
            'adresse' => '',
            'telephone' => '',
            'socialnetwork' => '',
            'categorie' => '',
            'description' => '',
        ]);  

        if ($request->hasFile('photo')){
            $image_path = public_path("/photoProfile/".$user->profileRestaurant->photo);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $bannerImage = $request->file('photo');
            $imgName = $bannerImage->getClientOriginalName();
            $destinationPath = public_path('/photoProfile/');
            $bannerImage->move($destinationPath, $imgName);
          } else {
            $imgName = $user->profileRestaurant->photo;
          }
          $user->profileRestaurant->photo= $imgName;
        Auth()->user()->profileRestaurant->update(array_merge($data, ['photo' => $imgName]));
      
        // update for user
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($data);

        return $this->show($user);

    }
}
