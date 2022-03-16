<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_quantity',
    ];
}
