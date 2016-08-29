<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;

	public static function getCartDetails($patientId){
		$category_list = [];
		$category_detail_list = [];
		
		$original_package_price = [];
		$discouonted_package_price = [];
		$total_cart_price = 0;
		$package_discount = [];
		
		$cart = Cart::with('patient', 'user', 'categoryTypes', 'categories', 'categories.packages', 'categories.packages.Product')->where('patient_id', $patientId)->get();	

		foreach($cart as $i => $v){
			$original_package_price[$v->id] = 0;
			$discouonted_package_price[$v->id] = 0;
			
			$category_list[$v->id] = [
								'category_id' => $v->category_id, 
								'category' => $v->categories->cat_name, 
								'duration' => $v->categories->duration_months, 
								'user_id' => $v->user_id, 
								'user' => $v->user->first_name.' '.$v->user->last_name, 
								'patient_id' => $v->patient_id, 
								'patient' => $v->patient->first_name.' '.$v->patient->last_name,
								'category_type_id' => $v->category_type_id,
								'category_type' => $v->categoryTypes->name
							]; 

			$category_detail_list[$v->id] = [];
			foreach($v->categories->packages as $ind => $val){
				$category_detail_list[$v->id][$ind]['product_id'] = $val->product_id;
				$category_detail_list[$v->id][$ind]['sku'] = $val->product->sku;
				$category_detail_list[$v->id][$ind]['product'] = $val->product->name;
				$category_detail_list[$v->id][$ind]['count'] = $val->product_count;
				$category_detail_list[$v->id][$ind]['discount_price'] = $val->product_price;
				$category_detail_list[$v->id][$ind]['original_price'] = $val->product->price;
				$category_detail_list[$v->id][$ind]['unit_of_measurement'] = $val->product->unit_of_measurement;
				
				$original_package_price[$v->id] +=  $val->product_count * $val->product->price;
				$discouonted_package_price[$v->id] +=  $val->product_price;
				$total_cart_price +=  $val->product_price;
			}
			$package_discount[$v->id] =  $original_package_price[$v->id] - $discouonted_package_price[$v->id];
		}			
		
		return ['category_list' => $category_list, 'category_detail_list' => $category_detail_list, 'original_package_price' => $original_package_price, 'discouonted_package_price' => $discouonted_package_price,	'package_discount' => $package_discount, 'total_cart_price' => $total_cart_price];
	}
	
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