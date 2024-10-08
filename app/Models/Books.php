<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author_name', 's_author_name','print_date', 'book_summary', 'book_price', 'stock_quantity', 'cover_pic', 'publisher', 'category', 'status', 'seo'];

    public function categories(){
        return $this->belongsTo(Categories::class, 'category', 'id');
    }
}
