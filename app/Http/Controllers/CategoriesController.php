<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Config\Repository;
use App\Role;
use App\User;
use App\UserDetail;
use App\State;
use View;
use App;
use DB;
use App\Categories;
use Exception;

class CategoriesController extends Controller
{
	protected $success = false;
	protected $patient_role = 6;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * This function is used to list all the package.
     *
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function listCategories() {

        $categories = DB :: table('categories')->get();

        return view('categories.categories', [
            'categories' => $categories
        ]);
    }

    /**
     * This function is used to fetch the layout for add new package.
     *
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function addNewCategory() {
        return view('categories.add_new_category');
    }

    /**
     * This function is used to save the new package in database.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCategory(Request $request) {

        $this->validate($request, [
            'cat_name' => 'required|unique:categories',
            'duration_months' => 'required'
        ]);

        $category = new Categories();
        $category->cat_name = $request->cat_name;
        $category->duration_months = $request->duration_months;

        if ($category->save()) {
            \Session::flash('flash_message', 'New Category Added successfully.');
            return redirect('/categories/listCategories');
        } else {
            return redirect('/categories/newCategory');
        }
    }

    /**
     * This function is used to fetch the details of particular package.
     *
     * @param Reuest, Id
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryDetails($id = null, Request $request) {
        try{
			$id = base64_decode($id);
            			
			$patients = User::getAllPatientsIdAndName(config("constants.PATIENT_ROLE_ID"));	
            
			$category = Categories::where('id', $id)->get()->first();
            if(empty($category)){
                \Session::flash('error_message', 'Category Not found.');
                return Redirect::back();
            }
			
			$category_details = App\Packages::getCategoryDetailsById($id);	
			if (empty($category_details)) {
                \Session::flash('error_message', 'This package is empty.');
                return Redirect::back();
            }

            return view('categories.categoryDetails', ['category' => $category, 'details' => $category_details['category_info'], 'products' => $category_details['products'], 'patients' => $patients]);
			
        } catch (\Exception $e) {		
            App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to imports the product excel file.
     *
     * @param Reuest
     *
     * @return \Illuminate\Http\Response
     */
    public function saveCategories(Request $request) {
        $data = Input::all();
        
		$messages = [
            'mimes' => 'Please upload a valid excel file'
        ];
        $validator = Validator::make($data, [
			'categoryFile' => 'required|mimes:xls,xlsx|between:0,1024' // file size must be from 0 kb to 1 mb
		], $messages);

        if ($validator->fails()) {
            return Redirect::to('/categories/addcategories')->withInput()->withErrors($validator->errors());
        }

        $rejectedList = [];
        \Excel::load($data['categoryFile']->getPathname(), function($reader) {
            // Getting all results
            $categoryList = $reader->select(array('sku', 'name', 'unit_of_measurement', 'price', 'p_count', 'spl_price', 'package', 'category_id'))->get()->toArray();

            $category_types = DB::table('category_types')->pluck('id', 'name');
            $list = [];
            $product = [];
            $packageRows = [];
            // check if any column is missing in any row if found then the row is rejected
            foreach ($categoryList as $i => $n) {
                if (!isset($n['sku']) || !isset($n['name']) || !isset($n['price']) || !isset($n['p_count']) || !isset($n['spl_price']) || !isset($n['package']) || !isset($n['category_id']) || empty($n['sku']) || empty($n['name']) || empty($n['price']) || empty($n['p_count']) || empty($n['spl_price']) || empty($n['package']) || empty($n['category_id'])) {
                    $rejectedList[] = $categoryList[$i];
                    unset($categoryList[$i]);
                } else {
                    $pro = ['sku' => $n['sku'], 'name' => $n['name'], 'price' => $n['price']];

                    if (isset($n['unit_of_measurement']) && !empty($n['unit_of_measurement'])) {
                        $pro['unit_of_measurement'] = $n['unit_of_measurement'];
                    }

                    $product[] = $pro;
                    $proUpdated = App\Products::firstOrNew(array('sku' => $n['sku']));
                    $proUpdated->fill($pro)->save();

                    $packRows = ['product_id' => $proUpdated->getKey(), 'category_id' => $n['category_id'], 'product_count' => $n['p_count'], 'product_price' => $n['spl_price'], 'category_type' => $category_types[ucfirst($n['package'])]];
                    $packageRows[] = $packRows;
                    $proUpdated = App\Packages::firstOrNew(array('product_id' => $proUpdated->getKey(), 'category_id' => $n['category_id'], 'category_type' => $category_types[ucfirst($n['package'])]));
                    $proUpdated->fill($packRows)->save();
                }
            }

            if (!empty($product) AND ! empty($packageRows)) {
                $this->success = true;
            }
        });
		
        if ($this->success) {
            \Session::flash('success_message', 'Category saved successfully.');
        } else {
            \Session::flash('error_message', 'Category SAVE FAILED. Please try again witha valid excel file.');
        }
		
        return redirect()->back();
    }

    /**
     * This function is used to fetch the layout for imports file.
     *
     * @param Reuest
     *
     * @return \Illuminate\Http\Response
     */
    public function addcategories() {
        return view('categories.add_categories');
    }

}
