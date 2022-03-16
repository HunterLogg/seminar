<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'qty',
        'user_id',
        'product_id',
        'name',
        'price',
        'image',
        'status',
    ];
}
