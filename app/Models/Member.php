<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_name',
        'member_position_id',
        'member_position_title',
        'member_image',
        'member_number',
        'member_facebook',
        'member_email',
    ];  
}