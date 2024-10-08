<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'country',
        'street_address',
        'landmark',
        'city',
        'constituency',
        'phone',
        'email',
        'order_notes',
        'total',
        'shipping_method',
        'payment_status',
        'payment_id',
    ];
}
