<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable =[
        'name', 'email', 'role', 'is_admin', 'password',
    ];

    public function plats()
    {
        return $this->hasMany('App\Models\Plat');
    }

    

}
