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
    /**
     * Constructor function to check the auth permission
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Add the item in cart
     *
     * @return \resource\view\cart\cart
     */
    public function addItem (Request $request){
        
        $categoryId = $request->category_id;
        $categoryType = $request->category_type;
        
        $category = DB::table('categories')->where('id', $categoryId)->get();
        if(empty($category)){
            throw new Exception('Requested product category not found');
        }

        $category_details = DB::table('packages')
            ->leftJoin('products', 'packages.product_id', '=', 'products.id') 
            ->select('packages.product_count as p_count', 'packages.product_price as spl_price',
                    'products.*'
            )
            ->where('packages.category_id', $categoryId)
                ->where('packages.category_type', $categoryType)
                ->get();
        //echo "<pre>"; print_r($category_details);die;
        
        $total_amount = 0;
        
        $totalUnitPrice = 0;
        foreach($category_details as $cat){
            $total_amount += $cat->spl_price;
            $totalUnitPrice += $cat->price * $cat->p_count;
        }
        $package_discount = $total_amount - $totalUnitPrice;
        $cart = Cart::where('user_id',Auth::user()->id)->first();
 
        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->category_id = $categoryId;
            $cart->package_price = $total_amount;
            $cart->discount_price = $package_discount;
            $cart->total_amount = $total_amount;
            $cart->save();
            
            foreach($category_details as $category_detail)
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
            }
            return redirect('/cart/cart');
        }
        else
        {
            \Session::flash('flash_message', 'A Package already exists in your cart.');
            return Redirect::back();
        }
 
        
 
    }
    
    /**
     * Show the items in cart.
     *
     * @return \resource\view\cart\cart
     */
    public function showCart(){
        $cart = Cart::with('cartItems', 'category', 'cartItems.product')->where('user_id',Auth::user()->id)->first();
        //echo "<pre>";print_r($cart);die;
        $cart_items = [];
        if(!empty($cart))
        {
            $cart_items = $cart->cartItems;
        }
        return view('cart.cart',['items'=>$cart, 'cart_items' => $cart_items, ]);
    }
 
    /**
     * Remove an item from cart
     *
     * @return \resource\view\cart\cart
     */
    public function removeItem($id){
 
        Cart::destroy($id);
        DB::table('cart_items')->where('cart_id', '=', $id)->delete();
        return redirect('/cart/cart');
    }
 
}