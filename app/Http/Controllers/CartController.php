<?php
 
namespace App\Http\Controllers;
use App\Cart;
use App\CartItem;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
 
class CartController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function addItem (Request $request){
        
        $categoryId = $request->category_id;
        $categoryType = $request->category_type;
		
        $category = DB::table('categories')->where('id', $categoryId)->get();
        if(empty($category)){
            App::abort(404, 'Selected category not found.');
        }
		
		$cart = Cart::where('user_id',Auth::user()->id)->first();
        if(!$cart){		
/*   			$category_details = DB::table('packages')
				->leftJoin('products', 'packages.product_id', '=', 'products.id') 
				->select('packages.product_count as p_count', 'packages.product_price as spl_price','products.*')
				->where('packages.category_id', $categoryId)
				->where('packages.category_type', $categoryType)
				->get(); */
			
/*   			$category_sum = DB::table('packages')
				->leftJoin('products', 'packages.product_id', '=', 'products.id') 
				->selectRaw('SUM(packages.product_price) AS total_amount, SUM(packages.product_count * products.price) AS totalUnitPrice')
				->where('packages.category_id', $categoryId)
				->where('packages.category_type', $categoryType)
				->first(); */ 
				
	/* 		$total_amount = $category_sum->total_amount;
			$totalUnitPrice = $category_sum->totalUnitPrice;
			$package_discount = $total_amount - $totalUnitPrice; */

            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->category_id = $categoryId;
            $cart->category_type_id = $categoryType;
            //$cart->package_price = $total_amount;
           // $cart->discount_price = $package_discount;
           // $cart->total_amount = $total_amount;
            $cart->save();			

/* 			foreach($category_details as $category_detail)
            {
                $cartItem  = new Cartitem();
                $cartItem->cart_id = $cart->id;
                $cartItem->product_id = $category_detail->id;
                $cartItem->product_sku = $category_detail->sku;
                $cartItem->product_price = $category_detail->spl_price;
                $cartItem->quantity = $category_detail->p_count;
                $unitPrice = $category_detail->price * $category_detail->p_count;
                $unitDiscount = $category_detail->spl_price - $unitPrice;
                $cartItem->discount_price = $unitDiscount;
                $cartItem->total_price = $category_detail->spl_price;
                $cartItem->save();
            } */
            return redirect('/cart');
  		} 
		else			
        {
            \Session::flash('flash_message', 'There is already one package in your cart with name. <a href="/cart">Click</a> here to access your cart');
            return Redirect::back();
        }
    }
 
    public function showCart(){
		$cart = Cart::where('user_id', Auth::user()->id)->first();
		$category_id = $cart['category_id'];
		$category_type_id = $cart['category_type_id'];
		
		$category = DB::table('categories')->find($category_id);
		$category_type = DB::table('category_types')->find($category_type_id);
		
		$category_details = DB::table('packages')
			->leftJoin('products', 'packages.product_id', '=', 'products.id') 
			->select('packages.product_count as p_count', 'packages.product_price as spl_price','products.*')
			->where('packages.category_id', $category_id)
			->where('packages.category_type', $category_type_id)
			->get();
		
		$category_sum = DB::table('packages')
			->leftJoin('products', 'packages.product_id', '=', 'products.id') 
			->selectRaw('SUM(packages.product_price) AS total_amount, SUM(packages.product_count * products.price) AS totalUnitPrice')
			->where('packages.category_id', $category_id)
			->where('packages.category_type', $category_type_id)
			->first();
				
	 		$total_amount = $category_sum->total_amount;
			$totalUnitPrice = $category_sum->totalUnitPrice;
			$package_discount = $total_amount - $totalUnitPrice; 
			
/*  echo '<pre>'; echo 'cart<br>';
print_r($cart['id']); echo '<br><br><hr>';
print_r('category_type'); echo '<br>';
print_r($category_type); echo '<br><br><hr>';
print_r('cart_items'); echo '<br>';
print_r($category_details); echo '<br><br><hr>';
print_r('category_sum'); echo '<br>';
print_r($category_sum); echo '<br><br><hr>'; 
die;   */
		
        return view('cart.cart',['category' => $category, 'category_type' => $category_type, 'cart_items' => $category_details, 'category_sum' => $category_sum, 'cart' => $cart]);
    }
 
    public function removeItem($id){
 
        Cart::destroy($id);
        DB::table('cart_items')->where('cart_id', '=', $id)->delete();
        return redirect('/cart');
    }
 
}