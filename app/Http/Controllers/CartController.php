<?php
 
namespace App\Http\Controllers;
use App\Cart;
use App\CartItem;
use Illuminate\Support\Facades\Auth;
 
use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
 
class CartController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function addItem ($categoryId){
        
        $categoryId = base64_decode($categoryId);
        $category = \DB::table('categories')->where('id', $categoryId)->get();
        if(empty($category)){
            throw new Exception('Requested product category not found');
        }

        $category_details = \DB::table('packages')
            ->leftJoin('products', 'packages.product_id', '=', 'products.id')            
            ->leftJoin('category_types', 'packages.category_type', '=', 'category_types.id')
            ->select('packages.product_count as p_count', 'packages.product_price as spl_price',
                    'products.*',
                    'category_types.name as package_type'
            )
            ->where('packages.category_id', $categoryId)->orderBy('package_type', 'DESC')->get();

        $category_info = [];
        $pck_type = '';
        $total_price = 0;
        foreach($category_details as $cat){
            if($pck_type != $cat->package_type){
                $pck_type = $cat->package_type;
                $category_info[$pck_type] = [];
                $category_info[$pck_type]['total_price'] = 0;
            }
            $category_info[$pck_type][] = $cat;
            $category_info[$pck_type]['total_price'] += $cat->spl_price;
        }
 
        $cart = Cart::where('user_id',Auth::user()->id)->first();
 
        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }
 
        $cartItem  = new Cartitem();
        $cartItem->product_id = $categoryId;
        $cartItem->cart_id = $cart->id;
        $cartItem->save();
 
        return redirect('/cart');
 
    }
 
    public function showCart(){
        $cart = Cart::where('user_id',Auth::user()->id)->first();
 
        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
 
        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }
 
        return view('cart.view',['items'=>$items,'total'=>$total]);
    }
 
    public function removeItem($id){
 
        CartItem::destroy($id);
        return redirect('/cart');
    }
 
}