<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsAdmins extends Model
{
    use HasFactory;
    protected $fillable =[
        'name', 'email', 'role','is_admin', 'password',
    ];
}
