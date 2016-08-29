<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Config\Repository;
use View;
use App;
use DB;
use Exception;
use App\Inventory;

class InventoryController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = DB::table('stocks')
            ->join('products', 'products.sku', '=', 'stocks.sku')
            ->select('stocks.*', 'products.name')
            ->get();
        
        return view('inventory.inventory_details', ['inventories' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.inventory_imports');
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
            return Redirect::to('/inventory/create')->withInput()->withErrors($validator->errors());
        }
        $rejectedList = [];
        \Excel::load($data['inventory_file']->getPathname(), function($reader) {
            // Getting all results
            $inventoryList = $reader->select(array('sku', 'unit_of_measurement', 'quantity'))->get()->toArray();

            $list = [];
            $inventory = [];
            
            // check if any column is missing in any row if found then the row is rejected
            foreach ($inventoryList as $i => $n) {
                if (!isset($n['sku']) || !isset($n['unit_of_measurement']) || !isset($n['quantity']) || empty($n['sku']) || empty($n['unit_of_measurement']) || empty($n['quantity']) ) {
                    $rejectedList[] = $inventoryList[$i];
                    unset($inventoryList[$i]);
                } else {
                    $pro = ['sku' => $n['sku'], 'unit_of_measurement' => $n['unit_of_measurement'], 'quantity' => $n['quantity']];

                    $inventory[] = $pro;
                    $proUpdated = App\Inventory::firstOrNew(array('sku' => $n['sku']));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if( !($inventory = Inventory::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        
        return view('inventory.edit', ['inventory' => $inventory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!($user = Inventory::find($request->id))) {
            App::abort(404, 'Page not found.');
        } 
        
        // validation rule
        $this->validate($request, [
            'quantity' => 'required|numeric'
        ]);

        // update the user status by user id
        $update = DB::table('stocks')
            ->where('id', $request->id)
            ->update(['quantity' => $request->quantity]);
        if($update) {
            \Session::flash('flash_message', 'Inventory Updated Successfully.');

            return redirect('/inventory/index');
        } else {
            \Session::flash('flash_message', 'Unable to update the Inventory Please try again!.');
            return Redirect::back();
        }
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
     /**
     * Displays the details of patient inventory.
     *
     * @param  int  $id
     * @return\Illuminate\Http\Response
     */
     public function patientInventory() {
        $dropDowns = DB::table('dose_dropdown')
                        ->join('dropdown_details', function ($join) {
                            $join->on('dose_dropdown.id', '=', 'dropdown_details.dropdown_id');
                        })->groupBy('dropdown_details.dropdown_id')->where('dose_dropdown.category_id', '=', 2)->get();

        return view('inventory.patientInventory');
    }

}
