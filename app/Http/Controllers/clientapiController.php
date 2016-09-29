<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\ApiData;

class ClientapiController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
     /**
     * This function is used to save the api data in api_data table.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {   $path = realpath('json.txt');
        $json_data = file_get_contents($path);
        $datas = json_decode($json_data, true);
        $status = [];
        
        $maxTimeStamp = \DB::connection('mysql2')->table('api_data')->max('timestamp');
        foreach($datas['Data'] as $data)
        {
            $timestamp = preg_replace("/[^0-9]/","",$data['DateTime']);
            
            if($timestamp > $maxTimeStamp)
            {
                $apiData = new ApiData;
                $datatime = date('Y-m-d h:i:s', ($timestamp/1000));

                $apiData->timestamp = $timestamp;
                $apiData->date_time = $datatime;
                $apiData->call_duration = $data['CallDuration'];
                $apiData->phone_number = $data['PhoneNumber'];
                $apiData->phone_number_name = $data['PhoneNumberName'];
                $apiData->call_resolution = $data['CallResolution'];
                $apiData->msg = $data['MSG'];
                $apiData->caller_id = $data['CallerId'];
                $apiData->first_name = $data['FirstName'];
                $apiData->last_name = $data['LastName'];
                $apiData->business = $data['Business'];
                $apiData->address = $data['Address'];
                $apiData->city = $data['City'];
                $apiData->state = $data['State'];
                $apiData->zipcode = $data['ZipCode'];
                $apiData->phone_number_formatted = $data['PhoneNumberFormatted'];
                $apiData->page_count = $data['PageCount'];
                $apiData->group = $data['Group'];
                $apiData->user = $data['User'];
                $apiData->call_direction = $data['CallDirection'];
                $apiData->access = $data['Access'];
                $apiData->status = $data['Status'];
                $apiData->npa = $data['NPA'];
                $apiData->nxxx = $data['NXXX'];
                $apiData->call_type = $data['CallType'];
                $apiData->current_url = $data['CurrentURL'];
                $apiData->widget_name = $data['WidgetName'];
                $apiData->source_type = $data['SourceType'];
                $apiData->category = $data['Category'];

                //$proUpdated = \DB::connection('mysql2')->table('api_data')->firstOrNew(array('timestamp' => $timestamp));

                // save data in user table
                if ($apiData->save()) {

                } else {
                   $status[] = $data;
                }
            }
        }
        if(count($status))
        {
            \Session::flash('error_message', 'Some thing went wrong please try again');
            return redirect('/');
        }
        else
        {
            \Session::flash('flash_message', 'Api Data Save Successfully.');
            return redirect('/');
        }
    }
}
