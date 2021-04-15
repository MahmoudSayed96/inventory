<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'salary',
        'joining_date',
        'nid',
        'photo',
        'email'
    ];
}
