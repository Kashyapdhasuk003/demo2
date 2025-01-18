<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBill extends Model
{
    use HasFactory;
    protected $table ="client_bills";
    protected $fillable = [
        'user_name',
        'city',
        'mo_number',
        'product_type',
        'price',
        'date',
        'start_time',
        'end_time',
        'total_hours',
        'total_amount',
    ];
}
