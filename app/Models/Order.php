<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillabel = [
        'cart_code',
        'price',
        'product_name',
        'quantity',
        'price',
        'price2',
        'name',
        'mobile_number',
        'email',
        'address',
        'additional_information',
        'payment_method',
        'payment_status',
        'payment_amount',
        'order_status',
        'created_at'

    ];


    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}