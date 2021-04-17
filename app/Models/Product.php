<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'buying_price',
        'selling_price',
        'category_id',
        'supplier_id',
        'buying_date',
        'image',
        'stock',
        'quantity',
    ];
}
