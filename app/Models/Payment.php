<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table= "payments";
    protected $fillable = [
        'name',
        'city',
        'phone',
        'due_payment',
        'date',
        'received_payment',
        'payed',
        'created_by',
        'updated_by',
    ];
}
