<?php

namespace App\Http\Controllers;

use App\ApiSetting;
use App\Http\Traits\CommonTrait;
use Illuminate\Http\Request;

class ClientapiController extends Controller
{
    use CommonTrait;
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * This function is used to fetch the layout for API setting.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function setting() {
        $data = ApiSetting::first();
        return view('api.setting', [
            'data' => $data
        ]);
    }
    
    /**
     * This function is used to save the API setting details in database.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSetting(Request $request) {
        $saved = $this->saveApiSetting($request);
        
        if($saved)
        {
            // set the flash message for doctor creation success.
            \Session::flash('flash_message', 'Setting Saved Successfully.');
            return redirect('/api/setting');
        }
        else
        {
            // set the flash message for doctor creation success.
            \Session::flash('error_message', 'Some Thing Went Wrong Please Try Again.');
            return redirect('/api/setting');
        }
    }
    
     /**
     * This function is used to save the api data in api_data table.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {   
        $data = ApiSetting::first();
        if(count($data))
        {
            $status = $this->saveApiData($data);
            if($status)
            {
                \Session::flash('flash_message', 'Api Data Save Successfully.');
                return redirect('/');
            }
            else
            {
               \Session::flash('error_message', 'Some thing went wrong please try again');
                return redirect('/');
            }
        }
        else
        {
             \Session::flash('error_message', 'Please set the valid authntication detail');
             return redirect('/api/setting');
        }
    }
}
