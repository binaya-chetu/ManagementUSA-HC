<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTypes extends Model
{
	use SoftDeletes;
    //
	public function cart() {
        return $this->hasMany('App\Cart', 'category_type_id');
    }	
}
