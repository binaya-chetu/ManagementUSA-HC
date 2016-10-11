<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Config\Repository;
use App\User;
use Session;
use App;
use Auth;

class ProductsController extends Controller {

    protected $success = false;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function saveProducts(Request $request) {
        $data = Input::all();
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];

        $validator = Validator::make($data, [
                    'productFile' => 'required|mimes:xls,xlsx'
                        ], $messages);

        if ($validator->fails()) {
            return Redirect::to('/products/addproducts')->withInput()->withErrors($validator->errors());
        }

        \Excel::load($data['productFile']->getPathname(), function($reader) {
            // Getting all results
            $productList = $reader->select(array('name', 'unit_of_measurement', 'price'))->get()->toArray();
            $list = [];
            foreach ($productList as $i => $n) {
                if (!isset($n['name']) || !isset($n['price']) || !isset($n['unit_of_measurement']) || empty($n['name']) || empty($n['price'])) {
                    unset($productList[$i]);
                }
            }

            if (!empty($productList)) {
                $this->success = Product::insert($productList);
            }
        });
        if ($this->success) {
            Session::flash('success_message', 'Products added successfully.');
        } else {
            Session::flash('error_message', 'Products not added successfully. Please try again.');
        }
        return redirect()->back();
    }

    public function updateProduct(){
            $data = Input::all();

            $product = App\Product::where(['sku' => $data['sku']])->first();
            if(!isset($product) || empty($product)){
                    return ['response' => false, 'msg' => 'Product with given sku value not found'];
            }
            $product->name = $data['pName'];
            $product->price = $data['price'];
            $product->count = $data['count'];
            $product->save();

            return ['response' => true, 'msg' => 'Product updated successfully'];
    }
	
    public function addproducts() {
        return view('products.add_products');
    }
    
    public function generateInvoice(Request $request) {
            $user_id = $request['id'];
            return view('products.invoice',['id' => $user_id]);
    }
    
    public function paymentForm(Request $request){
        return view('products.payment');     

    }
	
    /**
    * showInventory: shows product inventory details
    * Parameters accepted: none
    * Return : Prodduct inventory details page
    */
    public function showInventory(){
        $products = DB::table('products')->orderBy('name', 'asc')->get();

        return view('products.products', [
            'products' => $products
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.inventory_imports');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Input::all();
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];

        $validator = Validator::make($data, [
            'inventory_file' => 'required|mimes:xls,xlsx|between:0,1024' // file size must be from 0 kb to 1 mb
        ], $messages);

        if ($validator->fails()) {
            return Redirect::to('/product/create')->withInput()->withErrors($validator->errors());
        }

        $rejectedList = [];
        \Excel::load($data['inventory_file']->getPathname(), function($reader) {
            // Getting all results
            $inventoryList = $reader->select(array('sku', 'quantity'))->get()->toArray();

            $list = [];
            $inventory = [];
            
            // check if any column is missing in any row if found then the row is rejected
            foreach ($inventoryList as $i => $n) {
                if (!isset($n['sku']) || !isset($n['quantity']) || empty($n['sku']) || empty($n['quantity']) ) {
                    $rejectedList[] = $inventoryList[$i];
                    unset($inventoryList[$i]);
                } else {
                    $pro = ['sku' => $n['sku'], 'count' => $n['quantity']];

                    $inventory[] = $pro;
                    $proUpdated = App\Product::firstOrNew(array('sku' => $n['sku']));
                    $proUpdated->fill($pro)->save();
                }
            }

            if (!empty($inventory)) {
                $this->success = true;
            }
        });
        if ($this->success) {
            \Session::flash('success_message', 'Inventory Imported successfully.');
        } else {
            \Session::flash('error_message', 'Inventory Imports Failed. Please try again witha valid excel file.');
        }
        return redirect()->back();
    }
}
