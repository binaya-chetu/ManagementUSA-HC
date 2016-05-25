<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryAddOns extends Model
{
       protected $table = 'category_add_ons'; 
       
        public function category() {  
        return $this->belongsToMany('App\CategoryAddOns', 'category_id');
         
    }
}
