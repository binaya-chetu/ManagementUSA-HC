<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
	use SoftDeletes;
	
     protected $table = 'product_categories'; 
     
      public function products() {
     
          return $this->belongsToMany('App\products', 'product_id');
    }
    public function categories() {
        
        return $this->belongsTo('App\categories', 'category_id');
    }
     public function categoryTypes() {
     
          return $this->belongsTo('App\category_types', 'id');
    }
}
