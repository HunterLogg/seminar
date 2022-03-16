<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'content',
        'active',
    ];
}
