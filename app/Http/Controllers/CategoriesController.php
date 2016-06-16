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
	
    public function __construct() {
        $this->middleware('auth');
    }
  
     public function listCategories() {
       
        $categories = DB :: table('categories')->get();
        return view('categories.categories', [
            'categories' => $categories
        ]);
    }
    public function categoryDetails( $id = null, Request $request){
        try{
            $id = base64_decode($id);
            $category = DB::table('categories')->where('id', $id)->get();
            
            if(empty($category)){
                throw new Exception('Requested product category not found');
            }
       
            $category_details = DB::table('packages')
                ->leftJoin('products', 'packages.product_id', '=', 'products.id')            
                ->leftJoin('category_types', 'packages.category_type', '=', 'category_types.id')
                ->select('packages.product_count as p_count', 'packages.product_price as spl_price',
                        'products.*',
                        'category_types.name as package_type'
                )
                ->where('packages.category_id', $id)->orderBy('package_type', 'DESC')->get();
            
            $category_info = [];
            $pck_type = '';
            $total_price = 0;
			$products = [];
			if(empty($category_details)){
				throw New Exception('Sorry no packages associated with this category');
			}
            foreach($category_details as $cat){			
                if($pck_type != $cat->package_type){
                    $pck_type = $cat->package_type;
                    $category_info[$pck_type] = [];
                    $category_info[$pck_type]['total_price'] = 0;
					$category_info[$pck_type]['ori_price'] = 0;
                }
               //$category_info[$pck_type][] = $cat;
                $category_info[$pck_type]['total_price'] += $cat->spl_price;
                $category_info[$pck_type]['ori_price'] += $cat->price * $cat->p_count;
				
				if(!isset($products[$cat->name])){
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

            return view('categories.categoryDetails',['category' => $category, 'details' => $category_info, 'products' => $products]);            
        } catch(\Exception $e){
            App::abort(404, $e->getMessage());          
        }
    }
    
    public function updateUserStatus(Request $request)
    {
        $data = $request->all();
        $status = $data['data']['status'];
        $userId = $data['data']['userId'];
        if (!($user = User::find($userId))) 
        {
            App::abort(404, 'Page not found.');
            echo $this->error; die;
        }
        else 
        {
            \DB::table('users')
            ->where('id', $userId)
            ->update(['status' => $status]);
            echo $this->success; die;
        }
    }
    
    public function updateUser($id = null, Request $request) {
        if (!($userData = User::find($id))) {
            App::abort(404, 'Page not found.');
        }
           $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;
                
        $userDetailData = UserDetail::where('user_id',$id)->get();
        if($request->dob)
        {
            $userDetailInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $userDetailInput['gender'] = $request->gender;
        $userDetailInput['phone'] = $request->phone;
        $userDetailInput['address1'] = $request->address1;
        $userDetailInput['address2'] = $request->address2;
        $userDetailInput['city'] = $request->city;
        $userDetailInput['state'] = $request->state;
        $userDetailInput['zipCode'] = $request->zipCode;
        
        if ($userData->fill($userInput)->save() && $userDetailData[0]->fill($userDetailInput)->save()) {
            \Session::flash('flash_message', 'User details updated successfully.');
           
            return redirect('/user/listUsers');
        } else {
            return redirect('/user/editUser');
        }
    }

    
    public function deleteUser( $id = null )
    {
        if (!($user = User::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        User::destroy($id);
        \Session::flash('flash_message', 'User deleted successfully.');
        return Redirect::back();
    }
    
    public function editUser( $id = null )
    {
        if (!($user = User::with('userDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('user.edit_user', [
            'user' => $user,
            'states' => $stateArray
        ]);
    }
    
    public function viewUser($id = null) {
        if (!($user = User::with('userDetail', 'UserDetail.userStateName', 'roleName')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }

        return view('user.view_user', [
            'user' => $user
        ]);
    }







	
	public function saveCategories(Request $request){
		$data = Input::all();
        $messages = [
            'mimes' => 'Please upload a valid excel file'
        ];

        $validator = Validator::make($data, [
			'categoryFile' =>'required|mimes:xls,xlsx'
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
			foreach($categoryList as $i => $n){
				if(!isset($n['sku']) || !isset($n['name']) || !isset($n['price']) || !isset($n['p_count']) || !isset($n['spl_price']) || !isset($n['package']) || !isset($n['category_id']) || empty($n['sku']) || empty($n['name']) || empty($n['price']) || empty($n['p_count']) || empty($n['spl_price']) || empty($n['package']) || empty($n['category_id'])){
					$rejectedList[] = $categoryList[$i];
					unset($categoryList[$i]);
				} else{
					$pro = ['sku' => $n['sku'], 'name' => $n['name'], 'unit_of_measurement' => $n['unit_of_measurement'], 'price' => $n['price']];
					$product[] = $pro;
					$proUpdated = App\Products::firstOrNew(array('sku' => $n['sku']));
					$proUpdated->fill($pro)->save();					
					
					$packRows = ['product_id' => $proUpdated->getKey(), 'category_id' => $n['category_id'], 'product_count' =>$n['p_count'], 'product_price' => $n['spl_price'], 'category_type' => $category_types[ucfirst($n['package'])]];				
					$packageRows[] = $packRows;
					$proUpdated = App\Packages::firstOrNew(array('product_id' => $proUpdated->getKey(), 'category_id' => $n['category_id'], 'category_type' => $category_types[ucfirst($n['package'])]));
					$proUpdated->fill($packRows)->save();					
				}			
			}

			if(!empty($product) AND !empty($packageRows)){
				$this->success = true;
			}
		});
		if($this->success){
			\Session::flash('success_message', 'Category saved successfully.');
		} else{
			\Session::flash('error_message', 'Category SAVE FAILED. Please try again witha valid excel file.');
		}
		return redirect()->back();
	}
	
    public function addcategories(){
        return view('categories.add_categories');
	}	
}
