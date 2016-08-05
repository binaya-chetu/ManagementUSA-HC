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
    public function addItem(Request $request) {
        $categoryId = $request->category_id;
        $categoryType = $request->category_type;
        $patientId = $request->patient_id;

        if (!isset($patientId) || empty($patientId)) {
            return json_encode(['response' => false, 'msg' => 'Please select patient from Select Patient dropdown']);
        }

        $category = DB::table('categories')->where('id', $categoryId)->get();

        if (empty($category)) {
            if (isset($request->request_type) && $request->request_type == 'json') {
                return json_encode(['response' => false, 'msg' => 'Category not found']);
            } else {
                \App::abort(404, 'Selected category not found.');
            }
        }

        $where = ['category_id' => $categoryId, 'category_type_id' => $categoryType, 'patient_id' => $patientId];
        $cart = Cart::where($where)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->category_id = $categoryId;
            $cart->category_type_id = $categoryType;
            $cart->patient_id = $patientId;
            $cart->save();
            if (isset($request->request_type) && $request->request_type == 'json') {
                $totalItems = Cart::where('patient_id', $patientId)->get()->count();
                return json_encode(['response' => true, 'msg' => 'Package added to cart successfully.', 'totalItem' => $totalItems]);
            } else {
                return redirect('/cart/cart');
            }
        } else {
            $patient_id = base64_encode($patientId);
            if (isset($request->request_type) && $request->request_type == 'json') {
                return json_encode(['response' => false, 'msg' => 'This package is already added to your cart. <a href="/cart/cart/'.$patient_id.'">Click</a> here to access your cart']);
            } else {
                \Session::flash('flash_message', 'This package is already added to your cart. <a href="/cart/cart/'.$patient_id.'">Click</a> here to access your cart');
                return Redirect::back();
            }
        }
    }

    /**
     * Show the items in cart.
     *
     * @return \resource\view\cart\cart
     */
    public function showCart() {

        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $category_id = $cart['category_id'];
        $category_type_id = $cart['category_type_id'];
        $category = DB::table('categories')->find($category_id);
        $category_type = DB::table('category_types')->find($category_type_id);

        $category_details = DB::table('packages')
                ->leftJoin('products', 'packages.product_id', '=', 'products.id')
                ->select('packages.product_count as p_count', 'packages.product_price as spl_price', 'products.*')
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
        return view('cart.cart', ['category' => $category, 'category_type' => $category_type, 'cart_items' => $category_details, 'category_sum' => $category_sum, 'cart' => $cart]);
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
 
    /**
     * Count the total cart item for the patient
     *
     * @return ajax response
     */
    public function countCartItem(Request $request){
        $cart = Cart::where('patient_id', $request->id)->get()->count();
        print_r($cart);die;
    }
}