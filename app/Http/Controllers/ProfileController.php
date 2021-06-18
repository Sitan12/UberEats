<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Handler\Proxy;

class ProfileController extends Controller

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
        $profile = Profile::where('user_id' === $user_id );
        return view('profiles.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
       $data = request()->validate([
            'numero' => 'required',
            'adresse' => 'required',
            'photo' => 'mimes:png,jpg,jpeg,jfif',
            'longitude' =>  'required',
            'latitude' =>  'required',
        ]);    

        if ($request->hasFile('photo')){
            $image_path = public_path("/photoProfile/".$user->profile->photo);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $bannerImage = $request->file('photo');
            $imgName = $bannerImage->getClientOriginalName();
            $destinationPath = public_path('/photoProfile/');
            $bannerImage->move($destinationPath, $imgName);
          } else {
            $imgName = $user->profile->photo;
          }
          $user->profile->photo= $imgName;
        Auth()->user()->profile->update(array_merge($data, ['photo' => $imgName]));
        
      

        
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $user->update($data);
        
        return redirect()->route('profiles.show', $user);
       

    }

}
