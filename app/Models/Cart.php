<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone', 'address', 'title', 'quantity', 'price'];


    public function book(){
        return $this->belongsTo(Books::class, 'title', 'title');
    }
}
