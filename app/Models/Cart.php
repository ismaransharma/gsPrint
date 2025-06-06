<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'cart_code',
        'quantity',
        'price',
        'total_price',
        'upload_design',
    ];

    
    public function getProductFromCart()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}