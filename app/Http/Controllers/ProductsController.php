<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function saveProducts(){
		$data = Input::all();
		$d = Input::file('productFile');
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];
//echo '<pre>'; print_r($_FILES); die;
        $validator = Validator::make($_FILES, [
						'productFile' => 'required|mimes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ], $messages);

        if ($validator->fails()) {
            return Redirect::to('/products/addproducts')->withInput()->withErrors($validator->errors());
        }		
		
 		\Excel::load($d->getPathname(), function($reader) {
			// Getting all results
			$results = $reader->get();
			$productList = [];
			foreach($results as $i => $v){
				$productList[] = array('name' => $v->products, 'unit_of_measurement' => $v->unit, 'price' => $v->price);
			}

			$success = Product::insert($productList);
			
			DB::enableQueryLog();
			$log = DB::getQueryLog();
			print_r($log); 
		});
	}
	
    public function addproducts(){
        return view('products.add_products');
	}
}
