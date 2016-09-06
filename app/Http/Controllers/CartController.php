<?php
 
namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
    public function showCart($id){
		$patientId = base64_decode($id);
		$cart = Cart::getCartDetails($patientId);

        return view('cart.cart',['category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'], 'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'], 'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price']]);
    }
	
    /**
     * Remove an item from cart
     *
     * @return \resource\view\cart\cart
    */
    public function removeItem($id){
		$id = base64_decode($id);
        Cart::destroy($id);
        DB::table('cart_items')->where('cart_id', '=', $id)->delete();
		\Session::flash('flash_message', 'Package deleted successfully');
        return redirect()->back();
    }
	
    /**
     * Empty entire cart for a patient
     *
     * @return \resource\view\cart\cart
     */
    public function emptyCart($id){
		$id = base64_decode($id);
        Cart::where('patient_id', $id)->delete($id);
		\Session::flash('flash_message', 'Package deleted successfully');
        return redirect()->back();
    }
 
    /**
     * Count the total cart item for the patient
     *
     * @return ajax response
     */
    
    public function countCartItem(Request $request){
        $cart = Cart::where('patient_id', $request->id)->get()->count();
        echo $cart;die;
    }
}