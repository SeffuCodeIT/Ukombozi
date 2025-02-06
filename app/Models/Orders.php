<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'country', 'county', 'constituency', 'street_address',
        'landmark', 'phone', 'email', 'total', 'product_id', 'product_qty',
        'shipping_method', 'payment_status', 'payment_id', 'confirmation_code',
        'account_no', 'failure_reason'
    ];
}
