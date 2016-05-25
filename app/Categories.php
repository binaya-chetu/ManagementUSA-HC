<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    
    protected $table = 'categories'; 
    /**
     * Get all categories for listing.
     * 
     * @return array
   */
     public function category() {
         
       // return $this->belongsToMany('App\CategoryAddOns', 'category_id');
          return $this->hasMany('App\CategoryAddOns', 'category_id'); 
    }
   public function productCategories() {
        
          return $this->hasMany('App\productCategories', 'category_id');
          
    }
  
    
    
}
