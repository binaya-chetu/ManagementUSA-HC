<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
	use SoftDeletes;
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
	
	public function cart() {
        return $this->hasMany('App\Cart', 'category_id');
    }
       
	public function packages() {
        return $this->hasMany('App\Packages', 'category_id');
    }
	
    public function CategoryAddOns() {  
        return $this->belongsTo('App\CategoryAddOns', 'category_id');
    }
    public function categoryDetails (){
         return $this->belongsTo('App\CategoryAddOns', 'category_id');
    }
   	    
}
