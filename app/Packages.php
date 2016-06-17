<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $fillable = [
        'product_id',
        'category_id',
        'product_count',
        'product_price',
        'category_type'
    ];
}
