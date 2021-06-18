<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileRestaurant extends Model
{
    use HasFactory;
    protected $fillable =[
        'adresse', 'telephone', 'categorie', 'reseausocial','description', 'user_id', 'photo','latitude','longitude'
    ];

    public function user()
    {
       return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getImage()
    {
            $photoPath = $this->photo ?? 'photoProfile/default.jpg';
            return "/storage/" .$photoPath;
    }

}
