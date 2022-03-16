<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id',
        'address',
        'phone',
        'email',
        'type',
        'note',
    ];
}
