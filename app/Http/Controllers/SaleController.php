<?php

namespace App\Http\Controllers;
use App\Http\Traits\CommonTrait;
use App\Http\Controllers\PaymentController;

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
USE Exception;
use App\PdfForm;

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
        /* START: Show history of all the uncompleted payment */
        $paymentUncompleted = Payment::getUncompletedPayment($patientId);  
        /* END: Show history of all the uncompleted payment */
        
        return view('sale.checkout', [
            'patientCart' => $patientCart, 'states' => $states, 
            'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'],
            'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'],
            'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price'], 'uncompletedPayment' => $paymentUncompleted
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
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')
                            ->where('patient_id', $patientId)->get()->first();             
        $payment = $request->all();
        $paymentUncompleted = Payment::getUncompletedPayment($patientId);  
        $payment['total_uncompleted'] = $paymentUncompleted['total'];
        Session::set('checkout_payment', $payment);		    
        return view('sale.confirmation', [
            'patientCart' => $patientCart, 'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'], 
            'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'], 
            'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price'], 'payment' => $payment, 'uncompletedPayment' => $paymentUncompleted
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
        if($formData['payment_type'] == 1){
            $controller = new PaymentController();
            $paypalResponse = $controller->payment($payment);           
            if ($paypalResponse['result'] == false) {                              
                \Session::flash('error_message', $paypalResponse['error_data']);
                $url = 'sale/checkout/' . base64_encode($formData['patient_id']);
                return redirect()->to($url);
            }          
        }
        
        if (($payment['paid_amount'] < $payment['total_amount']) && !isset($formData['emiType']) && isset($payment['selectemi'])) {
            \Session::flash('error_message', 'Please select prefered EMI option or make complete payment again.');
            $url = 'sale/checkout/' . base64_encode($formData['patient_id']);
            return redirect()->to($url);
        }

        if (empty($payment) || empty($payment['paid_amount']) || empty($payment['total_amount'])) {
            \Session::flash('error_message', 'Your session expired. Please try again');
            $url = 'sale/checkout/' . base64_encode($formData['patient_id']);
            return redirect()->to($url);
        }
        $payments = new Payment;
        $payments->patient_id = $formData['patient_id'];
        $payments->agent_id = $formData['agent_id'];
        $payments->payment_type = $formData['payment_type'];
        $payments->total_amount = $payment['total_amount'];
        $payments->paid_amount = $payment['paid_amount'];
     
        $total_uncompleted = Payment::totalUncompletedAmount($formData['patient_id']);
        $total_pay =0;
        $total_pay = $payment['paid_amount'] + $total_uncompleted;
        if (($total_pay == $payment['total_amount']) || isset($formData['emiType'])) {
            $payments->payment_status = 1;
            $order_unique_id = uniqid();
            $payments->order_unique_id = $order_unique_id;
            // Make the function for the updating status for all uncompleted payments
            Payment::changePaymentStatus($formData['patient_id'], $order_unique_id);
        }
        
        $payments->save();
        $payment_id = $payments->id;
        
        if ($total_pay < $payment['total_amount'] && isset($formData['emiType'])) {
            // save emi data
            $formData['emiDate'] = explode(',', $formData['emiDate']);
            $emiStartDate = $formData['emiDate'][0];
            $emiStartDate = DateTime::createFromFormat('m/d/Y', $emiStartDate);
            $today = new DateTime();

            if ($emiStartDate < $today || $emiStartDate > $today->modify('next month')) {
                \Session::flash('error_message', 'Selected due date out of limit.');
                $url = 'sale/checkout/' . base64_encode($formData['patient_id']);
                return redirect()->to($url);
            }
            $amount_left = $payment['total_amount'] - $payment['paid_amount'];
            $emiType = $formData['emiType'];
            $emi_amount = $amount_left / $emiType;
            for ($i = 0; $i < $emiType; $i++) {          
                $emi = new Emi;
                $emi->type = $formData['emiType'];
                $emi->emi_amount = $emi_amount; // per installment amount
                $emi->patient_id = $formData['patient_id'];
                $emi->agent_id = $formData['agent_id'];
                $emi->payment_id = $payment_id;
                $emi->order_unique_id = $order_unique_id;
                $emi->due_date = $emiStartDate;
                $emi->save();
                $emiStartDate->modify('next month');
            }
        }
        /* -------- START::Call the function saveOrder to save the order data ------- */
        if (($total_pay == $payment['total_amount']) || isset($formData['emiType'])) {
            $cart = Cart::getCartDetails($formData['patient_id']);
            $this->saveOrder($cart, $payments->id, $order_unique_id);
         
            if (Cart::where('patient_id', $formData['patient_id'])->delete()) {
                //Session::set('checkout_payment', '');
                \Session::flash('flash_message', 'Your order placed successfully, Please print the listed forms.');
                $url = 'sale/generateInvoice/' . base64_encode($order_unique_id);
                return redirect()->to($url);
            }
          
         }else{
             \Session::flash('flash_message', 'Your payment received successfully, Please do the complete payment for this order.');
              $url = 'sale/checkout/' . base64_encode($formData['patient_id']);
              return redirect()->to($url);
         }
        /* -------------------------- END -------------------------------------------- */

        
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
    
    /**
    * Function: Show the PDF documents after payment made successful
    * returns payment Documents page view
    */
    public function paymentDocuments($orderid){
        $orderId = base64_decode($orderid);
        return view('sale.payment_documents', ['order_id' => $orderId]);
    }
    
    /**
    * Function: Show the invoice after payment made successful
    * returns payment details page view
    */
    public function generateInvoice($id){
        $orderId = base64_decode($id);
        $loginUser = User::with('userDetail', 'userDetail.userStateName')->find(Auth::user()->id);

        $allOrders = [];
        if(isset($orderId)){
            $allOrders = Order::getAllOrders($orderId);
            if(empty($allOrders['orderHistory'])){
                \Session::flash('flash_message', "Your orders didn't find in the application .");
                $url = 'sale/paymentDocuments/' . $id;
                return redirect()->to($url);
            }
            //echo "<pre>";print_r($allOrders);die;
        }
        //echo '<pre>';print_r($allOrders);die;
         return view('sale.generate_invoice', ['orders' => $allOrders, 'order_id' => $orderId, 'loginUser' => $loginUser]);
    }
    
    /**
    * Function: Email the invoice after checkout
    * returns generate invoice page
    */
    public function emailInvoice($id){
        if(isset($id)){
            $user = Payment::with('user')->where(['order_unique_id' => $id])->get()->first();
            $this->user = $user->user;
            $url = 'sale/sendInvoice/' . base64_encode($id);
            $url = App::make('url')->to($url);
            \Mail::send('emails.patientInvoice', ['url' => $url, 'patient' => $this->user->first_name], function($message) {
                $message->to($this->user->email, 'Azmens Clinic')->subject('Welcome!');
            });
            echo $this->success; die;
        }  else{
            echo $this->error; die;
        }      
    }
    
    /**
    * Function: Email the invoice after checkout
    * returns generate invoice page
    */
    public function sendInvoice($id){
        if(isset($id)){
            $loginUser = User::with('userDetail', 'userDetail.userStateName')->find(Auth::user()->id);
            $orderId = base64_decode($id);
            $allOrders = [];
            if(isset($orderId)){
                $allOrders = Order::getAllOrders($orderId);
                if(empty($allOrders['orderHistory'])){
                    App::abort(404, 'The url seeme to be expired or invalid.');
                }
            }
             return view('sale.generate_invoice', ['orders' => $allOrders, 'order_id' => $orderId, 'loginUser' => $loginUser]);
        }else{
            App::abort(404, 'The url seeme to be expired or invalid.');
        }        
    }
    
    /**
    * Function: to view or print the document in pdf format. 
    * returns 
    */
    public function printForm($patient_id, $category_id){
        $patient_id = base64_decode($patient_id);
        $category_id = base64_decode($category_id);
        if(isset($patient_id)){
            $patient = User::select('first_name', 'last_name')->where('id', $patient_id)->first();
            $template = PdfForm::where('id', 1)->first();
            //echo "<pre>";print_r($patient);die;
        }
         return view('sale.generate_pdf_form', [
             'template' => $template,
             'petient'  => $patient
         ]);
    }
}
