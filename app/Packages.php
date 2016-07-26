<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{
	use SoftDeletes;
	
    protected $fillable = [

		'product_id',
		'category_id',
		'product_count',
		'product_price',
		'category_type'

    ];
}
