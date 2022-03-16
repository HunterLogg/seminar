<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'brand_id',
        'quantity',
        'image',
        'active',
    ];
}
