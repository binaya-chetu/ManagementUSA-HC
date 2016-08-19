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
            'patientCart' => $patientCart, 'states' => $states, 'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'], 'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'], 'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price']
        ]);
    }
    /**
     * Make the Confirmation Page functionality
     *
     * @return \resource\view\sale\confirmation.blade.php
     *  */
    public function confirmation($id) {        
        $patientId = base64_decode($id);
        $cart = Cart::getCartDetails($patientId);
        $patientCart = Cart::with('patient', 'patient.patientDetail', 'patient.patientDetail.patientStateName', 'user', 'user.userDetail')->where('patient_id', $patientId)->get()->first();
        //echo '<pre>';print_r($cart);die;
        return view('sale.confirmation', [
            'patientCart' => $patientCart, 'category_list' => $cart['category_list'], 'category_detail_list' => $cart['category_detail_list'], 'original_package_price' => $cart['original_package_price'], 'discouonted_package_price' => $cart['discouonted_package_price'], 'package_discount' => $cart['package_discount'], 'total_cart_price' => $cart['total_cart_price']
        ]);
    }
}
