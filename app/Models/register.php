<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    use HasFactory;
    protected $table = 'register'; 
    protected $fillable = [
        'companyname',
        'name',
        'email',
        'phonenumber',
        'distric',
        'taluka',
        'city',
        'address',
        'password',
    ];
   
}
