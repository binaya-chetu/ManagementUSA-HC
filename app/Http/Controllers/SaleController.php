<?php

namespace App\Http\Controllers;
use App\Http\Traits\CommonTrait;

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
use App\Emi;
use App\Order;
use DateTime;
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
    use CommonTrait;
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
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')
                            ->where('patient_id', $patientId)->get()->first();
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
        $patientId = base64_decode($id);
        $cart = Cart::getCartDetails($patientId);
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')
                            ->where('patient_id', $patientId)->get()->first();             
        $payment['payment_type'] = $request['payment_type'];
        $payment['paid_amount'] = $request['paid_amount'];
        $payment['total_amount'] = $request['total_amount'];
		
		Session::set('checkout_payment', $payment);		    
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
		$payment = Session::get('checkout_payment');	
		if(($payment['paid_amount'] < $payment['total_amount']) && !isset($formData['emiType'])){
			\Session::flash('error_message', 'Please select prefered EMI option.');
			return redirect()->back();
		}  

 		if(empty($payment) || empty($payment['paid_amount']) || empty($payment['total_amount'])){
			\Session::flash('error_message', 'Your session expired. Please try again');
			$url = 'sale/checkout/'.base64_encode($formData['patient_id']);
			return redirect()->to($url);		
		} 

        $payments = new Payment;
        
        $payments->patient_id = $formData['patient_id'];
        $payments->agent_id = $formData['agent_id'];
        $payments->payment_type = $formData['payment_type'];
        $payments->total_amount = $payment['total_amount'];
        $payments->paid_amount = $payment['paid_amount'];	
        $payments->save();
        $payment_id = $payments->id;

		if($payment['paid_amount'] < $payment['total_amount'] && isset($formData['emiType'])){
			// save emi data
			$formData['emiDate'] = explode(',', $formData['emiDate']);
			$emiStartDate = $formData['emiDate'][0];
			$emiStartDate = DateTime::createFromFormat('m-d-Y', $emiStartDate);			
			$today = new DateTime();
			if($emiStartDate < $today || $emiStartDate > $today->modify('next month')){
				\Session::flash('error_message', 'Selected due date out of limit.');
				return redirect()->back();				
			}
			$amount_left = $payment['total_amount'] - $payment['paid_amount'];			
			$emiType = $formData['emiType'];
			$emi_amount = $amount_left/$emiType;
			for($i = 0; $i < $emiType; $i++){
				$emi = new Emi;
				$emi->type = $formData['emiType'];				
				$emi->emi_amount = $emi_amount; // per installment amount
				$emi->patient_id = $formData['patient_id'];
				$emi->agent_id = $formData['agent_id']; 
				$emi->payment_id = $payment_id;
				$emi->due_date = $emiStartDate; 
				$emi->save();
				$emiStartDate->modify('next month');
			}			
		}
		
        /* -------- START::Call the function saveOrder to save the order data ------- */
        $cart = Cart::getCartDetails($formData['patient_id']);
        $this->saveOrder($cart, $payments->id);
        /* -------------------------- END -------------------------------------------- */
        
        if (Cart::where('patient_id', $formData['patient_id'])->delete()) {
			//Session::set('checkout_payment', '');
            \Session::flash('flash_message', 'Your order placed successfully.');
            return Redirect::action('SaleController@index');
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
