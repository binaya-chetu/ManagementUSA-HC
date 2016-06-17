<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
       protected $table = 'products'; 

    protected $fillable =
    [
        'name',
        'unit_of_measurement',
        'price',
		'sku'
    ];       
//        public function productCategories() { 
//        return $this->belongsTo('App\ProductCategories', 'product_id');
//    }
}
