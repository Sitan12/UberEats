<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'adresse', 'numero', 'photo', 'user_id','longitude','latitude'
    ];

    public function user()
    {
       return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getImage()
    {
            $photoPath = $this->photo ?? 'photoProfile/default.png';
            return "/storage/" .$photoPath;
    }
}
