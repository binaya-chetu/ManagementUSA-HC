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

class CategoriesController extends Controller {

    protected $success = false;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        try {
            $id = base64_decode($id);
            $category = DB::table('categories')->where('id', $id)->get();

            if (empty($category)) {
                \Session::flash('error_message', 'Category Not found.');
                return Redirect::back();
            }

            $category_details = DB::table('packages')
                ->leftJoin('products', 'packages.product_id', '=', 'products.id')
                ->leftJoin('category_types', 'packages.category_type', '=', 'category_types.id')
                ->select('packages.product_count as p_count', 'packages.product_price as spl_price', 'products.*', 'category_types.name as package_type'
                )
                ->where('packages.category_id', $id)
                ->orderBy('package_type', 'DESC')
                ->get();

            $category_info = [];
            $pck_type = '';
            $total_price = 0;
            $products = [];
            if (empty($category_details)) {
                \Session::flash('error_message', 'This package is empty.');
                return Redirect::back();
            }
            foreach ($category_details as $cat) {
                if ($pck_type != $cat->package_type) {
                    $pck_type = $cat->package_type;
                    $category_info[$pck_type] = [];
                    $category_info[$pck_type]['total_price'] = 0;
                    $category_info[$pck_type]['ori_price'] = 0;
                }
                
                $category_info[$pck_type]['total_price'] += $cat->spl_price;
                $category_info[$pck_type]['ori_price'] += $cat->price * $cat->p_count;

                if (!isset($products[$cat->name])) {
                    $products[$cat->name] = [];

                    $products[$cat->name]['Bronze'] = [];
                    $products[$cat->name]['Silver'] = [];
                    $products[$cat->name]['Gold'] = [];
                }

                $products[$cat->name]['price'] = $cat->price;
                $products[$cat->name]['unit_of_measurement'] = $cat->unit_of_measurement;
                $products[$cat->name][$cat->package_type]['count'] = $cat->p_count;
                $products[$cat->name][$cat->package_type]['spl_price'] = $cat->spl_price;
            }

            return view('categories.categoryDetails', ['category' => $category, 'details' => $category_info, 'products' => $products]);
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
                    'categoryFile' => 'required|mimes:xls,xlsx',
                    'categoryFile' => 'between:0,1024' // file size must be from 0 kb to 1 mb
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
