<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
	use SoftDeletes;
	
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }
 
    public function product()
    {
        return $this->belongsTo('App\Products', 'product_id');
    }
}
 