<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany('App\CartItem', 'cart_id');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Categories', 'category_id');
    }

}