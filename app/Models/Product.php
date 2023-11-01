<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_title',
        'category_id',
        'category_title',
        'slug',
        'product_image',
        'product_description',
        'status',
        'size',
        'sizeincnum1',
        'sizeincnum2',
        'sizeinc',
        'stock',
        'original_price',
        'discount_price',
        'colour',
        'weight',
        'deleted_at',
        'created_at',
        'updated_at',

    ];

}