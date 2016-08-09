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
	
    public function categories() {  
        return $this->belongsTo('App\Categories', 'category_id');
    }

	public function Product() {
        return $this->belongsTo('App\Product', 'product_id');
    }	
    
    public function order() {
        return $this->belongsTo('App\Order', 'package_id');
    }	
}
