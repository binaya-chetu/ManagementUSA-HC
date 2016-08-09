<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
     //
    protected $fillable = [
        'name',
		'price',
		'sku',
		'count',
        'unit_of_measurement'
    ];
	
    public function packages() {  
        return $this->hasMany('App\Packages', 'product_id');
    }	
}
