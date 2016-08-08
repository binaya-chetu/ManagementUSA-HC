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
        'unit_of_measurement',
        'price',
    ];
	
    public function packages() {  
        return $this->hasMany('App\Packages', 'product_id');
    }	
}
