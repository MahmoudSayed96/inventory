<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
        'subtotal',
    ];
}
