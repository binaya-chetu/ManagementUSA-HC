<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\AppointmentRequest;
use App\Doctor;
use App\User;
use App\State;
use App\Categories;
use App\Cart;
use App\Payment;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Config\Repository;
use Session;
use App;
use Auth;

class SaleController extends Controller
{
    protected $patient_role = 6;
    public $success = true;
    public $error = false;
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Make the front Office Sale
     *
     * @return \resource\view\sale\index.blade.php
     *  */
    public function index() {
        $patients = User::where('role', $this->patient_role)
                        ->join('patient_details', function ($join) {
                                $join->on('users.id', '=', 'patient_details.user_id')
                                     ->where('patient_details.never_treat_status', '=', 0);
                            })->get(['users.id', 'first_name', 'last_name']);
        $categories = Categories::select('cat_name', 'id')->get()->toArray();
		$lCategories = array_slice($categories, 0, sizeof($categories)/2);
		$rCategories = array_slice($categories, sizeof($categories)/2);
    
        return view('sale.index', [
            'patients' => $patients, 'categories' =>$categories, 'lCat' =>$lCategories, 'rCat' =>$rCategories
        ]);
    }
    
    /**
     * Make the Checkout Page functionality
     *
     * @return \resource\view\sale\checkout.blade.php
     *  */
    public function checkout($id) {        
        $patientId = base64_decode($id);
        $states = State::lists('name', 'id')->toArray();
        $cart = Cart::getCartDetails($patientId);
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')->where('patient_id', $patientId)->get()->first();
        //echo '<pre>';print_r($cart);die;
        return view('sale.checkout', [
            'patientCart' => $patientCart, 'states' => $states, 
            'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'],
            'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'],
            'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price']
        ]);
    }
    /**
     * Make the Confirmation Page functionality
     *
     * @return \resource\view\sale\confirmation.blade.php
     *  */
    public function confirmation($id, Request $request) {
        //echo '<pre>'; print_r($request->all());die;
        $patientId = base64_decode($id);
        $cart = Cart::getCartDetails($patientId);
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')->where('patient_id', $patientId)->get()->first();
        //echo '<pre>';print_r($patientCart->toArray());die;
               
        $payment['payment_type'] = $request['payment_type'];
        $payment['paid_amount'] = $request['paid_amount'];
        return view('sale.confirmation', [
            'patientCart' => $patientCart, 'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'], 
            'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'], 
            'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price'], 'payment' => $payment
        ]);
    }
    /**
     * Make the payment after the confirmation
     *
     * @return \resource\view\sale\index.blade.php
     *  */
    public function makePayment(Request $request) {    
        
        $formData = $request->all();
        $payments = new Payment;
        
        $payments->patient_id = $formData['patient_id'];
        $payments->agent_id = $formData['agent_id'];
        $payments->payment_type = $formData['payment_type'];
        $payments->total_amount = $formData['total_amount'];
        $payments->paid_amount = $formData['paid_amount'];
        $payments->save();
        
        /* -------- START::Call the function saveOrder to save the order data ------- */
        $cart = Cart::getCartDetails($formData['patient_id']);
        $this->saveOrder($cart, $payments->id);
        /* -------------------------- END -------------------------------------------- */
        
        if (Cart::where('patient_id', $formData['patient_id'])->delete()) {
            \Session::flash('flash_message', 'Your order placed successfully.');
            return Redirect::action('SaleController@index');
        }
        
    }
    /**
     * Save the order from the makePayment function
     *
     *  */
    public function saveOrder($cart, $payment_id) {   
        
        foreach($cart['category_list'] as $key => $category){
            $order = new Order;
            $order->payment_id = $payment_id;
            $order->category = $category['category'];
            $order->package_type = $category['category_type'];
            $order->price = $cart['original_package_price'][$key];
            $order->discount_price = $cart['package_discount'][$key];
            $order->save();
            /* ---------------START Save the data into the orderdetail table regarding the package order ------- */
            foreach($cart['category_detail_list'][$key] as $product){
                $orderDetail = new OrderDetail;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_sku = $product['sku'];
                $orderDetail->product = $product['product'];
                $orderDetail->quantity = $product['count'];
                $orderDetail->unit_price = $product['original_price'];
                $orderDetail->discount_price = $product['discount_price'];
                $orderDetail->save();   
                unset($orderDetail);
            }
            unset($order);
            /* -------------- END ------------- */
        }
        
    }
	
	/**
	* paymentDetails: returns payment details of the patient with given id
	* returns payment details page view
	*/
	
	public function paymentDetails($id){
		$patientId = base64_decode($id);
		$paymentDetails = Payment::getPaymentHistory($patientId);

		return view('sale.paymentDetails',['payment' => $paymentDetails['payment'], 'orders' => $paymentDetails['orders'], 'order_detail' => $paymentDetails['order_detail']]);	
	}
    
}
