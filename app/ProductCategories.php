<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
     protected $table = 'product_categories'; 
     
      public function products() {
       // return $this->hasMany('App\products', 'product_id');
          return $this->belongsToMany('App\products', 'product_id');
    }
    public function categories() {
        //return $this->hasMany('App\categories', 'category_id');
        return $this->belongsToMany('App\categories', 'category_id');
    }
     public function categoryTypes() {
      //  return $this->hasMany('App\category_types', 'id');
          return $this->belongsToMany('App\category_types', 'id');
    }
}
