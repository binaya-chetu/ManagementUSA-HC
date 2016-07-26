<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryAddOns extends Model
{
	use SoftDeletes;
	
       protected $table = 'category_add_ons'; 
       
      
         
    
}
