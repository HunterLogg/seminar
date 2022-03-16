<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
    ];
}
