<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_token extends Model
{
    use HasFactory;
    public $table = "password_token";
}
