<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class reguser extends Model 
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'username',
        'birthdate',
        'phone',
        'address',
        'email',
        'password',
        'image',
    ];
}
