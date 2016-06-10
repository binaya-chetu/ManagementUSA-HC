<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository;
use Session;
use App;
use Auth;

class ProductsController extends Controller
{
	protected $success = false;
	
/*     public function saveProducts(Request $request){
		$data = Input::all();
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];

        $validator = Validator::make($data, [
			'productFile' =>'required|mimes:xls,xlsx'
		], $messages);

        if ($validator->fails()) {
            return Redirect::to('/products/addproducts')->withInput()->withErrors($validator->errors());
        }		

 		\Excel::load($data['productFile']->getPathname(), function($reader) {
			// Getting all results
			$productList = $reader->select(array('name', 'unit_of_measurement', 'price'))->get()->toArray();
			$list = [];
			foreach($productList as $i => $n){
 				if(!isset($n['name']) || !isset($n['price']) || !isset($n['unit_of_measurement']) || empty($n['name']) || empty($n['price'])){
					unset($n);
				} else{
					$list[$i] = $n; 
				} 				
			}
			if(empty($list)){
				Session::flash('error_message', 'Please enter a valid excel file.');
			} else{
				$this->success = Product::insert($productList);
			}
		});
		if($this->success){
			Session::flash('success_message', 'Products added successfully.');
		} else{
			Session::flash('error_message', 'Products not added successfully. Please try again.');
		}
		return redirect()->back();
	} */
	
	public function saveProducts(Request $request){
		$data = Input::all();
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];

        $validator = Validator::make($data, [
			'productFile' =>'required|mimes:xls,xlsx'
		], $messages);

        if ($validator->fails()) {
            return Redirect::to('/products/addproducts')->withInput()->withErrors($validator->errors());
        }		

 		\Excel::load($data['productFile']->getPathname(), function($reader) {
			// Getting all results
			$productList = $reader->select(array('name', 'unit_of_measurement', 'price'))->get()->toArray();
			$list = [];
			foreach($productList as $i => $n){
 				if(!isset($n['name']) || !isset($n['price']) || !isset($n['unit_of_measurement']) || empty($n['name']) || empty($n['price'])){
					unset($productList[$i]);
				}			
			}
		
			if(!empty($productList)){
				$this->success = Product::insert($productList);
			}
		});
		if($this->success){
			Session::flash('success_message', 'Products added successfully.');
		} else{
			Session::flash('error_message', 'Products not added successfully. Please try again.');
		}
		return redirect()->back();
	}
	
    public function addproducts(){

        return view('products.add_products');
	}
}
