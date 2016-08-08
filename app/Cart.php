<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;
	
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function cartItems()
    {
        return $this->hasMany('App\CartItem', 'cart_id');
    }
    
    public function categories()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }
	
    public function categoryTypes()
    {
        return $this->belongsTo('App\CategoryTypes', 'category_type_id');
    }

}